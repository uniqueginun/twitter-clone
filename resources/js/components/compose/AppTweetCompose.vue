<template>
    <form @submit.prevent="tweet()" class="flex">
        <div class="mr-3">
            <img :src="$user.avatar" class="w-12 rounded-full" />
        </div>
        <div class="flex-grow">
            <app-tweet-compose-textarea
                v-model="form.body"
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

    export default {
        name: "AppTweetCompose",
        data: () => {
            return {
                form: {
                    body: "",
                    media: []
                },

                media: {
                    images: [],
                    video: null
                }
            }
        },

        methods: {
            async tweet() {
                await axios.post('/api/tweets', this.form);
                this.form.body = '';
            },

            handleMediaSelected(files) {
                console.log(files)
            }
        },

        computed: {
            charactersAmount() {
                return parseInt(this.form.body.length);
            }
        }
    }
</script>

<style scoped>

</style>