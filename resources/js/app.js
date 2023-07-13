import './bootstrap';

import Alpine from 'alpinejs';

import { library, dom } from '@fortawesome/fontawesome-free';

library.add(fasFaHeart);
dom.watch();


window.Alpine = Alpine;

Alpine.start();