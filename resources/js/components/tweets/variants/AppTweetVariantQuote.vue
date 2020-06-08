<template>
    <div class="flex w-full">
        <div class="mr-3">
            <img :src="tweet.user.avatar" class="w-12 rounded-full" />
        </div>
        <div class="flex-grow">
            <app-tweet-username :user="tweet.user" />
            <p class="text-gray-300 whitespace-pre-wrap">{{ tweet.body }}</p>
            <app-tweet
                    class="border border-gray-700 rouded-lg mt-4"
                    :tweet="tweet.original_tweet"
            />
            <app-tweet-actions-group :tweet="tweet" />
        </div>
    </div>
</template>

<script>
    export default {
        name: "AppTweetVariantQuote",
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