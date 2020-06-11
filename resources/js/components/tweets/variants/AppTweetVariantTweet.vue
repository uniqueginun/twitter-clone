<template>
    <div class="flex w-full">
        <img :src="$user.avatar" class="mr-3 w-12 h-12 rounded-full" />
        <div class="flex-grow">
            <app-tweet-username :user="tweet.user" />
            <p class="text-gray-300 whitespace-pre-wrap break-all">{{ tweet.body }}</p>
            <div class="flex flex-wrap mb-4 mt-4" v-if="images.length">
                <div
                   class="w-6/12 flex-grow"
                   v-for="(image, index) in images"
                   :key="index"
                >
                    <img :src="image.url" class="rounded-lg">
                </div>
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
            }
        }
    }
</script>

<style scoped>

</style>