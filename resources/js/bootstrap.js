import jQuery from 'jquery';
import axios from 'axios';
import moment from 'moment';
import simplebar from 'simplebar';

window.$ = window.jQuery = jQuery;
window.axios = axios;
window.moment = moment;

window.SimpleBar = simplebar;


window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
