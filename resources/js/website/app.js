require('./bootstrap');

window.Vue = require('vue').default;

import Vue from 'vue';

import VeeValidate from "vee-validate";
Vue.use(VeeValidate);

Vue.component('user-login', require('./components/auth/UserLogin.vue').default);
Vue.component('user-register', require('./components/auth/UserRegister.vue').default);
Vue.component('rating-review', require('./components/review/RatingAndReview.vue').default);

const app = new Vue({
    el: '#app',
})
