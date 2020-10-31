require('./bootstrap');

window.Vue = require('vue');

import router from './routes/routers';
import store from './vuex/store';

Vue.component('teste-component', require('./components/TesteComponent.vue').default);

const app = new Vue({
    router,
    store,
    el: '#app',
});
