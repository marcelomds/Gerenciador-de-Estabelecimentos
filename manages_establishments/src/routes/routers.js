import Vue from 'vue';
import VueRouter from 'vue-router';

import ListEstablishments from "../components/frontend/pages/establishments/ListEstablishments";
import AddEstablishment from "../components/frontend/pages/establishments/AddEstablishment";
import EditEstablishment from "../components/frontend/pages/establishments/EditEstablishment";

Vue.use(VueRouter);

const routes = [
  { path: '/establishments', component: ListEstablishments, name: 'establishments-list' },
  { path: '/establishments/add', component: AddEstablishment, name: 'establishment-add' },
  { path: '/establishments/:id/edit', component: EditEstablishment, name: 'establishment-edit' },
];

const router = new VueRouter({
  mode: 'history',
  routes
});

export default router;
