import { Modal } from 'bootstrap'

export default class Modals {
  constructor() {
    const container = document.querySelector('.front-bundle main > section');

    container.addEventListener("click", (event) => {
      if (false === event.target.matches('button.delete-entity')) {
        // L'élément ayant généré l'évènement n'est pas un bouton de suppression
        return;
      }

      event.preventDefault();
      const button = event.target;
      const idToDelete = button.getAttribute('data-id');
      const modalName = button.getAttribute('data-modal-name');
      const formName = 'delete_form_' + modalName;
      document.querySelector(`form[name="${formName}"] input#${formName}_id`).value = idToDelete;
      let modal = new Modal(document.querySelector(`.delete_modal_${modalName}`), {});
      modal.show();
    });
  }
}
