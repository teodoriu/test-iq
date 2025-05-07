import './bootstrap';

import Alpine from 'alpinejs';
import accuweather from './accuweather';

// make Alpine available globally
window.Alpine = Alpine;

// Register the accuweather component with Alpine
Alpine.data('accuweather', accuweather);

Alpine.start();
