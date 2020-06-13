import mutations from './tweet/mutations'
import actions from './tweet/actions'

export default {
    namespaced: true,

    state: {
        tweets: []
    },

    getters: {
        tweet: state => id => state.tweets.find(t => t.id === parseInt(id)),

        parents: state => id => state.tweets.filter(t => {
                t.id !== parseInt(id) && !t.parent_ids.includes(parseInt(id))
            })
            .sort((a, b) => a.created_at - b.created_at),

        replies: state => id => state.tweets.filter(t => t.parent_id === parseInt(id))
                                            .sort((a, b) => a.created_at - b.created_at)
    },

    mutations,

    actions
}