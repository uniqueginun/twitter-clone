export default {
    tweets: state => state.tweets.sort((a, b) => b.created_at - a.created_at),

    tweet: state => id => state.tweets.find(t => t.id === id)
}