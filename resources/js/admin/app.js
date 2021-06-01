require('./bootstrap');

import Vue from 'vue'

Vue.config.productionTip = false;

require('bootstrap/dist/css/bootstrap.min.css')
require('bootstrap/dist/js/bootstrap.min.js')
require('@fortawesome/fontawesome-free/css/all.css')

import App from './components/App.vue'
import router from './router';
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';
import http from '../axios'

window.$ = window.jQuery = require('jquery');
window.TableExport = require('tableexport');

Vue.prototype.$http = http;

Vue.use(ElementUI);

const app = new Vue({
    el: '#app',
    router,
    // components: { App }
    render: renderComponent => renderComponent(App)
});
