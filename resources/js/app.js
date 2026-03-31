import './bootstrap';

import Alpine from 'alpinejs';
import Chart from 'chart.js/auto';

window.Chart = Chart; // to make it global
window.Alpine = Alpine;

Alpine.start();
 
