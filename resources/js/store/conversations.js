import mutations from './tweet/mutations'
import actions from './tweet/actions'

export default {
    namespaced: true,

    state: {
        tweets: []
    },

    getters: {
        tweet: state => id => state.tweets.find(t => t.id === parseInt(id))
    },

    mutations,

    actions
}