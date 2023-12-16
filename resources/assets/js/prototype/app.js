import ApexCharts from 'apexcharts';
import Vue from 'vue';
import VueI18n from 'vue-i18n'
import VueRouter from 'vue-router';

import translations from './translations';

import App from './components/App.vue';

import Login from './screens/Login.vue';
import Dashboard from './screens/Dashboard.vue';
import TransactionsIndex from './screens/Transactions/Index.vue';
import TransactionsCreate from './screens/Transactions/Create.vue';
import Activities from './screens/Activities.vue';
import SettingsPreferences from './screens/Settings/Preferences.vue';

window.ApexCharts = ApexCharts;

Vue.prototype.versionNumber = window.versionNumber;

Vue.use(VueI18n);

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
        path: '/prototype/activities',
        name: 'activities',
        component: Activities,
    }, {
        path: '/prototype/settings/preferences',
        name: 'settings.preferences',
        component: SettingsPreferences,
    },
];

const i18n = new VueI18n({
    locale: 'en',
    messages: translations,
});

const router = new VueRouter({
    mode: 'history',
    routes,
});

new Vue({
    el: '#app',
    i18n,
    router,
    render: h => h(App),
});
