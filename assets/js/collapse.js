export default class Collapse {
  widthTrigger = '767px';
  tooltipList;

  constructor(tooltipList) {
    this.tooltipList = tooltipList;

    let closeBtns = document.getElementsByClassName('sidebar-nav-close');
    let openBtn = document.getElementsByClassName('sidebar-nav-open');

    if (closeBtns.length > 0) {
      closeBtns[0].onclick = this.collapse.bind(this);
    }
    if (openBtn.length > 0) {
      openBtn[0].onclick = this.expand.bind(this);
    }

    window.addEventListener("resize", this.resize.bind(this));
    this.resize();
  }

  collapse() {
    document.getElementsByClassName('sidebar-nav')[0].classList.add("sidebar-nav-mini");
    document.getElementsByClassName('entete')[0].classList.add("entete-mini");

    this.tooltipList.forEach(function (tooltip) {
      tooltip.enable();
    });
  }

  expand() {
    document.getElementsByClassName('sidebar-nav')[0].classList.remove("sidebar-nav-mini");
    document.getElementsByClassName('entete')[0].classList.remove("entete-mini");

    this.tooltipList.forEach(function (tooltip) {
      tooltip.disable();
    });
  }

  resize() {
    // Adapte l'entête et le menu en fonction de la taille de l'écran
    if (window.matchMedia("(min-width: " + this.widthTrigger + ")").matches) {
      this.expand();
    } else {
      this.collapse();
    }
  }
}
