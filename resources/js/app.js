/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
window.Vuex = require('vuex');
window.VueAxios = require('vue-axios');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('UserTransactionsComponent', require('./components/user/UserTransactionsComponent.vue').default);
Vue.component('UserWithdrawComponent', require('./components/user/UserWithdrawComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.use(Vuex, VueAxios, axios);

const store = new Vuex.Store({
    //vuex state is a single object that contains all our application data.
    state: {
        user_transactions_history: []
    },
    //Getters compute properties based on the store state.
    getters: {
        user_transactions_history: state => state.user_transactions_history
    },
    //An action contains business logic and it does not care about updating the state directly.
    actions: {
        getTransactionsHistory (context) {
            axios.get('api/user/transaction')
                .then(function (response) {
                    context.commit('setTransactionsHistory', response.data.results);
                })
                .catch(error => {
                    // if (typeof error.response.data === 'object') {
                    //     this.errors =  _.flatten(_.toArray(error.response.data.errors)).join();
                    // } else {
                    //     this.errors = ['Something went wrong. Please try again.'];
                    // }
                });
        },
    },
    //we can not change the state in action, for that, we have to call mutation function to change the state
    mutations: {
        setTransactionsHistory (state, payload) {
            state.user_transactions_history = payload;
        },
    }
})

const app = new Vue({
    el: '#app',
    store,
    props: [],
    components: {},
    data: {

    },
    methods: {

    },
    mounted() {

    },
    created() {

    }
});


