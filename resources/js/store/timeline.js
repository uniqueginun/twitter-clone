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
        })],

        UPDATE_LIKES: (state, {id, count}) => state.tweets = state.tweets.map(t => {
            if (t.id === id) {
                t.likes_count = count;
            }
            if (t.original_tweet && t.original_tweet.id === id) {
                t.original_tweet.likes_count = count;
            }
            return t;
        })
    },

    actions: {
        async getTweets({commit}, uri) {
            const {data} = await axios.get(uri);
            commit('PUSH_TWEETS', data.data);
            commit('likes/PUSH_LIKES', data.meta.likes, { root: true });
            commit('retweets/PUSH_RETWEETS', data.meta.retweets, { root: true });
            return data;
        }
    }
}