<script setup>
import axios from 'axios';
import { Loader2 } from 'lucide-vue';
import { getCurrentInstance, ref } from 'vue';

const router = getCurrentInstance().proxy.$router;

const isBusy = ref(false);
const errors = ref({});
const name = ref('');
const email = ref('');
const password = ref('');
const repeatedPassword = ref('');
const currencies = ref([]);
const currency = ref(1);

const fetchCurrencies = () => {
    axios
        .get('/api/currencies')
        .then(response => {
            currencies.value = response.data;
        });
};

const register = () => {
    isBusy.value = true;

    axios
        .post('/api/register', { name: name.value, email: email.value, password: password.value, password_confirmation: repeatedPassword.value, currency: currency.value })
        .then(response => {
            const json = response.data;

            if (json.success) {
                router.push({ name: 'login' });
            }
        })
        .catch(error => {
            isBusy.value = false;
            password.value = '';
            repeatedPassword.value = '';

            if (error.response && error.response.data) {
                const json = error.response.data;

                if (json.errors) {
                    errors.value = json.errors;
                }
            }
        });
};

fetchCurrencies();
</script>

<template>
    <div class="flex items-center justify-center min-h-screen">
        <div class="flex-1 max-w-sm">
            <div class="p-5 space-y-5 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg">
                <div>
                    <label class="block mb-2 text-sm dark:text-white">{{ $t('name') }}</label>
                    <input class="w-full px-3.5 py-2.5 text-sm dark:text-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg" type="text" v-model="name" @keyup.enter="register" />
                    <div v-if="errors.name" class="mt-1.5 text-sm text-red-500">{{ errors.name[0] }}</div>
                </div>
                <div>
                    <label class="block mb-2 text-sm dark:text-white">{{ $t('email') }}</label>
                    <input class="w-full px-3.5 py-2.5 text-sm dark:text-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg" type="email" v-model="email" @keyup.enter="register" />
                    <div v-if="errors.email" class="mt-1.5 text-sm text-red-500">{{ errors.email[0] }}</div>
                </div>
                <div>
                    <label class="block mb-2 text-sm dark:text-white">{{ $t('password') }}</label>
                    <input class="w-full px-3.5 py-2.5 text-sm dark:text-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg" type="password" v-model="password" @keyup.enter="register" />
                    <div v-if="errors.password" class="mt-1.5 text-sm text-red-500">{{ errors.password[0] }}</div>
                </div>
                <div>
                    <label class="block mb-2 text-sm dark:text-white">{{ $t('repeatPassword') }}</label>
                    <input class="w-full px-3.5 py-2.5 text-sm dark:text-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg" type="password" v-model="repeatedPassword" @keyup.enter="register" />
                </div>
                <div>
                    <label class="block mb-2 text-sm dark:text-white">{{ $t('currency') }}</label>
                    <select class="w-full px-3.5 py-2.5 text-sm dark:text-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg appearance-none" v-model="currency">
                        <option v-for="currency in currencies" :value="currency.id">{{ currency.name }} (<span v-html="currency.symbol"></span>)</option>
                    </select>
                </div>
                <button class="w-full py-3 text-sm text-white bg-gray-900 dark:bg-gray-950 rounded-lg" @click="register">
                    <span v-if="!isBusy">{{ $t('register') }}</span>
                    <div v-if="isBusy" class="flex justify-center h-5">
                        <Loader2 class="animate-spin" :size="18" :strokeWidth="2.4" />
                    </div>
                </button>
            </div>
            <div class="mt-4 text-sm text-center">
                <router-link class="text-gray-500 dark:text-white" :to="{ name: 'login' }">Already using Budget? Log in.</router-link>
            </div>
        </div>
    </div>
</template>
