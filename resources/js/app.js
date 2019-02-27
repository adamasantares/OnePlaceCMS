require('./bootstrap');
// require('admin-lte');
import Vue from 'vue';
import VueRouter from 'vue-router';
import Vuex from 'vuex';
import {routes} from './routes';
import StoreData from './store';
import MainApp from './components/MainApp.vue';
import {initialize} from './helpers/general';
// import BootstrapVue from 'bootstrap-vue'
// Vue.use(BootstrapVue);
import SlideUpDown from 'vue-slide-up-down';

Vue.component('slide-up-down', SlideUpDown);

Vue.use(VueRouter);
Vue.use(Vuex);

const store = new Vuex.Store(StoreData);

const router = new VueRouter({
    routes,
    mode: 'history',
    linkActiveClass: "active-class",
    linkExactActiveClass: "active"
});

initialize(store, router);

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
// Vue.component('content-model-form-component', require('./components/ContentModelFormComponent.vue').default);
// Vue.component('create-content-model-field-component', require('./components/CreateContentModelFiledComponent.vue').default);
// Vue.component('create-content-model-field-modal-component', require('./components/CreateContentModelFiledModalComponent.vue').default);
// Vue.component('create-text-field-btn-component', require('./components/CreateTextFieldBtnComponent.vue').default);
// Vue.component('create-text-field-modal-component', require('./components/CreateTextFieldModalComponent.vue').default);

const app = new Vue({
    el: '#app',
    router,
    store,
    components: {
        MainApp
    }
});