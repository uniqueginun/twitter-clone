<template>
    <div>
        <app-tweet v-for="t in tweets" :key="t.id" :tweet="t" />
        <div v-if="tweets.length" v-observe-visibility="handleScrolledToBottom"></div>
    </div>
</template>

<script>
    import AppTweet from "../tweets/AppTweet";
    import {mapGetters, mapActions} from 'vuex';

    export default {
        name: "AppTimeline",

        data: () => {
            return {
                page: 1,
                lastPage: 1
            }
        },

        components: {AppTweet},

        computed: {
            ...mapGetters({
                tweets: 'timeline/tweets'
            }),

            uriWithPage() {
                return `/api/timeline?page=${this.page}`;
            }
        },

        methods: {
            ...mapActions({
                getTweets: 'timeline/getTweets'
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
        }
    }
</script>

<style scoped>

</style>