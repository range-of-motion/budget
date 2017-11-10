window.Vue = require('vue')

Vue.component('datepicker', require('./components/DatePicker.vue'))
Vue.component('barchart', require('./components/BarChart.vue'))

const app = new Vue({
    el: '#app'
})
