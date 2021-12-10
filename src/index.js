import Vue from 'vue';
import VueRouter from 'vue-router';
import Vuex from 'vuex';
import VueSweetalert2 from 'vue-sweetalert2';
import helpers from './components/helpers/helpers';

Vue.use(Vuex);
Vue.use(VueRouter);
Vue.use(VueSweetalert2)

import router from './components/router/route';
import store from './store/store';
import 'sweetalert2/dist/sweetalert2.min.css';

import { library } from '@fortawesome/fontawesome-svg-core'
import { faDice,faHome,faClipboardList, faSignOutAlt, faArrowDown} from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

import axios from 'axios';
import VueAxios from 'vue-axios';

library.add(faDice,faHome,faClipboardList,faSignOutAlt,faArrowDown);

Vue.component('app',require('./app.vue').default);
Vue.component('font-awesome-icon', FontAwesomeIcon);
Vue.component('top-bar', require("./components/includes/top-bar.vue").default);

Vue.use(VueAxios, axios);
 
const app = new Vue({
    router,
    store,
    helpers
}).$mount("#app");