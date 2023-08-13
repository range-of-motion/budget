import Vue from 'vue';
import VueRouter from 'vue-router';

import App from './components/App.vue';

import Login from './screens/Login.vue';
import Dashboard from './screens/Dashboard.vue';

Vue.use(VueRouter);

const routes = [
    {
        path: '/prototype/login',
        name: 'login',
        component: Login,
    }, {
        path: '/prototype/dashboard',
        name: 'dashboard',
        component: Dashboard,
    },
];

const router = new VueRouter({
    mode: 'history',
    routes,
});

new Vue({
    el: '#app',
    router,
    render: h => h(App),
});
