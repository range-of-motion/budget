import Vue from 'vue';
import VueRouter from 'vue-router';

import App from './components/App.vue';

import Login from './screens/Login.vue';
import Dashboard from './screens/Dashboard.vue';
import TransactionsIndex from './screens/Transactions/Index.vue';

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
    }, {
        path: '/prototype/transactions',
        name: 'transactions.index',
        component: TransactionsIndex,
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
