import Vue from 'vue';
import VueRouter from 'vue-router';
Vue.use(VueRouter);
// layouts
import Default from '../layouts/Default';
import ProductPage from '../pages/ProductPage';

// pages
import Home from '../pages/Home';

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            component: Default,
            children: [
                {
                    path: '',
                    name: 'default',
                    component: Home
                },
                // {
                //     path: '/shop',
                //     name: 'shop',
                //     component: Shop
                // },
                // {
                //     path: '/contacts',
                //     name: 'contacts',
                //     component: Contacts
                // },
                {
                    path: '/product/:id',
                    name: 'ProductPage',
                    component: ProductPage
                },
                // {
                //     path: '/model/Scania',
                //     name: 'Scania',
                //     component: Scania
                // },
                // {
                //     path: '/model/Man',
                //     name: 'Man',
                //     component: Man
                // },
                // {
                //     path: '/model/Mercedes',
                //     name: 'Mercedes',
                //     component: Mercedes
                // },
                // {
                //     path: '/model/Iveco',
                //     name: 'Iveco',
                //     component: Iveco
                // },
                // {
                //     path: '/model/Daf',
                //     name: 'Daf',
                //     component: Daf
                // },
                // {
                //     path: '/model/Renault',
                //     name: 'Renault',
                //     component: Renault
                // },
                // {
                //     path: '/model/Volvo',
                //     name: 'Volvo',
                //     component: Volvo
                // },
                // {
                //     path: '/model/Kamaz',
                //     name: 'Kamaz',
                //     component: Kamaz
                // },
            ]
        },
    ]
});

export default router;
