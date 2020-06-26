import axios from 'axios';
import Vue from 'vue';

import { Chrome } from 'vue-color';

import ButtonDropdown from './components/ButtonDropdown.vue';
import DatePicker from './components/DatePicker.vue';
import BarChart from './components/BarChart.vue';
import Dropdown from './components/Dropdown.vue';
import TransactionWizard from './components/TransactionWizard.vue';
import ValidationError from './components/ValidationError.vue';
import Searchable from './components/Searchable.vue';
import ColorPicker from './components/ColorPicker.vue';

window.axios = axios;
window.Vue = Vue;

Vue.component('chrome-picker', Chrome);

Vue.component('button-dropdown', ButtonDropdown);
Vue.component('datepicker', DatePicker); // TODO DEPRECATE
Vue.component('date-picker', DatePicker);
Vue.component('barchart', BarChart);
Vue.component('dropdown', Dropdown);
Vue.component('transaction-wizard', TransactionWizard);
Vue.component('validation-error', ValidationError);
Vue.component('searchable', Searchable);
Vue.component('color-picker', ColorPicker);

Vue.directive('click-outside', {
    bind: function (e, binding, vnode) {
        e.clickOutsideEvent = function (event) {
            if (!(e == event.target || e.contains(event.target))) {
                vnode.context[binding.expression](event)
            }
        }

        document.body.addEventListener('click', e.clickOutsideEvent)
    },

    unbind: function (e) {
        document.body.removeEventListener('click', e.clickOutsideEvent)
    }
})

Vue.filter('capitalize', function (value) {
    if (!value) return '';

    value = value.toString();

    return value.charAt(0).toUpperCase() + value.slice(1);
});

const app = new Vue({
    el: '#app',

    mounted() {
        let input = document.querySelector('[autofocus]');

        if (input) {
            input.focus()
        }
    }
})
