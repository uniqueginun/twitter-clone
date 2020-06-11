<template>
    <div>
        <app-tweet-retweet-compose :tweet="tweet" @success="closeModal" />
        <component
           :is="`app-tweet-variant-${tweet.type}`"
           :tweet="tweet"
           class="border border-gray-700 rounded-lg mt-4 p-4"
           v-if="tweet"
        />
    </div>
</template>

<script>
    export default {
        name: "AppTweetRetweetModal",
        props: {
            tweet: {
                required: true,
                type: Object
            }
        },
        methods: {
            closeModal() {
                this.$emit('close')
            }
        }
    }
</script>

<style scoped>

</style>