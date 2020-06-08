<template>
    <div class="w-full inline-block p-4 border-b border-gray-800 hover:bg-gray-800">
        <component :tweet="tweet" :is="`app-tweet-variant-${tweet.type}`" />
    </div>
</template>

<script>
    import AppTweetUsername from "./AppTweetUsername";
    export default {
        name: "AppTweet",
        components: {AppTweetUsername},
        props: {
            tweet: {
                required: true,
                type: Object
            }
        }
    }
</script>

<style scoped>

</style>