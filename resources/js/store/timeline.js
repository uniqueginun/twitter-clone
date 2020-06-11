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

        POP_TWEET: (state, id) => state.tweets = state.tweets.filter(t => t.id !== id),

        UPDATE_LIKES: (state, {id, count}) => state.tweets = state.tweets.map(t => {
            if (t.id === id) {
                t.likes_count = count;
            }
            if (t.original_tweet && t.original_tweet.id === id) {
                t.original_tweet.likes_count = count;
            }
            return t;
        }),

        UPDATE_RETWEETS: (state, {id, count}) => state.tweets = state.tweets.map(t => {
            if (t.id === id) {
                t.retweets_count = count;
            }
            if (t.original_tweet && t.original_tweet.id === id) {
                t.original_tweet.retweets_count = count;
            }
            return t;
        }),
    },

    actions: {
        async getTweets({commit}, uri) {
            const {data} = await axios.get(uri);
            commit('PUSH_TWEETS', data.data);
            commit('likes/PUSH_LIKES', data.meta.likes, { root: true });
            commit('retweets/PUSH_RETWEETS', data.meta.retweets, { root: true });
            return data;
        },

        async quoteTweet({_,}, {id, body}) {
            await axios.post(`/api/tweets/${id}/quotes`, {
                body
            })
        },

        async replyTweet({_,}, {id, form}) {
            await axios.post(`/api/tweets/${id}/replies`, form)
        }
    }
}