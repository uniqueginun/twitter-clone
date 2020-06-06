<template>
    <div class="container">
        {{ user }}
    </div>
</template>

<script>
    export default {
        data() {
            return {
                user: null
            }
        },
        methods: {
            async getUser() {
                const {data} = await axios.get('/api/user');
                console.log(data);
                this.user = data;
            }
        },
        mounted() {
            this.getUser();
        }
    }
</script>
