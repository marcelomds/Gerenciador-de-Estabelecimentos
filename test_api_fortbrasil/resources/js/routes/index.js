import Vue from "vue";
import VueRouter from "vue-router";

import ListEstablishments from '../components/Establishiment/ListEstablishments'

Vue.use(VueRouter);

const routes = [
    { path: '/establishments', component: ListEstablishments, name: 'establishments' }
];

export default new VueRouter({
    mode: 'history',
    routes
});

