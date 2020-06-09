
export default {
    namespaced: true,

    state: {
        retweets: []
    },

    getters: {
        retweets: state => state.retweets
    },

    mutations: {
        PUSH_RETWEETS: (state, payload) => state.retweets.push(...payload)
    }
}