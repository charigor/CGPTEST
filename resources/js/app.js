/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
let token = window.app.csrfToken;

window.Vue = require('vue').default;

const Swal = require('sweetalert2')

Vue.component('Pagination', require('./components/Pagination.vue').default);

// Vue.component('multiselect', Multiselect)
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
if( window.app.auth && localStorage.getItem("authToken") == null){

   axios.post(
        `http://127.0.0.1:8000/api/login`,
        window.app.auth

    )
    .then(response => {
        if(localStorage.getItem("authToken") == null){
            localStorage.setItem('authToken',response.data)
        }
    }).catch( error => {
       localStorage.removeItem('authToken')
    })
}
import common  from "./common";

Vue.mixin(common)


