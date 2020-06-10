<template>
    <div class="flex w-full">
        <img :src="$user.avatar" class="mr-3 w-12 h-12 rounded-full" />
        <div class="flex-grow">
            <app-tweet-username :user="tweet.user" />
            <p class="text-gray-300 whitespace-pre-wrap break-all">{{ tweet.body }}</p>
            <app-tweet-actions-group :tweet="tweet" />
        </div>
    </div>
</template>

<script>
    export default {
        name: "AppTweetVariantTweet",
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