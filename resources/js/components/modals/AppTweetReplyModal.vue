<template>
    <div>
        <component
           :is="`app-tweet-variant-${tweet.type}`"
           :tweet="tweet"
            class="mb-4"
            v-if="tweet"
        />
        <app-tweet-reply-compose :tweet="tweet" />
    </div>
</template>

<script>
    export default {
        name: "AppTweetReplyModal",

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