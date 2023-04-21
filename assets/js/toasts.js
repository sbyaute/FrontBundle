import { Toast } from 'bootstrap';

export default class Toasts {
  constructor() {
    [].slice.call(document.querySelectorAll('.toast')).map(function (toastEl) {
      return new Toast(toastEl, {
        autohide: false
      })
    })

    let userAvatarLinkElt = document.querySelector('.sidebar-nav .user');
    if (userAvatarLinkElt) {
      userAvatarLinkElt.addEventListener('click', function (event) {
        // Toast affichant l'utilisateur connecté
        var userToastElt = document.getElementById('userToast');
        Toast.getInstance(userToastElt).show();
      });
    }
  }
}
