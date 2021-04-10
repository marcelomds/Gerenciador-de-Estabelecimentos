import Vue from 'vue';
import App from './App';
import 'bootstrap/dist/css/bootstrap.min.css';

import router from '../src/routes/routers';

import { BootstrapVue, IconsPlugin } from 'bootstrap-vue';

Vue.use(BootstrapVue)
Vue.use(IconsPlugin)

Vue.config.productionTip = false

new Vue({
  el: '#app',
  router,
  components: { App },
  template: '<App/>',
})
