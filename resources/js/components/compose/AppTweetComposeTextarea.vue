<template>
    <textarea
            ref="composer"
            class="bg-gray-900 w-full outline-none text-gray-300 text-lg resize-none mb-2"
            placeholder="what's happening?"
            autofocus
            @input="$emit('input', $event.target.value); resize($event);"
            :value="value"
    ></textarea>
</template>

<script>
    export default {
        name: "AppTweetComposeTextarea",

        props: {
            value: {
                type: String,
                required: false
            }
        },

        methods: {
            resize(e) {
                this.$refs.composer.style.height = 'auto';
                this.$refs.composer.style.height = `${e.target.scrollHeight}px`;
            }
        }
    }
</script>

<style scoped>

</style>