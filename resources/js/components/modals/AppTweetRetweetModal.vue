<template>
    <div>
        {{ tweet.body }}
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
        }
    }
</script>

<style scoped>

</style>