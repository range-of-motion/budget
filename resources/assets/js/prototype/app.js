import Vue from 'vue';
import VueRouter from 'vue-router';

import App from './components/App.vue';

import Login from './screens/Login.vue';
import Dashboard from './screens/Dashboard.vue';
import TransactionsIndex from './screens/Transactions/Index.vue';
import TransactionsCreate from './screens/Transactions/Create.vue';
import SettingsPreferences from './screens/Settings/Preferences.vue';

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
    }, {
        path: '/prototype/transactions/create',
        name: 'transactions.create',
        component: TransactionsCreate,
    }, {
        path: '/prototype/settings/preferences',
        name: 'settings.preferences',
        component: SettingsPreferences,
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
