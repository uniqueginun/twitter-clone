<template>
    <form @submit.prevent="submitTweet()" class="flex">
        <img :src="$user.avatar" class="mr-3 w-12 h-12 rounded-full" />
        <div class="flex-grow">

            <app-tweet-compose-textarea
                v-model="form.body"
                placeholder="what do you think?"
            />

            <div class="flex justify-between">
                <ul class="flex items-center">

                </ul>
                <div class="flex items-center justify-end">
                    <app-tweet-compose-limit-indicator
                        :charactersAmount="charactersAmount"
                        v-show="charactersAmount"
                    />
                    <button
                      type="submit"
                      class="bg-blue-600 rounded-full text-gray-300 text-center px-4 py-3 font-bold leading-none"
                    >
                      Retweet
                    </button>
                </div>
            </div>
        </div>
    </form>
</template>

<script>

    import composer from '../../mixins/composer'

    export default {

        name: "AppTweetRetweetCompose",

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
                    body: this.form.body
                }

                await this.$store.dispatch('timeline/quoteTweet', data)

                this.$emit('success')
            }
        }
    }

</script>