<template>
    <div>
        <app-notification
            v-for="notification in notifications"
            :key="notification.id"
            :notification="notification"
        />

        <div
            v-if="notifications.length"
            v-observe-visibility="{
               callback: handleScrolledToBottom
            }"
        >
        </div>
    </div>
</template>

<script>
    import {mapGetters, mapActions, mapMutations} from 'vuex';

    export default {
        name: "AppNotifications",

        data: () => {
            return {
                page: 1,
                lastPage: 1
            }
        },

        computed: {
            ...mapGetters({
                notifications: 'notifications/notifications'
            }),

            uriWithPage() {
                return `/api/notifications?page=${this.page}`;
            }
        },

        methods: {
            ...mapActions({
                getNotifications: 'notifications/getNotifications'
            }),

            ...mapMutations({
                PUSH_NOTIFICATIONS: 'notifications/PUSH_NOTIFICATIONS'
            }),

            loadNotifications() {
                this.getNotifications(this.uriWithPage)
                    .then(response => this.lastPage = response.meta.last_page)
            },

            handleScrolledToBottom(visible) {
                if (!visible || this.lastPage === this.page) return;
                this.page++;
                this.loadNotifications();
            }
        },

        mounted() {

            this.loadNotifications();

            /*Echo.private(this.channelName)
                .listen('.TweetWasCreated', (e) => {
                    this.PUSH_TWEETS([e]);
                });*/
        }
    }
</script>