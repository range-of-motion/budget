window.axios = require('axios')

window.Vue = require('vue')

Vue.component('datepicker', require('./components/DatePicker.vue'))
Vue.component('barchart', require('./components/BarChart.vue'))
Vue.component('dropdown', require('./components/Dropdown.vue'))
Vue.component('transaction-wizard', require('./components/TransactionWizard.vue'))
Vue.component('validation-error', require('./components/ValidationError.vue'))
Vue.component('searchable', require('./components/Searchable.vue'))

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

const app = new Vue({
    el: '#app'
})
