<template>
    <div class="flex w-full">
        <img :src="$user.avatar" class="mr-3 w-12 h-12 rounded-full" />
        <div class="flex-grow">

            <app-tweet-username :user="tweet.user" />

            <app-tweet-body :tweet="tweet" />

            <div class="flex flex-wrap mb-4 mt-4" v-if="images.length">
                <div
                   class="w-6/12 flex-grow"
                   v-for="(image, index) in images"
                   :key="index"
                >
                    <img :src="image.url" class="rounded-lg">
                </div>
            </div>

            <div v-if="video" class="mt-4 mb-4">
                <video :src="video.url" controls class="rounded-lg"></video>
            </div>

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
        },

        computed: {
            images() {
                return this.tweet.media.data.filter(mediaElement => mediaElement.type === 'image');
            },

            video() {
                return this.tweet.media.data.find(mediaElement => mediaElement.type === 'video');
            }
        }
    }
</script>

<style scoped>

</style>