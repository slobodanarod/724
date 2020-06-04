import Vue from 'vue';
import VueRouter from 'vue-router';


import Register from "./pages/register"
import dashboard from "./pages/dashboard";
import chatrooms from "./pages/chatrooms";
import login from "./pages/login";
import settings from "./pages/settings";
import home from "./pages/home";
import room from "./pages/room";
import profile from "./pages/profile";
import onlines from "./pages/onlines";
import viewerin from "./pages/actions/viewer/viewerin"
import viewerout from "./pages/actions/viewer/viewerout"
import smilesin from "./pages/actions/smiles/smilesin";
import smilesout from "./pages/actions/smiles/smilesout";
import Messages from "./pages/Messages";
import Password from "./pages/Password";
import contact from "./pages/contact";
import about from "./pages/about";
import NProgress from 'nprogress';

Vue.use(VueRouter);
const router = new VueRouter({
    routes: [{
        path: '/', component: home, name: 'home',
    }, {
        path: '/home', component: dashboard, name: 'dashboard',

    }, {
        path: '/register', component: Register, name: 'register',
    }, {
        path: '/login', component: login, name: 'login',

    }, {path: '/chat-rooms', component: chatrooms, name: 'chatrooms'}, {
        path: '/room/:url', component: room, name: 'room',
    }, {path: '/profile/:url', component: profile, name: 'profile'}, {
        path: '/settings', component: settings, name: 'settings'
    }, {path: '/change/password', component: Password, name: 'password'}, {
        path: '/onlines', component: onlines, name: 'onlines',

    }, {path: '/actions/viewer/in', component: viewerin, name: 'viewerin'}, {
        path: '/actions/viewer/out', component: viewerout, name: 'viewerout'
    },

        {path: '/actions/smiles/in', component: smilesin, name: 'smilesin'},
        {path: '/about', component: about, name: 'about'},
        { path: '/actions/smiles/out', component: smilesout, name: 'smilesout'  },
        { path: '/contact', component: contact, name: 'contact'  },


        {path: '/messages', component: Messages, name: 'messages'},], mode: 'history'
});

router.beforeEach((to, from, next) => {

    if (to.name)
    {
        NProgress.start();
    }
    next();

});

router.afterEach((to, from) => {

    NProgress.done();

});


export default router;
