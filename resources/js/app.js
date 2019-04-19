require('./bootstrap');
// require('admin-lte');
import Vue from 'vue';
import VueRouter from 'vue-router';
import Vuex from 'vuex';
import {routes} from './routes';
import StoreData from './store/store';
import StoreContentModels from './store/modules/content-models';
import StoreContentEntries from './store/modules/content-entries';
import MainApp from './components/MainApp.vue';
import {initialize} from './helpers/general';
// import BootstrapVue from 'bootstrap-vue'
// Vue.use(BootstrapVue);
import SlideUpDown from 'vue-slide-up-down';

Vue.component('slide-up-down', SlideUpDown);

Vue.use(VueRouter);
Vue.use(Vuex);

const store = new Vuex.Store(StoreData);

store.registerModule('models', StoreContentModels);
store.registerModule('entries', StoreContentEntries);

const router = new VueRouter({
    routes,
    mode: 'history',
    linkActiveClass: "active",
    linkExactActiveClass: "active"
});

initialize(store, router);

const app = new Vue({
    el: '#app',
    router,
    store,
    components: {
        MainApp
    }
});