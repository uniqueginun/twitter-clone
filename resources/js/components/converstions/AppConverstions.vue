<template>
    <div>

        <div>
            parents
        </div>

        <div class="text-lg border-b-8 border-t-8 border-gray-800">
            <app-tweet v-if="tweet(id)" :tweet="tweet(id)" />
        </div>

        <div>
            replies
        </div>

    </div>
</template>

<script>
    import { mapGetters, mapActions } from 'vuex'

    export default {
        name: "AppConverstions",

        props: {
            id: {
                type: String,
                required: true
            }
        },

        computed: {
            ...mapGetters({
                tweet: 'conversations/tweet'
            })
        },

        methods: {
            ...mapActions({
                getTweets: 'conversations/getTweets'
            })
        },

        mounted() {
            this.getTweets(`/api/tweets/${this.id}`)
            console.log(this.tweet(this.id))
        }
    }
</script>

<style scoped>

</style>