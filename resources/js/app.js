require('./bootstrap');
import Vue from 'vue';
import router from './router.js';
import * as filters from './filters.js'
import $ from 'jquery';
window.$ = window.jQuery = $;

import { store } from './store';

Vue.component('App', require('./views/App.vue').default);
Vue.prototype.$store = store;

Object.keys(filters).forEach(key => {
    Vue.filter(key, filters[key])
})


Vue.config.devtools = false;
Vue.config.productionTip = true;

const app = new Vue({
    el: "#app",
    router: router,
});
