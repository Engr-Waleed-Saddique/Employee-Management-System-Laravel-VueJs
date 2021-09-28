require('./bootstrap');
window.Vue = require('vue').default;
//Below custom code is add it is not by default
import Vue from 'vue';
import VueRouter from "vue-router";
Vue.use(VueRouter);
import {routes} from './routes';
//custom code ends here
Vue.component('employees-index', require('./components/employees/Index.vue').default);
//custom code started here
const router=new VueRouter({
    mode:"history",
    routes:routes
});
//custom code ends here
const app = new Vue({
    el: '#app',
    router:router
});