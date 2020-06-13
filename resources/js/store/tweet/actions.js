export default {
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