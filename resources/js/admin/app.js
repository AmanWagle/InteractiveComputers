require('./bootstrap');

window.Vue = require('vue').default;

import Vue from 'vue';

import 'bootstrap-vue/dist/bootstrap-vue.css'
import { adminNotifications, globalFunctions } from './mixins'

import VeeValidate from "vee-validate";
Vue.use(VeeValidate);

Vue.mixin(adminNotifications)
Vue.mixin(globalFunctions)

Vue.component('admin-brands', require('./components/brand/Brands.vue').default);
Vue.component('brand-form', require('./components/brand/BrandForm.vue').default);

Vue.component('admin-product-categories', require('./components/product_category/ProductCategories.vue').default);
Vue.component('product-category-form', require('./components/product_category/ProductCategoryForm.vue').default);

Vue.component('admin-products', require('./components/product/Products.vue').default);
Vue.component('product-form', require('./components/product/ProductForm.vue').default);

Vue.component('admin-pages', require('./components/website_page/Pages.vue').default);
Vue.component('page-form', require('./components/website_page/PageForm.vue').default);

Vue.component('admin-banners', require('./components/banner/Banners.vue').default);
Vue.component('banner-details', require('./components/banner/BannerDetails.vue').default);

Vue.component('admin-profile', require('./components/profile/Profile.vue').default);

Vue.component('admin-reviews', require('./components/review/Reviews.vue').default);

const app = new Vue({
    el: '#app',
})
