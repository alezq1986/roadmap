require('./bootstrap');

//jQuery UI
import $ from 'jquery';

window.$ = window.jQuery = $;

import 'jquery-ui/ui/widgets/draggable.js';
import 'jquery-ui/ui/widgets/droppable.js';
import 'jquery-ui/ui/widgets/sortable.js';

//Stepper
import Stepper from 'bs-stepper';

window.Stepper = Stepper;

//Chartjs
require('chart.js/dist/Chart.bundle.min.js');
