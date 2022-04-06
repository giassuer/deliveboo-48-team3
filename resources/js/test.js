/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

 require('./bootstrap');

 window.Vue = require('vue');
 
 import RestaurantDetail from "./pages/RestaurantDetail.vue";
 import axios from "axios";
 
 import vueBraintree from 'vue-braintree';
 
 Vue.use(vueBraintree);
 
 const app = new Vue({
     el: '#root',
     render: h => h(RestaurantDetail)
 
 });