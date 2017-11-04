window.Vue = require('vue')

Vue.component('datepicker', require('./components/DatePicker.vue'))

const app = new Vue({
    el: '#app'
})
