<template>
    <a href="#" class="flex items-center text-base" @click.prevent="fireReplyModal">
        <svg viewBox="0 0 24 24" class="fill-current text-gray-600 w-5 mr-2" width="24" height="24">
            <path d="M2 15V5c0-1.1.9-2 2-2h16a2 2 0 0 1 2 2v15a1 1 0 0 1-1.7.7L16.58 17H4a2 2 0 0 1-2-2zM20 5H4v10h13a1 1 0 0 1 .7.3l2.3 2.29V5z"/>
        </svg>
        <span class="text-gray-600">{{ tweet.replies_count }}</span>
    </a>
</template>

<script>
    import AppTweetReplyModal from "../../modals/AppTweetReplyModal";
    import modal from '../../../mixins/modal'

    export default {
        name: "AppTweetReplyAction",

        mixins: [modal],

        props: {
            tweet: {
                required: true,
                type: Object
            }
        },

        methods: {
            fireReplyModal() {
                this.fireModal(AppTweetReplyModal, { tweet: this.tweet })
            }
        }
    }
</script>

<style scoped>

</style>