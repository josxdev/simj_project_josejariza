import jQuery from 'jquery';
import axios from 'axios';


window.axios = axios;
window.$ = jQuery;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
