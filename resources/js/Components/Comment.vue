<template>
    <div class="flex w-full items-center font-sans px-4 py-6 border-b-2">
        <div class="flex-1 px-2">
            <p class="text-base font-bold text-base md:text-xl leading-none mb-2">{{ item.user_name }}</p>
            <p class="text-gray-600 text-xs md:text-base">{{ item.text }}</p>
        </div>
        <div class="justify-end" v-if="item.level == 1 || item.level == 2">
            <button @click="$emit('openReplyModal', item)"
                    class="bg-transparent border border-gray-500 hover:border-green-500 text-xs text-gray-500
                    hover:text-green-500 font-bold py-2 px-4 rounded-full">
                Reply
            </button>
        </div>
    </div>
    <div v-if="hasReply" :class="'level-' + (item.level + 1)">
        <Comment
            v-for="reply in item.replies"
            :key="reply.id"
            :item="reply"
            @open-reply-modal="this.openReplyModal"
        />
    </div>
</template>

<style>
    .level-2 {
        margin-left: 50px;
    }

    .level-3 {
        margin-left: 100px;
    }
</style>

<script>
export default {
    name: 'Comment',
    emits: ['openReplyModal'],
    props: {
        item: Object,
        spacing: {
            type: Number,
            default: 0
        }
    },
    data() {
        return {

        }
    },
    computed: {
        hasReply() {

            let reply = this.item.replies
            return reply && reply.length > 0
        },

    },
    methods: {

        openReplyModal(cm) {

            this.$emit('open-reply-modal', cm);
        }
    }
}
</script>
