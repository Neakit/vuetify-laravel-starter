import Vue from 'vue';

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// import Vuetify from "vuetify";
import Vuetify from 'vuetify/lib'

Vue.use(Vuetify);
// import 'vuetify/dist/vuetify.css';
import VueAwesomeSwiper from 'vue-awesome-swiper'

// import style
import 'swiper/css/swiper.css'

Vue.use(VueAwesomeSwiper, /* { default options with global component } */)
import router from './router';

import Default from "./layouts/Default";



const app = new Vue({
    el: '#app',
    components: {
        Default,
    },
    vuetify: new Vuetify({
        theme: {
            dark: false
        },
        breakpoint: {
            thresholds: {
                xs: 0,
                sm: 576,
                md: 768,
                lg: 992 - 16,
                xl: 1200 - 16
            },
            scrollBarWidth: 24,
        },
    }),
    router,
    // store,
    template: `
        <router-view></router-view>
    `
});
