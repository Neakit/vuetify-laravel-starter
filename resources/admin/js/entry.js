window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');

    require('bootstrap');
} catch (e) {}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     encrypted: true
// });

import Vue       from "vue";
import VueRouter from "vue-router";
import Vuetify   from "vuetify";

Vue.use(Vuetify);
Vue.use(VueRouter)

import LoginPage from './pages/LoginPage';
import Dashboard from './pages/Dashboard';
import Models from './pages/Models';
import Categories from './pages/Categories';
import Products from './pages/Products';

import AdminLayout from "./layouts/AdminLayout";

import 'vuetify/dist/vuetify.css';

import App from './App';


const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/admin/login',
            name: 'admin-login',
            component: LoginPage
        },
        {
            path: '/admin/',
            name: 'admin',
            component: AdminLayout,
            children: [
                {
                    path: 'dashboard',
                    component: Dashboard,
                    name: 'admin.dashboard',
                    meta: {
                        name: 'Главная',
                        icon: 'mdi-home'
                    }
                },
                {
                    path: 'products',
                    component: Products,
                    name: 'admin.products',
                    meta: {
                        name: 'Продукты',
                        icon: 'mdi-car-door'
                    }
                },
                {
                    path: 'models',
                    component: Models,
                    name: 'admin.models',
                    meta: {
                        name: 'Модели',
                        icon: 'mdi-car-info'
                    }
                },
                {
                    path: 'categories',
                    component: Categories,
                    name: 'admin.categories',
                    meta: {
                        name: 'Категории',
                        icon: 'mdi-car-shift-pattern'
                    }
                }
            ]
        }
    ],
});

new Vue({
    el: '#app',
    vuetify: new Vuetify(),
    render: (h) => h(App),
    router
});
