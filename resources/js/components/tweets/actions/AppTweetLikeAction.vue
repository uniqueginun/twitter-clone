<template>
    <a href="#" @click.prevent="toggleLikeStatus" class="flex items-center text-base">
        <svg
                viewBox="0 0 24 24"
                class="fill-current text-gray-600 w-5 mr-2"
                width="24"
                height="24"
                :class="{
                    'text-red-600': liked
                }"
        >
            <path class="heroicon-ui" d="M12.76 3.76a6 6 0 0 1 8.48 8.48l-8.53 8.54a1 1 0 0 1-1.42 0l-8.53-8.54a6 6 0 0 1 8.48-8.48l.76.75.76-.75zm7.07 7.07a4 4 0 1 0-5.66-5.66l-1.46 1.47a1 1 0 0 1-1.42 0L9.83 5.17a4 4 0 1 0-5.66 5.66L12 18.66l7.83-7.83z"/>
        </svg>
        <span
                class="text-gray-600"
                :class="{
                    'text-red-600': liked
                }"
        >{{ tweet.likes_count }}</span>
    </a>
</template>

<script>
    import { mapGetters, mapActions } from 'vuex'

    export default {
        name: "AppTweetLikeAction",
        props: {
            tweet: {
                required: true,
                type: Object
            }
        },
        methods: {
            ...mapActions({
                unlikeTweet: 'likes/unlikeTweet',
                likeTweet: 'likes/likeTweet',
            }),

            toggleLikeStatus() {
                if (this.liked) {
                    this.unlikeTweet(this.tweet);
                    return;
                }

                this.likeTweet(this.tweet);
            }
        },
        computed: {
            ...mapGetters({
                likes: 'likes/likes'
            }),

            liked() {
                return this.likes.includes(this.tweet.id)
            }
        }
    }
</script>

<style scoped>

</style>