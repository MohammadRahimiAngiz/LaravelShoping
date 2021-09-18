/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/Example.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('attribute-add', require('./components/AttributeAdd.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
// window.axios = require('axios');
// import 'vue-select/dist/vue-select.css';
// import attributeAdd from './components/AttributeAdd.vue';
// import vSelect from 'vue-select'
// import Example from "./components/Example";
// Vue.component('attribute-add', attributeAdd);
// Vue.component('example',Example);
// Vue.component('v-select', vSelect)
const app = new Vue({
    el: '#app',
    data: {
        sms: null,
        phone:false,
        smsValue: '',
    },
    methods: {
        changeData: function () {
            (this.smsValue ==='off') ? this.sms=false : this.sms=true;
            (this.smsValue!== null) ? this.phone=true : this.phone=false;
        }
    },
});
