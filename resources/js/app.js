/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

import Vuetify from "../plugins/vuetify";
import router from "./router/router";
import NProgress from "nprogress";
import 'nprogress/nprogress.css';
import VueSimplemde from 'vue-simplemde'
import 'simplemde/dist/simplemde.min.css'
import marked from 'marked';
window.marked = marked;
import 'material-design-icons-iconfont/dist/material-design-icons.css'


NProgress.configure({ easing: 'ease',showSpinner: false });

axios.interceptors.request.use(function(config){
    NProgress.start();
    return config;
},function(error){
    console.error(error)
    return Promise.reject(error);
});

axios.interceptors.response.use(function (response){
    NProgress.done();
    return response;
},function (error){
    console.error(error)
    return Promise.reject(error);
});

$(document).ajaxComplete(function (event,request,settings) {
    console.log(2);
    NProgress.done();
});

$(document).ajaxStart(function () {
    NProgress.start();
});


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

//Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('AppHome', require('./components/AppHome.vue').default);
Vue.component('vue-simplemde', VueSimplemde);

import User from "./Helpers/User";
window.User = User;

import Exception from "./Helpers/Exception";
window.Exception = Exception;

// console.log(User.own(12));

window.EventBus = new Vue();

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    vuetify:Vuetify,
    router,
});
