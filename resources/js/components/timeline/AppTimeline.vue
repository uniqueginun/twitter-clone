<template>
    <div>
        <app-tweet v-for="t in tweets" :key="t.id" :tweet="t" />
    </div>
</template>

<script>
    import AppTweet from "../tweets/AppTweet";
    import {mapGetters, mapActions} from 'vuex';

    export default {
        name: "AppTimeline",

        components: {AppTweet},

        computed: {
            ...mapGetters({
                tweets: 'timeline/tweets'
            })
        },

        methods: {
            ...mapActions({
                getTweets: 'timeline/getTweets'
            })
        },

        mounted() {
            this.getTweets();
        }
    }
</script>

<style scoped>

</style>