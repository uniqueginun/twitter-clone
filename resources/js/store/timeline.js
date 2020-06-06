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
        async getTweets({commit}, uri) {
            const {data} = await axios.get(uri);
            commit('PUSH_TWEETS', data.data);
            return data;
        }
    }
}