import Vue from 'vue';
import App from './App';
import 'bootstrap/dist/css/bootstrap.min.css';
import '@fortawesome/fontawesome-free/css/all.css';
import VueSweetalert2 from 'vue-sweetalert2';
import VueMask from 'v-mask';

import 'sweetalert2/dist/sweetalert2.min.css';

import router from '../src/routes/routers';

import { BootstrapVue, IconsPlugin } from 'bootstrap-vue';

Vue.use(BootstrapVue)
Vue.use(IconsPlugin)

Vue.use(VueMask);
Vue.use(VueSweetalert2);

Vue.config.productionTip = false

new Vue({
  el: '#app',
  router,
  components: { App },
  template: '<App/>',
})
