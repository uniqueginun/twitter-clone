<template>
    <div class="flex flex-wrap mb-4">
        <div class="flex-grow relative w-6/12"
             v-for="(image, index) in images"
             :key="index"
        >
            <img :src="generateImagePreview(image)" />
        </div>
    </div>
</template>

<script>
    export default {
        name: "AppTweetImagePreview",

        props: {
            images: {
                required: false,
                type: Array
            }
        },

        methods: {
            generateImagePreview: (image) => {
                return URL.createObjectURL(image);
            }
        }
    }
</script>

<style scoped>

</style>