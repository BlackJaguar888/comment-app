<template>
    <modal :show="show" :max-width="maxWidth" :closeable="closeable" @close="close">
        <form @submit.prevent="$emit('submitted')">
            <div class="px-4 sm:px-6 py-4 bg-white rounded-t-lg dark:bg-gray-800">
                <div class="text-md dark:text-gray-300">
                    <slot name="title">
                    </slot>
                </div>

                <div class="mt-4 text-sm dark:text-gray-600 grid grid-cols-6 gap-6">
                    <slot name="content">
                    </slot>
                </div>
            </div>

            <div class="px-6 py-4 bg-gray-100 rounded-b-lg text-right dark:bg-gray-700">
                <slot name="footer">
                </slot>
            </div>
        </form>
    </modal>
</template>

<script>
import {defineComponent} from 'vue'
import Modal from './Modal'

export default defineComponent({
    emits: ['close'],
    components: {
        Modal,
    },

    props: {
        show: {
            default: false
        },
        maxWidth: {
            default: '2xl'
        },
        closeable: {
            default: true
        },
    },

    methods: {
        close() {
            this.$emit('close')
        },
    }
})
</script>
