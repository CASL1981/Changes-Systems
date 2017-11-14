// /**
//  * First we will load all of this project's JavaScript dependencies which
//  * includes Vue and other libraries. It is a great starting point when
//  * building robust, powerful web applications using Vue and Laravel.
//  */

// require('./bootstrapVue');

// window.Vue = require('vue');





// /**
//  * Next, we will create a fresh Vue application instance and attach it to
//  * the page. Then, you may begin adding components to this application
//  * or customize the JavaScript scaffolding to fit your unique needs.
// */

// Vue.component('vue-pagination', require('./components/Pagination.vue'));

// const  app = new Vue({
//     el: '#app',
//     data: {
//     	changes: [],
//         search: '',
//         counter: 0,
//         pagination: {
//             total: 0,
//             per_page: 0,
//             from: 0,
//             to: 0,
//             current_page: 1
//         },
//         offset: 2,
//     },
//     mounted : function() {
//         this.getChanges(page);
//     },
//     computed: {
//         isActived: function(){
//             return this.pagination.current_page;
//         },
//         pagesNumber: function(){
//             if (!this.pagination.to) {
//                 return [];
//             }

//             var form = this.pagination.current_page - this.offset;
//             if (form < 1) {
//                 form = 1;
//             }

//             var to = form + (this.offset * 2);
//             if (to >= this.pagination.last_page) {
//                 to = this.pagination.last_page;
//             }

//             var pagesArray = [];
//             while(form <= to){
//                 pagesArray.push(form);
//                 form++;
//             }

//             return pagesArray;
//         },
//         searchUser: function () {
            
//             return this.changes.filter((change) => change.user.includes(this.search));
//         },
//         truncate: function(str, value){                    
//             return str.substring(0, value);
//         }
//     },
//     methods: {
//         getChanges: function(page){                    
//             page_url = '/listdetailedchanges?page='+page;
//             axios.get(page_url).then(response => {
//               this.changes = response.data.solicitudes.data;
//               this.pagination = response.data.pagination;
//             });
//         }
//     }
// });