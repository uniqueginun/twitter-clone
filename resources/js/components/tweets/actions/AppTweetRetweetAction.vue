<template>
    <div>
        <app-dropdown v-if="!retweeted">
            <template slot="trigger">
                <app-tweet-retweet-action-button :tweet="tweet" />
            </template>
            <app-dropdown-item @click.prevent="retweetOrUnretweet">
                Retweet
            </app-dropdown-item>
            <app-dropdown-item  @click.prevent="fireRetweetModal">
                Retween with comment
            </app-dropdown-item>
        </app-dropdown>
        <app-tweet-retweet-action-button v-else :tweet="tweet" @click="retweetOrUnretweet" />
    </div>
</template>

<script>

    import { mapGetters, mapActions } from 'vuex';
    import AppTweetRetweetModal from "../../modals/AppTweetRetweetModal";


    export default {
        name: "AppTweetRetweetAction",

        props: {
            tweet: {
                type: Object,
                required: true
            }
        },

        computed: {
            ...mapGetters({
                retweets: 'retweets/retweets'
            }),

            retweeted() {
                return this.retweets.includes(this.tweet.id)
            }
        },

        methods: {
            ...mapActions({
                retweetTweet: 'retweets/retweetTweet',
                unretweetTweet: 'retweets/unretweetTweet',
            }),

            retweetOrUnretweet() {
                if (this.retweeted) {
                    this.unretweetTweet(this.tweet);
                    return;
                }
                this.retweetTweet(this.tweet);
            },

            fireRetweetModal() {
                this.$modal.show(AppTweetRetweetModal, {
                    tweet: this.tweet
                }, {
                    draggable: true
                })
            }
        }
    }
</script>

<style scoped>

</style>