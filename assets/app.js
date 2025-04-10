import './bootstrap.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 * 
 */
import './styles/app.css';

// Je prends le CSS de Bootstrap
import './vendor/bootstrap/dist/css/bootstrap.min.css';
// Je prends le JS de Bootstrap
import 'bootstrap';
console.log('This log comes from assets/app.js - welcome to AssetMapper! 🎉');
