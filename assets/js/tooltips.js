import { Tooltip } from 'bootstrap';

export default class Tooltips {
  list;

  constructor() {
    let triggerList = [].slice.call(document.querySelectorAll('.sidebar-nav [data-bs-toggle="tooltip"]'));
    this.list = triggerList.map(function (triggerEl) {
      return new Tooltip(triggerEl, {
        customClass: 'menu-tooltip'
      });
    });
  }
}
