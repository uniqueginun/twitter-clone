export default {
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

    UPDATE_REPLIES: (state, {id, count}) => {
        state.tweets = state.tweets.map(tweet => {
            if (tweet.id === id) {
                tweet.replies_count = count;
            }
            if (tweet.original_tweet && tweet.original_tweet.id === id) {
                tweet.original_tweet.replies_count = count;
            }
            return tweet;
        })
    }
}