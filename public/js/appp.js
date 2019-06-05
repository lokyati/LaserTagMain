import Vue from 'vue';
import Axios from 'axios';
import Bulma  from 'bulma';
import VueResource from 'vue-resource';
 

window.Vue = require('vue');
window.axios = require('axios');

//Vue.config.devtools=false;

Vue.use(Bulma);
Vue.use(VueResource);

Vue.component('simulator', require('./components/MatchSimulator.vue'));

const app = new Vue({
    el: '#app'
});

