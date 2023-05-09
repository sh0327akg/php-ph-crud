import './bootstrap';
import './message';
import './rating';
import './like';
import { copyToClipboard }from'./textcopy';
import { like, unlike } from "./like";
import { switchTab } from './tabswitch';
import Alpine from 'alpinejs';

window.like = like;
window.unlike = unlike;
window.switchTab = switchTab;
window.copyToClipboard = copyToClipboard;

window.Alpine = Alpine;
Alpine.start();
