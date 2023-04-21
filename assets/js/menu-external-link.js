export default class MenuExternalLink {
  externalIcon = '<i class="bi-box-arrow-up-right"></i>';
  externalLabelsSelector = 'a[href*="//"] .label';

  constructor(menuSelector) {
    // Ajoute une icône spécifique après chaque lien externe présent dans le menu
    let externalLabels = document.querySelectorAll(menuSelector + ' ' + this.externalLabelsSelector);
    externalLabels.forEach(
        externalLabel => externalLabel.insertAdjacentHTML('beforeend', this.externalIcon)
    );
  }
}
