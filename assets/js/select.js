import TomSelect from 'tom-select/dist/js/tom-select.complete.js';
import 'tom-select/dist/css/tom-select.bootstrap5.css'
import '../styles/select.scss';

export default class Select {
  constructor() {

    const selects = document.querySelectorAll('.tom-select');

    selects.forEach(
      select => this.apply(select)
    );

    window.TomSelect = TomSelect;
  }

  /**
   * Applique TomSelect à l'élément spécifié
   * EX: FrontBundle.select.apply(document.querySelector('#type_beneficiaire'))
   * EX: FrontBundle.select.apply(document.querySelector('#type_beneficiaire'), {maxItems: 1})
   * Le paramètre settings est prioritaire par rapport à l'attribut HTML tom_select_options
   *
   * @param {*} element
   * @param {*} settings
   */
  apply(element, settings = {}) {
    if (typeof element.tomselect !== "undefined") {
      element.tomselect.destroy();
    }

    if (0 === Object.keys(settings).length) {
      // Aucune option n'a été spécifiée, on récupère les paramètres transmis via l'attribut tom_select_options
      let jsonSettings = element.getAttribute('tom_select_options');
      if (jsonSettings !== null) {
        settings = JSON.parse(jsonSettings);
      }
    }

    // Ajoute des configurations pour traduire les messages
    settings.render = {
      option_create: function (data, escape) {
        return '<div class="create">Ajouter <strong>' + escape(data.input) + '</strong>&hellip;</div>';
      },
      no_results: function (data, escape) {
        return '<div class="no-results">Aucun résultat trouvé</div>';
      },
    };

    new TomSelect(element, settings);
  }
}
