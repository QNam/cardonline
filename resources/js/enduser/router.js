import Vue from 'vue';
import Router from 'vue-router';

import Login from './components/Auth/Login'
import Register from './components/Auth/Register'
Vue.use(Router);


const router = new Router({
    mode: 'history',
    routes: [
        { path: '/login', name: 'Login', component: Login},
        { path: '/register', name: 'Register', component: Register},
    ]
})

export default router;