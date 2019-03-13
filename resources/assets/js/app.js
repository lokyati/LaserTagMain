require('./bootstrap');

window.Vue = require('vue');

import Vue from 'vue'
import Buefy from 'buefy'

Vue.use(Buefy)


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

