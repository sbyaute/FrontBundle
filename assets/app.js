import './styles/app.scss';

import Inputmask from 'inputmask';
import MetisMenu from 'metismenujs';
import Collapse from './js/collapse.js';
import Toasts from './js/toasts.js';
import MenuExternalLink from './js/menu-external-link.js';
import Modals from './js/modals.js';
import Tooltips from './js/tooltips.js';
import Select from './js/select.js';
import ButtonSpinner from './js/button-spinner.js';
import 'datatables.net-bs5';
import 'datatables.net-buttons/js/buttons.html5';
import 'datatables.net-buttons/js/buttons.print';
import 'datatables.net-buttons-bs5';
import './js/datatables.js';

const $ = require('jquery');
global.$ = global.jQuery = $;

// La classe FrontBundle encapsule les modules mis à disposition par le bundle
class FrontBundle {
  // collapse est une propriété de FrontBundle; permet le pilotage du mode collapse par le code client
  collapse;
  select;
  spinner;

  constructor() {
    window.addEventListener("DOMContentLoaded", (event) => {
      if (null !== document.querySelector(".sidebar-nav .metismenu")) {
        new MetisMenu(".sidebar-nav .metismenu");
        this.collapse = new Collapse(
            new Tooltips().list
        );

        // Signale les liens externes présents dans le menu
        new MenuExternalLink('.sidebar-nav .menu-external-link');
      }

      new Toasts();
      // Modales de suppression
      new Modals();
      // Activation de TomSelect
      this.select = new Select();
      this.spinner = new ButtonSpinner();
      $('.dataTable').DataTable();

      // Active l'utilisation de InputMask au travers de l'attribut data-inputmask
      Inputmask().mask(document.querySelectorAll("input"));

      window.dispatchEvent(new Event('FrontBundleLoaded'));
    });
  }
}

window.FrontBundle = new FrontBundle();
