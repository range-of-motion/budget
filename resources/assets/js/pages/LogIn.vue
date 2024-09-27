<script setup>
import { Link, router } from '@inertiajs/vue3';
import { reactive } from 'vue';

defineProps({
    register_url: String,
});

const form = reactive({
    email: '',
    password: '',
});

const logIn = () => {
    router.post('/log-in', form);
};
</script>

<template>
    <div class="flex items-center justify-center min-h-screen">
        <div class="flex-1 max-w-sm">
            <div class="p-5 space-y-5 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg">
                <div>
                    <label class="mb-2 block text-sm dark:text-white">E-mail</label>
                    <input class="w-full px-3.5 py-2.5 text-sm dark:text-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg" type="email" v-model="form.email" @keyup.enter="logIn" />
                </div>
                <div>
                    <label class="mb-2 block text-sm dark:text-white">Password</label>
                    <input class="w-full px-3.5 py-2.5 text-sm dark:text-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg" type="password" v-model="form.password" @keyup.enter="logIn" />
                </div>
                <button class="px-4 py-3 leading-none font-medium text-sm text-white bg-gray-900 rounded-lg" @click="logIn">Log in</button>
            </div>
            <div class="mt-4 text-center">
                <Link class="text-sm text-gray-500 dark:text-white" :href="register_url">First time here? Register.</Link>
            </div>
        </div>
    </div>
</template>
