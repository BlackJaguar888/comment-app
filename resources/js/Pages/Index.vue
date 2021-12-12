<template>

    <!--Container-->
    <div class="container w-full md:max-w-3xl mx-auto pt-20">

        <div class="w-full px-4 md:px-6 text-xl text-gray-800 leading-normal" style="font-family:Georgia,serif;">

            <!--Title-->
            <div class="font-sans">

                <h1 class="font-bold font-sans break-normal text-gray-900 pt-6 pb-2 text-3xl md:text-4xl">
                    Blog
                </h1>
                <p class="text-sm md:text-base font-normal text-gray-600">Published at: {{ currentDate() }}</p>
            </div>


            <!--Post Content-->


            <!--Lead Para-->
            <p class="py-6">
                👋 Welcome fellow <a class="text-green-500 no-underline hover:underline"
                                     href="#">Post</a> and miminal Nested Comment system.
            </p>

            <p class="py-6">The basic blog page layout is available and all using the default Tailwind CSS classes
                (although there are a few hardcoded style tags). If you are going to use this in your project, you will
                want to convert the classes into components.</p>

            <p class="py-6">Sed dignissim lectus ut tincidunt vulputate. Fusce tincidunt lacus purus, in mattis tortor
                sollicitudin pretium. Phasellus at diam posuere, scelerisque nisl sit amet, tincidunt urna. Cras nisi
                diam, pulvinar ut molestie eget, eleifend ac magna.</p>


            <blockquote class="border-l-4 border-green-500 italic my-8 pl-8 md:pl-12">Example of blockquote - Lorem
                ipsum dolor sit amet, consectetur adipiscing elit. Aliquam at ipsum eu nunc commodo posuere et sit amet
                ligula.
            </blockquote>

            <p class="py-6">Example Image:</p>
            <img src="img/blog.png" class="object-cover w-full">
            <!--/ Post Content-->

        </div>

        <!--Tags -->
        <div class="text-base md:text-sm text-gray-500 px-4 py-6">
            Tags: <a href="#" class="text-base md:text-sm text-green-500 no-underline hover:underline">Link</a> . <a
            href="#" class="text-base md:text-sm text-green-500 no-underline hover:underline">Link</a>
        </div>

        <!--Divider-->
        <hr class="border-b-2 border-gray-400 mb-8 mx-4">

        <!--Comments-->
        <div class="px-4">
            <div class="font-sans rounded-lg shadow-xl p-4">

                <h2 class="font-bold break-normal text-gray-600 text-sm md:text-base">Comments</h2>
                <button type="submit" class="flex-1 mt-4 block md:inline-block appearance-none bg-green-500
                    text-white tracking-wider px-2 py-2 rounded shadow hover:bg-green-400"
                        @click.native="openSubmitModal">
                    Submit a comment
                </button>
            </div>
        </div>
        <!--Comments-->


        <!--Comments-->
        <Comment v-for="item in comments" :key="item.id" :item="item" @open-reply-modal="openReplyModal" />
        <!--/Comments-->

        <form-modal :show="isSubmitModalOpen" @close="closeModal">
            <template #title>
                Submit a comment
            </template>
            <template #content>
                <div class="form col-span-6 sm:col-span-6">
                    <div class="sm:pb-1">
                        <label for="user_name" class="block text-gray-200 text-sm font-bold mb-2">Your Name:</label>
                        <input id="user_name" name="user_name" class="shadow appearance-none border rounded w-full py-2
                        px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                               v-model="form.user_name" autofocus>
                    </div>
                    <div class="sm:pb-1">
                        <label for="text" class="block text-gray-200 text-sm font-bold mb-2">Comment:</label>
                        <textarea id="text" name="text" class="shadow appearance-none border rounded w-full py-2
                        px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" v-model="form.text"></textarea>
                    </div>
                </div>
            </template>
            <template #footer>
                <button @click.native="closeModal" class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-300
                border border-gray-300 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-800 uppercase
                tracking-widest shadow-sm hover:text-gray-500 dark:hover:text-gray-900 focus:outline-none focus:border-blue-300
                focus:ring focus:ring-blue-200 active:text-gray-800 active:bg-gray-50 disabled:opacity-25 transition">
                    Cancel
                </button>
                <button class="ml-2 inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-800 border
                border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700
                dark:hover:bg-gray-900 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300
                disabled:opacity-25 transition"
                            @click.native="submit()"
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing">
                    Submit
                </button>
            </template>
        </form-modal>
    </div>
    <!--/container-->

</template>

<script>

import {defineComponent} from 'vue'
import FormModal from "../Components/FormModal";
import Comment from "../Components/Comment";

export default defineComponent({

    name: "Index",

    components: {
        Comment,
        FormModal,
    },

    data() {
        return {

            form: this.$inertia.form({
                user_name: '',
                reply_id: null,
                level: 1,
                text: ''
            }),
            formReplyId: null,
            formLevel: 1,
            isSubmitModalOpen: false,
        }
    },

    props: {

        comments: Object,
    },

    methods: {

        // Show Current Date as Post Published Date
        currentDate() {
            const current = new Date();
            const date = `${current.getDate()}/${current.getMonth() + 1}/${current.getFullYear()}`;
            return date;
        },

        // Submit Comment
        submit() {
            this.form.post('comment/store', {
                bag: '',
                resetOnSuccess: true,
                onSuccess: () => {
                    this.closeModal()
                },
            })
        },

        // Show Submit new Comment Modal
        openSubmitModal() {

            this.isSubmitModalOpen = true;
        },

        // Show Submit Reply to a Comment Modal
        openReplyModal(item) {
            this.form.reply_id = item.id
            this.form.level = item.level + 1

            this.isSubmitModalOpen = true;
        },

        // Close Submit/Reply Modal
        closeModal() {

            this.isSubmitModalOpen = false;
            this.form.clearErrors()
            this.form.reset()
        },
    }
});

</script>
