require('./bootstrap');

window.Vue = require('vue');

Vue.component('teste-component', require('./components/TesteComponent.vue').default);

const app = new Vue({
    el: '#app',
});
