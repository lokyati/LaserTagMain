import Vue from 'vue';
import Buefy from 'buefy';
import Axios from 'axios';
import Bulma  from 'bulma';
import VueResource from 'vue-resource';

window.Vue = require('vue');
window.axios = require('axios');

Vue.use(Buefy);
Vue.use(Bulma);
Vue.use(VueResource);


Vue.component('gdprmodal', require('./components/GDPRModal.vue'));
Vue.component('infomodal', require('./components/InfoModal.vue'));
Vue.component('calendar', require('./components/Calendar.vue'));
Vue.component('calendar2', require('./components/Calendar2.vue'));
Vue.component('userprofil',require('./components/userProfil.vue'));
Vue.component('settingsdropdown',require('./components/settingsDropdown.vue'));
Vue.component('profildelete',require('./components/profilDelete.vue'));
Vue.component('reservations',require('./components/AdminComponents/ReservationsList.vue'));

const app = new Vue({
    el: '#app'
});

