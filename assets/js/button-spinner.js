export default class ButtonSpinner {

  constructor() {
    const container = document.querySelector('.front-bundle main > section');

    container.addEventListener("click", (event) => {
      if (false === event.target.matches('button.btn-spin')) {
        // L'élément ayant généré l'évènement n'a pas la class btn-spin
        return;
      }

      this.add(event.target);
    });
  }

  // Ajoute un spinner sur le boutton
  //EX : FrontBundle.spinner.add(document.querySelector('#assure_save'));
  add(button) {
    // Sauvegarde du contenu dans un attribut
    button.setAttribute('data-original-text', button.innerHTML);
    button.classList.add('disabled');
    button.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> ' + button.textContent;
  }

  // Permet de remettre le bouton à l'état initial, c'est à dire sans spinner
  // EX : FrontBundle.spinner.remove(document.querySelector('#assure_save'));
  remove(button) {
    // On récupère le contenu initial dans l'attribut
    button.innerHTML = button.getAttribute('data-original-text');
    button.classList.remove('disabled');
  }
}
