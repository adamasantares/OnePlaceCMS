window.$ = require('jquery');
require('./bootstrap');
require('codemirror/lib/codemirror.js');
require('codemirror/mode/javascript/javascript.js');
require('summernote/dist/summernote-lite.js');
import Vue from 'vue';
import VueRouter from 'vue-router';
import Vuex from 'vuex';
import {routes} from './routes';
import StoreData from './store/store';
import StoreContentModels from './store/modules/content-models';
import StoreContentEntries from './store/modules/content-entries';
import StoreProjects from './store/modules/projects';
import MainApp from './components/MainApp.vue';
import {initialize} from './helpers/general';
import SlideUpDown from 'vue-slide-up-down';

Vue.component('slide-up-down', SlideUpDown);

Vue.use(VueRouter);
Vue.use(Vuex);

const store = new Vuex.Store(StoreData);

store.registerModule('models', StoreContentModels);
store.registerModule('entries', StoreContentEntries);
store.registerModule('projects', StoreProjects);

const router = new VueRouter({
    routes,
    mode: 'history',
    linkActiveClass: "active",
    linkExactActiveClass: "active"
});

initialize(store, router);

Vue.filter('formatSize', function (size) {

    if(!size) {
        return '';
    }

    if (size > 1024 * 1024 * 1024 * 1024) {
        return (size / 1024 / 1024 / 1024 / 1024).toFixed(2) + ' TB'
    } else if (size > 1024 * 1024 * 1024) {
        return (size / 1024 / 1024 / 1024).toFixed(2) + ' GB'
    } else if (size > 1024 * 1024) {
        return (size / 1024 / 1024).toFixed(2) + ' MB'
    } else if (size > 1024) {
        return (size / 1024).toFixed(2) + ' KB'
    }
    return size.toString() + ' B'
});

const app = new Vue({
    el: '#app',
    router,
    store,
    components: {
        MainApp
    }
});