<template>
    <div>

        <div>
            <app-tweet
                v-if="parents(id)"
                :tweet="t"
                v-for="t in parents(id)"
            />
        </div>

        <div class="text-lg border-b-8 border-t-8 border-gray-800">
            <app-tweet v-if="tweet(id)" :tweet="tweet(id)" />
        </div>

        <div>
            <app-tweet
                v-if="replies(id)"
                :tweet="t"
                v-for="t in replies(id)"
            />
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
                tweet: 'conversations/tweet',
                parents: 'conversations/parents',
                replies: 'conversations/replies',
            })
        },

        methods: {
            ...mapActions({
                getTweets: 'conversations/getTweets'
            })
        },

        mounted() {
            this.getTweets(`/api/tweets/${this.id}`)
            this.getTweets(`/api/tweets/${this.id}/replies`)
        }
    }
</script>

<style scoped>

</style>