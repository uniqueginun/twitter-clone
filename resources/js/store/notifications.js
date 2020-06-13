import getters from './tweet/getters'
import mutations from './tweet/mutations'
import actions from './tweet/actions'

export default {
    namespaced: true,

    state: {
        notifications: [],
        tweets: []
    },

    getters: {
        ...getters,
        notifications: state => state.notifications.sort((a, b) => b.created_at - a.created_at),
        tweetIdsFromNotifications: state => state.notifications.map(n => n.data.tweet.id)
    },

    mutations: {
        ...mutations,
        PUSH_NOTIFICATIONS: (state, payload) => state.notifications = [...state.notifications, ...payload.filter(item => {
            return ! state.notifications.map(n => n.id).includes(item.id);
        })],
    },

    actions: {
        ...actions,
        async getNotifications({commit, getters, dispatch}, uri) {

            const {data} = await axios.get(uri);
            commit('PUSH_NOTIFICATIONS', data.data);

            let url = `/api/tweets?ids=${getters.tweetIdsFromNotifications.join(',')}`;
            dispatch('getTweets', url);

            return data;
        }
    }
}