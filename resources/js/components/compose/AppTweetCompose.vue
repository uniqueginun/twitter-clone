<template>
    <form class="flex">
        <div class="mr-3">
            <img :src="$user.avatar" class="w-12 rounded-full" />
        </div>
        <div class="flex-grow">
            <textarea class="bg-gray-900 outline-none text-gray-300 text-lg resize-none mb-2"
                      placeholder="what's happening?"
                      autofocus
            ></textarea>
            <div class="flex justify-between">
                <div>Actions</div>
                <div>
                    <button type="submit" class="bg-blue-600 rounded-full text-gray-300 text-center px-4 py-3 font-bold leading-none">Tweet</button>
                </div>
            </div>
        </div>
    </form>
</template>

<script>
    export default {
        name: "AppTweetCompose"
    }
</script>

<style scoped>

</style>