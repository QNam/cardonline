require('./bootstrap');

import Vue from 'vue'

Vue.config.productionTip = false;

require('bootstrap/dist/css/bootstrap.min.css')
require('bootstrap/dist/js/bootstrap.min.js')
require('@fortawesome/fontawesome-free/css/all.css')

import App from './components/App.vue'
import router from './router';
import http from '../axios'
import Vuelidate from 'vuelidate'
import Notifications from 'vue-notification'

Vue.use(Vuelidate)
Vue.use(Notifications)

Vue.prototype.$http = http;


const app = new Vue({
    el: '#app',
    router,
    // components: { App }
    render: renderComponent => renderComponent(App)
});
