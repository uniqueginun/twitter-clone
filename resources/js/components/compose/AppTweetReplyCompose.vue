<template>
    <form @submit.prevent="submitTweet()" class="flex">
        <img :src="$user.avatar" class="mr-3 w-12 h-12 rounded-full" />
        <div class="flex-grow">

            <app-tweet-compose-textarea
                v-model="form.body"
                placeholder="have a reply?"
            />

            <AppTweetMediaProgress class="mb-4" :progress="media.progress" v-if="media.progress" />

            <app-tweet-image-preview
                    v-if="media.images.length"
                    :images="media.images"
                    @removed="removeImage"
            />

            <app-tweet-video-preview
                v-if="media.video"
                :video="media.video"
                @removed="media.video = null"
            />

            <div class="flex justify-between">
                <ul class="flex items-center">
                    <li class="mr-4">
                        <app-tweet-compoe-media-button
                            id="media-compose-reply"
                            @selected="handleMediaSelected"
                        />
                    </li>
                </ul>
                <div class="flex items-center justify-end">
                    <app-tweet-compose-limit-indicator
                        :charactersAmount="charactersAmount"
                        v-show="charactersAmount"
                    />
                    <button
                        type="submit"
                        class="bg-blue-600 rounded-full text-gray-300 text-center px-4 py-3 font-bold leading-none"
                    >Reply</button>
                </div>
            </div>
        </div>
    </form>
</template>

<script>

    import composer from '../../mixins/composer'

    export default {

        name: "AppTweetReplyCompose",

        mixins: [
            composer
        ],

        props: {
            tweet: {
                required: true,
                type: Object
            }
        },

        methods: {
            async postTweet() {
                let data = {
                    id: this.tweet.id,
                    form: this.form
                }

                await this.$store.dispatch('timeline/replyTweet', data)

                this.$emit('success')
            }
        }
    }
</script>