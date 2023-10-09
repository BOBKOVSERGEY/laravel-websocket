<script setup>
import {Head} from '@inertiajs/vue3';
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {ref} from "vue";

const props = defineProps({
    messages: {
        type: Array,
    },
});

const model = ref({
    body: ''
});

const store = () => {
    axios.post('/message', model.value).then(
        res => {
            props.messages.unshift(res.data);
            model.value.body = '';
        }
    )
}
</script>
<template>
    <Head title="Message"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Message</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div
                        v-if="messages?.length"
                        class="flex flex-col  p-6 text-gray-900">
                        <div
                            class=""
                            v-for="message in messages" :key="message.id">
                            <div class="bg-slate-300 inline-flex p-2 rounded ">
                                {{ message.body }}
                            </div>
                            <div>
                            <span
                                class="bg-blue-100 text-blue-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-blue-400 border border-blue-400">
                                <svg class="w-2.5 h-2.5 mr-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                     viewBox="0 0 20 20">
                                <path
                                    d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm3.982 13.982a1 1 0 0 1-1.414 0l-3.274-3.274A1.012 1.012 0 0 1 9 10V6a1 1 0 0 1 2 0v3.586l2.982 2.982a1 1 0 0 1 0 1.414Z"/>
                                 </svg>
                                {{ message.created_at }}
                            </span>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="flex mt-3">
                    <textarea
                        v-model="model.body"
                        class="
                        border-gray-300 focus:border-indigo-500
                        focus:ring-indigo-500
                        rounded-md shadow-sm mt-1 block w-full"
                    >
                    </textarea>
                    <button
                        @click.prevent="store"
                        class="
                        inline-flex items-center px-4 py-2 bg-gray-800
                        border border-transparent
                        rounded-md font-semibold text-xs
                        text-white uppercase tracking-widest hover:bg-gray-700
                        focus:bg-gray-700 active:bg-gray-900 focus:outline-none
                        focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition
                        ease-in-out duration-150 ml-3">
                        Send
                    </button>
                </div>

            </div>
        </div>
    </AuthenticatedLayout>
</template>
