import Vue from 'vue';
import VueRouter from 'vue-router';

import Login from "../components/frontend/pages/auth/Login";
import RegisterUser from "../components/frontend/pages/auth/RegisterUser";

import ListEstablishments from "../components/frontend/pages/establishments/ListEstablishments";
import AddEstablishment from "../components/frontend/pages/establishments/AddEstablishment";
import EditEstablishment from "../components/frontend/pages/establishments/EditEstablishment";

Vue.use(VueRouter);

const routes = [

  { path: '/', redirect: '/login' },
  { path: '/login', component: Login, name: 'login', meta: { guestOnly: true } },
  { path: '/register', component: RegisterUser, name: 'register', meta: { guestOnly: true } },

  { path: '/establishments', component: ListEstablishments, name: 'establishments-list', meta: { authOnly: true } },
  { path: '/establishments/add', component: AddEstablishment, name: 'establishment-add', meta: { authOnly: true } },
  { path: '/establishments/:id/edit', component: EditEstablishment, name: 'establishment-edit', meta: { authOnly: true } },
];

const router = new VueRouter({
  mode: 'history',
  routes
});

export default router;
