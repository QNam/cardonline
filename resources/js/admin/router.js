import Vue from 'vue';
import Router from 'vue-router';

import Card from './components/Card/Card'
import Dashboard from './components/Dashboard/Dashboard'

Vue.use(Router);


const router = new Router({
    routes: [
        { path: '/', name: 'Dashboard', component: Dashboard},
        { path: '/card', name: 'CardIndex', component: Card},
    ]
})

export default router;