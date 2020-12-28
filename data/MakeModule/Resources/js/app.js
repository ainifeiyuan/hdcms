require('./bootstrap')

import Vue from 'vue'

import store from './store'

new Vue({
    el: '#app',
    mixins: [window.vue || {}],
    store
})
