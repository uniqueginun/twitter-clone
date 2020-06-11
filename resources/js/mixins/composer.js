export default {

    data: () => {
        return {
            form: {
                body: "",
                media: []
            },

            media: {
                images: [],
                video: null,
                progress: 0
            },

            mediaTypes: {}
        }
    },

    methods: {
        async submitTweet() {

            if (this.media.images.length || this.media.video) {
                let uploadedMediaIds = await this.uploadMedia();
                this.form.media = uploadedMediaIds.data.data.map(media => media.id);
            }

            await this.postTweet();

            this.emptyFormData();

        },

        emptyFormData() {
            this.form.body = ''
            this.form.media = []
            this.media.images = []
            this.media.video = null
            this.media.progress = 0
        },

        async uploadMedia() {
            return await axios.post('/api/media', this.buildMediaForm(), {
                headers: {
                    'Content-Type': 'multipart/form-data'
                },

                onUploadProgress: this.handleUploadProgress
            })
        },

        handleUploadProgress({ loaded, total }) {
            this.media.progress = parseInt(Math.round((loaded / total) * 100));
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