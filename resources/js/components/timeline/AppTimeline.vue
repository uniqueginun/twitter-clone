<template>
    <div>

        <div class="border-b-8 border-gray-800 p-4">
            <app-tweet-compose />
        </div>

        <app-tweet v-for="t in tweets" :key="t.id" :tweet="t" />

        <div v-if="tweets.length" v-observe-visibility="handleScrolledToBottom"></div>

    </div>
</template>

<script>
    import AppTweet from "../tweets/AppTweet";
    import {mapGetters, mapActions, mapMutations} from 'vuex';
    import AppTweetCompose from "../compose/AppTweetCompose";

    export default {
        name: "AppTimeline",

        data: () => {
            return {
                page: 1,
                lastPage: 1
            }
        },

        components: {AppTweetCompose, AppTweet},

        computed: {
            ...mapGetters({
                tweets: 'timeline/tweets'
            }),

            uriWithPage() {
                return `/api/timeline?page=${this.page}`;
            },

            channelName() {
                return `timeline.${this.$user.id}`;
            }
        },

        methods: {
            ...mapActions({
                getTweets: 'timeline/getTweets'
            }),

            ...mapMutations({
                PUSH_TWEETS: 'timeline/PUSH_TWEETS'
            }),

            loadTweets() {
                this.getTweets(this.uriWithPage)
                    .then(response => this.lastPage = response.meta.last_page)
            },

            handleScrolledToBottom(visible) {
                if (!visible || this.lastPage === this.page) return;
                this.page++;
                this.loadTweets();
            }
        },

        mounted() {

            this.loadTweets();

            Echo.private(this.channelName)
                .listen('.TweetWasCreated', (e) => {
                    this.PUSH_TWEETS([e]);
                });
        }
    }
</script>

<style scoped>

</style>