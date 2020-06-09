
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
    },

    actions: {
        async retweetTweet(_, tweet) {
            await axios.post(`/api/tweets/${tweet.id}/retweets`)
        },

        async unretweetTweet(_, tweet) {
            await axios.delete(`/api/tweets/${tweet.id}/retweets`)
        },
    }
}