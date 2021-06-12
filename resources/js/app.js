require('./bootstrap');

import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'

window.Vue = require('vue').default;

import Vue from 'vue';

import 'bootstrap-vue/dist/bootstrap-vue.css'
import { adminNotifications, globalFunctions} from './mixins'


Vue.use(BootstrapVue)
Vue.use(IconsPlugin)

Vue.mixin(adminNotifications)
Vue.mixin(globalFunctions)

Vue.component('admin-brands', require('./components/admin/brand/Brands.vue').default);
Vue.component('brand-form', require('./components/admin/brand/BrandForm.vue').default);

Vue.component('admin-product-categories', require('./components/admin/product_category/ProductCategories.vue').default);
Vue.component('product-category-form', require('./components/admin/product_category/ProductCategoryForm.vue').default);

const app = new Vue({
    el: '#app',
})
