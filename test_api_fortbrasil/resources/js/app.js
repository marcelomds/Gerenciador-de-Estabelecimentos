require('./bootstrap');
import Vue from 'vue'
import router from './routes/index'

window.Vue = require('vue').default;

import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'

Vue.use(BootstrapVue)
Vue.use(IconsPlugin)

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// LAYOUT - NAVBAR
Vue.component('navbar', require('./components/_include/Layout/Navbar').default);

// CRUD - Estabelecimentos
Vue.component('list-establishments', require('./components/Establishiment/ListEstablishments').default);
Vue.component('add-establishment', require('./components/Establishiment/AddEstablishment').default);


const app = new Vue({
    el: '#app',
    router
});
