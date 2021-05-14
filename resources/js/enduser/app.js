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
// import Notifications from 'vue-notification'
// import ElementUI from 'element-ui';
// import 'element-ui/lib/theme-chalk/index.css';

import Vant from 'vant';
import 'vant/lib/index.css';

Vue.use(Vant);
Vue.use(Vuelidate)
// Vue.use(Notifications)
// Vue.use(ElementUI);

Vue.prototype.$http = http;


const app = new Vue({
    el: '#app',
    router,
    // components: { App }
    render: renderComponent => renderComponent(App)
});
