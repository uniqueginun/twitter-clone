export default {
    namespaced: true,

    state: {
        notifications: []
    },

    getters: {
        notifications: state => state.notifications.sort((a, b) => b.created_at - a.created_at)
    },

    mutations: {
        PUSH_NOTIFICATIONS: (state, payload) => state.notifications = [...state.notifications, ...payload.filter(item => {
            return ! state.notifications.map(n => n.id).includes(item.id);
        })],
    },

    actions: {
        async getNotifications({commit}, uri) {
            const {data} = await axios.get(uri);
            commit('PUSH_NOTIFICATIONS', data.data);
            return data;
        }
    }
}