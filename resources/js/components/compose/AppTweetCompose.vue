<template>
    <form @submit.prevent="tweet()" class="flex">
        <img :src="$user.avatar" class="mr-3 w-12 h-12 rounded-full" />
        <div class="flex-grow">
            <app-tweet-compose-textarea
                v-model="form.body"
            />

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
                },

                mediaTypes: {}
            }
        },

        methods: {
            async tweet() {

                let uploadedMediaIds = await this.uploadMedia();

                this.form.media = uploadedMediaIds.data.data.map(media => media.id);

                await axios.post('/api/tweets', this.form);

                this.emptyFormData();
                
            },

            emptyFormData() {
                this.form.body = ''
                this.form.media = []
                this.media.images = []
                this.media.video = null
            },

            async uploadMedia() {
                return await axios.post('/api/media', this.buildMediaForm(), {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
            },

            buildMediaForm() {

                let form = new FormData();

                if (this.media.images.length) {
                    this.media.images.forEach((img, index) => {
                        form.append(`media[${index}]`, img);
                    });
                }

                if (this.media.video) {
                    form.append('media[0]', this.media.video);
                }

                return form;
            },

            handleMediaSelected(files) {
                Array.from(files).slice(0, 4).forEach(file => {
                    if(this.mediaTypes.images.includes(file.type)) {
                        this.media.images.push(file)
                    }
                    if (this.mediaTypes.video.includes(file.type)) {
                        this.media.video = file
                    }
                })

                if (this.media.video) {
                    this.media.images = []
                }
            },

            async loadMediaTypes() {
                const { data } = await axios.get('/api/media/types');
                this.mediaTypes = data.data;
            },

            removeImage(img) {
                this.media.images = this.media.images.filter(image => image !== img)
            }
        },

        computed: {
            charactersAmount() {
                return parseInt(this.form.body.length);
            }
        },

        mounted() {
            this.loadMediaTypes();
        }
    }
</script>

<style scoped>

</style>