export default {
    namespaced: true,

    state: {
        tweets: []
    },

    getters: {
        tweets: state => state.tweets
    },

    mutations: {
        PUSH_TWEETS: (state, payload) => state.tweets = [...state.tweets, ...payload]
    },

    actions: {
        async getTweets({commit}) {
            const {data} = await axios.get('/api/timeline');
            commit('PUSH_TWEETS', data.data);
        }
    }
}