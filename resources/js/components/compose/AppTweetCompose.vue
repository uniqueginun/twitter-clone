<template>
    <form @submit.prevent="tweet()" class="flex">
        <img :src="$user.avatar" class="mr-3 w-12 h-12 rounded-full" />
        <div class="flex-grow">

            <app-tweet-compose-textarea
                v-model="form.body"
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
                            id="media-compose"
                            @selected="handleMediaSelected"
                        />
                    </li>
                </ul>
                <div class="flex items-center justify-end">
                    <app-tweet-compose-limit-indicator
                        :charactersAmount="charactersAmount"
                        v-show="charactersAmount"
                    />
                    <button type="submit" class="bg-blue-600 rounded-full text-gray-300 text-center px-4 py-3 font-bold leading-none">Tweet</button>
                </div>
            </div>
        </div>
    </form>
</template>

<script>

    import composer from '../../mixins/composer'

    export default {

        name: "AppTweetCompose",

        mixins: [
            composer
        ],

        methods: {
            async postTweet() {
                await axios.post('/api/tweets', this.form)
            }
        }
    }
</script>