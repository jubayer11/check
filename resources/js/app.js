
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
// src/plugins/vuetify.js

import '@mdi/font/css/materialdesignicons.css'
import 'material-design-icons-iconfont/dist/material-design-icons.css'

require('./bootstrap');

window.Vue = require('vue');
import Vue from 'vue'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
import router from './Router/router.js'
import '@mdi/font/css/materialdesignicons.css'
Vue.use(Vuetify)
const vuetifyOptions = {}
import  User from './Helpers/User'
window.User =User
import  Exception from './Helpers/Exception'
window.Exception =Exception
window.EventBus = new Vue();
import Toasted from 'vue-toasted';
Vue.use(Toasted)

import VueProgressBar from 'vue-progressbar'
import { loadProgressBar } from 'axios-progress-bar'
Vue.use(loadProgressBar)
const options = {
    color: '#bffaf3',
    failedColor: '#874b4b',
    thickness: '5px',
    height:'5px',
    transition: {
        speed: '0.2s',
        opacity: '0.6s',
        termination: 300
    },
    autoRevert: true,
    location: 'top',
    inverse: false
}

Vue.use(VueProgressBar, options)

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))



Vue.component('home', require('./components/AppHome.vue').default);
Vue.component('login', require('./components/Login.vue').default);
Vue.component('signup', require('./components/Signup.vue').default);
Vue.component('checkSignup',require('./components/ConfirmSignup.vue').default);
Vue.component('passwordReset',require('./components/resetPasswordWithToken.vue').default);
Vue.component('classRoutine',require('./components/AdminPannel/ClassRoutine.vue').default);


const app = new Vue({
    el: '#app',
    vuetify: new Vuetify(vuetifyOptions),
    router,
    icons: {
        iconfont: 'mdi', // default - only for display purposes
    },
    VueProgressBar,
});

