/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
// document.getElementById("ciao").addEventListener("click", function(event){
//    event.preventDefault()
//  });
// function deleteAccomodation() {
//    const deleteForm = document.querySelectorAll(".delete-form");

//    deleteForm.forEach(form => {
//       form.addEventListener("submit", (event) => {
//          console.log('ciao')
//          if (!confirm("Sei sicuro di voler cancellare il tuo annuncio?")) {
//             event.preventDefault();
//          }
//       })
//    })
// }
// function prova(ev) {
// confirm('Sei sicuro di voler cancellare il tuo annuncio?')
// ev.preventDefault();
// }
// const log = document.querySelectorAll(".log")
// const form = document.querySelectorAll(".delete-form")
// form.addEventListener('submit', prova(ev))

// window.addEventListener("load", function () {
//    const deleteForm = document.querySelectorAll(".delete-form");

//    deleteForm.forEach(form => {
//       form.addEventListener("submit", (event) => {
//          console.log('ciao')
//          if (!confirm("Sei sicuro di voler cancellare il tuo annuncio?")) {
//             event.preventDefault();
//          }
//       })
//    })
// });

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

const files = require.context('./', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);



/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});

