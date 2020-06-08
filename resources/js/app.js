
require('./bootstrap');

window.Vue = require('vue');

import Vuex from 'vuex';
Vue.use(Vuex);

import VueObserveVisibility from 'vue-observe-visibility'
Vue.use(VueObserveVisibility)

Vue.prototype.$user = User;

const files = require.context('./', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

import timeline from './store/timeline'
import likes from "./store/likes";

const store = new Vuex.Store({
    modules: {
        timeline,
        likes
    }
})


const app = new Vue({
    el: '#app',
    store
});

Echo.channel('tweets')
    .listen('.TweetLikesWereUpdated', (e) => {
        console.log(e.user_id);
        console.log(window.User.id);
        if (e.user_id === window.User.id) {
            store.dispatch('likes/syncLike', e.id);
        }
        store.commit('timeline/UPDATE_LIKES', e);
    });
