import './bootstrap';
import './message';
import './rating';
import { like, unlike } from "./like";
import { switchTab } from './tabswitch';


window.like = like;
window.unlike = unlike;

window.switchTab = switchTab;

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();