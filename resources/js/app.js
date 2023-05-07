import './bootstrap';
import './message';
import './rating';
import { like, unlike } from "./like";
import { switchTab } from './tabswitch';
import Alpine from 'alpinejs';

window.like = like;
window.unlike = unlike;
window.switchTab = switchTab;

window.Alpine = Alpine;
Alpine.start();

const infoIcon = document.getElementById('info-icon');
const tooltip = document.getElementById('tooltip');

infoIcon.addEventListener('mouseover', () => {
  tooltip.classList.remove('hidden');
});

infoIcon.addEventListener('mouseout', () => {
  tooltip.classList.add('hidden');
});