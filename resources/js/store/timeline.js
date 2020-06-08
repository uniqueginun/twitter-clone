export default {
    namespaced: true,

    state: {
        tweets: []
    },

    getters: {
        tweets: state => state.tweets.sort((a, b) => b.created_at - a.created_at)
    },

    mutations: {
        PUSH_TWEETS: (state, payload) => state.tweets = [...state.tweets, ...payload.filter(item => {
            return ! state.tweets.map(t => t.id).includes(item.id);
        })]
    },

    actions: {
        async getTweets({commit}, uri) {
            const {data} = await axios.get(uri);
            commit('PUSH_TWEETS', data.data);
            commit('likes/PUSH_LIKES', data.meta.likes, { root: true })
            return data;
        }
    }
}