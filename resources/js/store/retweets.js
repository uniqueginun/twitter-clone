
export default {
    namespaced: true,

    state: {
        retweets: []
    },

    getters: {
        retweets: state => state.retweets
    },

    mutations: {
        PUSH_RETWEETS: (state, payload) => state.retweets.push(...payload),

        PUSH_RETWEET: (state, id) => state.retweets.push(id),

        POP_RETWEET: (state, id) => state.retweets = state.retweets.filter(r => parseInt(r) !== parseInt(id))
    },

    actions: {
        async retweetTweet(_, tweet) {
            await axios.post(`/api/tweets/${tweet.id}/retweets`)
        },

        async unretweetTweet(_, tweet) {
            await axios.delete(`/api/tweets/${tweet.id}/retweets`)
        },

        syncRetweet({commit, state}, id) {
            if (state.retweets.includes(id)) {
                commit('POP_RETWEET', id);
                return;
            }

            commit('PUSH_RETWEET', id);
        }
    }
}