<script setup>
import { Link, router } from '@inertiajs/vue3';
import { reactive } from 'vue';

defineProps({
    currencies: Array,
    log_in_url: String,
    errors: Object,
});

const form = reactive({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    currency_id: 1,
});

const register = () => {
    router.post('/register', form);
};
</script>


<template>
    <div class="flex items-center justify-center min-h-screen">
        <div class="flex-1 max-w-sm">
            <div class="p-5 space-y-5 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg">
                <div>
                    <label class="mb-2 block text-sm dark:text-white">Name</label>
                    <input class="w-full px-3.5 py-2.5 text-sm dark:text-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg" type="text" v-model="form.name" @keyup.enter="register" />
                    <div v-if="errors.name" class="mt-2 text-sm text-red-500">{{ errors.name }}</div>
                </div>
                <div>
                    <label class="mb-2 block text-sm dark:text-white">E-mail</label>
                    <input class="w-full px-3.5 py-2.5 text-sm dark:text-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg" type="email" v-model="form.email" @keyup.enter="register" />
                    <div v-if="errors.email" class="mt-2 text-sm text-red-500">{{ errors.email }}</div>
                </div>
                <div>
                    <label class="mb-2 block text-sm dark:text-white">Password</label>
                    <input class="w-full px-3.5 py-2.5 text-sm dark:text-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg" type="password" v-model="form.password" @keyup.enter="register" />
                    <div v-if="errors.password" class="mt-2 text-sm text-red-500">{{ errors.password }}</div>
                </div>
                <div>
                    <label class="mb-2 block text-sm dark:text-white">Repeat password</label>
                    <input class="w-full px-3.5 py-2.5 text-sm dark:text-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg" type="password" v-model="form.password_confirmation" @keyup.enter="register" />
                </div>
                <div>
                    <label class="mb-2 block text-sm dark:text-white">Currency</label>
                    <select class="w-full px-3.5 py-2.5 text-sm dark:text-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg appearance-none" v-model="form.currency_id">
                        <option v-for="currency in currencies" :key="currency.id" :value="currency.id" v-html="currency.name + ' (' + currency.symbol + ')'"></option>
                    </select>
                </div>
                <button class="px-4 py-3 leading-none font-medium text-sm text-white bg-gray-900 rounded-lg" @click="register">Register</button>
            </div>
            <div class="mt-4 text-center">
                <Link class="text-sm text-gray-500 dark:text-white" :href="log_in_url">Already using Budget? Log in.</Link>
            </div>
        </div>
    </div>
</template>
