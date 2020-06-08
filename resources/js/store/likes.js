export default {
    namespaced: true,

    state: {
        likes: []
    },

    getters: {
        likes: state => state.likes
    },

    mutations: {
        PUSH_LIKES: (state, payload) => state.likes.push(...payload)
    },

    actions: {
        async likeTweet(_, tweet) {
            await axios.post(`/api/tweets/${tweet.id}/likes`)
        },

        async unlikeTweet(_, tweet) {
            await axios.delete(`/api/tweets/${tweet.id}/likes`)
        },
    }
}