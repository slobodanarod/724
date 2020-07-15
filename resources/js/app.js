require('./bootstrap');
window.Vue = require('vue');

import App from './App.vue';
import router from './router.js';
import {store} from './store.js'
import VueTimeago from 'vue-timeago'
import VueSocketIOExt from 'vue-socket.io-extended';
import io from 'socket.io-client';
import NProgress from 'vue-nprogress'


const socket = io('https://127.0.0.1:3000');

Vue.use(VueSocketIOExt, socket);

Vue.use(VueTimeago, {
    name: 'Timeago', locale: 'tr', locales: {
        tr: require('date-fns/locale/tr')
    }
});

const app = new Vue({
    el: '#app', template: '<App/>', router, store, components: {
        App
    },
});
