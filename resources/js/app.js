
require('./bootstrap');

window.Vue = require('vue');

import Vuex from 'vuex';
Vue.use(Vuex);

import VueObserveVisibility from 'vue-observe-visibility'
Vue.use(VueObserveVisibility)


const files = require.context('./', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

import timeline from './store/timeline'

const store = new Vuex.Store({
    modules: {
        timeline
    }
})


const app = new Vue({
    el: '#app',
    store
});
