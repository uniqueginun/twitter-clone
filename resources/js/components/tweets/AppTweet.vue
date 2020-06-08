<template>
    <div class="w-full inline-block p-4 border-b border-gray-800 hover:bg-gray-800">
        <component :tweet="tweet" :is="`app-tweet-variant-${tweet.type}`" />
    </div>
</template>

<script>
    export default {
        name: "AppTweet",
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