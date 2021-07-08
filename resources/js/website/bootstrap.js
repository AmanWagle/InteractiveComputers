window._ = require('lodash');

try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');

    require('bootstrap');
} catch (e) {}

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

require('./jquery.min.js');
require('./bootstrap.bundle.min');
require('./jquery.hoverIntent.min.js');
require('./jquery.waypoints.min.js');
require('./owl.carousel.min.js');
//main js
require('./main');
require('./demo-13');