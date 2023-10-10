<script setup>

import {Head, usePage} from '@inertiajs/vue3';
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {onMounted, ref} from "vue";
const authUser = usePage().props.auth.user;

const props = defineProps({
    user: {
        type: Object
    }
})

const likeString = ref('');
const sendLike = () => {
    axios.post(`/users/${props.user?.id}`, {from_id: authUser.id})
        .then(res => {
            likeString.value = res?.data?.likeString
        })
}

onMounted(() => {
    Echo.private(`send_like_${authUser.id}`)
        .listen('.send_like', res => {
            likeString.value = res.likeString
        })
});
</script>
<template>
    <Head title="User"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Message</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                    {{user.name}}<br>


                <button
                    @click.prevent="sendLike"
                    class="inline-flex
                items-center px-4 py-2
                 bg-gray-800 border border-transparent
                 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    Like
                </button>
                <div v-if="likeString">
                    {{ likeString }}
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
