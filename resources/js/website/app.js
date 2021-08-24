require('./bootstrap');

window.Vue = require('vue').default;

import Vue from 'vue';

import VueSweetalert2 from "vue-sweetalert2";
import 'sweetalert2/dist/sweetalert2.all';

import VeeValidate from "vee-validate";

Vue.use(VueSweetalert2);

Vue.use(VeeValidate);

Vue.component('user-login', require('./components/auth/UserLogin.vue').default);
Vue.component('user-register', require('./components/auth/UserRegister.vue').default);
Vue.component('rating-review', require('./components/review/RatingAndReview.vue').default);
Vue.component('shop-page', require('./components/shop/ShopPage.vue').default);
Vue.component('shopping-cart', require('./components/order/Cart.vue').default);
Vue.component('checkout-order', require('./components/order/Checkout.vue').default);
Vue.component('cart-quickview', require('./components/order/CartQuickview.vue').default);
Vue.component('update-profile', require('./components/profile/UpdateProfile.vue').default);
Vue.component('update-password', require('./components/profile/UpdatePassword.vue').default);

const app = new Vue({
    el: '#app',
})
