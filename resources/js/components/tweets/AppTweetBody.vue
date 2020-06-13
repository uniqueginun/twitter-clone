<template>
    <p class="text-gray-300 whitespace-pre-wrap break-all">
        <component :is="body" />
    </p>
</template>

<script>
    export default {
        name: "AppTweetBody",

        props: {
            tweet: {
                type: Object,
                required: true
            }
        },

        computed: {
            body() {
                return {
                    'template': `<div>${this.tweet.body} <app-tweet-hashtag-entity /></div>`
                }
            }
        }
    }
</script>

<style scoped>

</style>