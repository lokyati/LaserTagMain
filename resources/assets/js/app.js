import Vue from 'vue';
import Buefy from 'buefy';
import Axios from 'axios';
import Bulma  from 'bulma';
import VueResource from 'vue-resource';
import VueSlideBar from 'vue-slide-bar'
 

window.Vue = require('vue');
window.axios = require('axios');

Vue.use(Buefy);
Vue.use(Bulma);
Vue.use(VueResource);
Vue.component('VueSlideBar', VueSlideBar);


Vue.component('gdprmodal', require('./components/GDPRModal.vue'));
Vue.component('infomodal', require('./components/InfoModal.vue'));
Vue.component('successmodal', require('./components/SuccessModal.vue'));
Vue.component('failmodal', require('./components/FailModal.vue'));
Vue.component('calendar', require('./components/Calendar.vue'));
Vue.component('userprofil',require('./components/userProfil.vue'));
Vue.component('settingsdropdown',require('./components/settingsDropdown.vue'));
Vue.component('profildelete',require('./components/profilDelete.vue'));
Vue.component('admindashboard',require('./components/AdminComponents/adminDashboard.vue'));
Vue.component('package', require('./components/Package.vue'));
Vue.component('singlepackage', require('./components/singlePackage.vue'));
Vue.component('packagemodal', require('./components/PackageModal.vue'));
Vue.component('deletemodal', require('./components/DeleteModal.vue'));
Vue.component('editormodal', require('./components/EditorModal.vue'));
Vue.component('simulator', require('./components/MatchSimulator.vue'));
Vue.component('simplecarousel',require('./components/SimpleCarousel.vue'));
Vue.component('matchcard',require('./components/MatchCard.vue'));
Vue.component('updatemodal',require('./components/UpdateModal.vue'));
Vue.component('lvlupmodal',require('./components/lvlUpModal.vue'));


const app = new Vue({
    el: '#app'
});

