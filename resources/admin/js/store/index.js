import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
        state: {
        },
        getters: {
        },
        mutations: {
        },
        actions: {
            getCategories(state, payload) {
                const defaultParams = {
                    start: 0,
                    length: 10,
                    currentPage: 1,
                    filter: "",
                    sortRow: "id",
                    sort: 'desc'
                };
                const payloadParams = payload && payload.params || {};
                const params = { ...payloadParams, ...defaultParams };
                return axios.get('/admin/get-records/categories', { params });
            },
            getProductModels(state, payload) {
                const defaultParams = {
                    start: 0,
                    length: 10,
                    currentPage: 1,
                    filter: "",
                    sortRow: "id",
                    sort: 'desc'
                };
                const payloadParams = payload && payload.params || {};
                const params = { ...payloadParams, ...defaultParams };
                return axios.get('/admin/get-records/productModels', { params });
            }
        },
        modules: {
        }
    }
);
