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
    }
}