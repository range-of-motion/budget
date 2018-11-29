window.axios = require('axios')

window.Vue = require('vue')

Vue.component('datepicker', require('./components/DatePicker.vue'))
Vue.component('barchart', require('./components/BarChart.vue'))
Vue.component('dropdown', require('./components/Dropdown.vue'))
Vue.component('transaction-wizard', require('./components/TransactionWizard.vue'))
Vue.component('validation-error', require('./components/ValidationError.vue'))

const app = new Vue({
    el: '#app'
})
