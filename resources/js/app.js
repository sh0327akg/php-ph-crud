import './bootstrap';
import './message';
import './rating';
import { like, unlike } from "./like";

window.like = like;
window.unlike = unlike;

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();