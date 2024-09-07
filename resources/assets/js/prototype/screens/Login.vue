<script setup>
import axios from 'axios';
import { XCircle, Loader2 } from 'lucide-vue';
import { getCurrentInstance, ref, watch } from 'vue';

const router = getCurrentInstance().proxy.$router;

const isBusy = ref(false);
const showError = ref(false);
const email = ref('');
const password = ref('');

const logIn = () => {
    isBusy.value = true;

    axios
        .post('/api/log-in', { email: email.value, password: password.value })
        .then(response => {
            const json = response.data;

            if (json.token) {
                localStorage.setItem('api_key', json.token);
                localStorage.setItem('language', json.language);
                localStorage.setItem('theme', json.theme);

                document.dispatchEvent(new Event('settingsChanged'));

                router.push('dashboard');
            }

            if (json.error) {
                isBusy.value = false;
                showError.value = true;
                password.value = '';
            }
        })
        .catch(() => {
            isBusy.value = false;
            showError.value = true;
            password.value = '';
        });
};

watch(showError, value => {
    if (value === true) {
        setTimeout(() => {
            showError.value = false;
        }, 5000);
    }
});
</script>

<template>
    <div class="flex items-center justify-center min-h-screen">
        <div class="flex-1 max-w-sm">
            <div class="p-5 space-y-5 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg">
                <div>
                    <label class="block mb-2 text-sm dark:text-white">{{ $t('email') }}</label>
                    <input class="w-full px-3.5 py-2.5 text-sm dark:text-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg" type="email" v-model="email" />
                </div>
                <div>
                    <label class="block mb-2 text-sm dark:text-white">{{ $t('password') }}</label>
                    <input class="w-full px-3.5 py-2.5 text-sm dark:text-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg" type="password" v-model="password" @keyup.enter="logIn" />
                </div>
                <button class="w-full py-3 text-sm text-white bg-gray-900 dark:bg-gray-950 rounded-lg" @click="logIn">
                    <span v-if="!isBusy">{{ $t('logIn') }}</span>
                    <div v-if="isBusy" class="flex justify-center h-5">
                        <Loader2 class="animate-spin" :size="18" :strokeWidth="2.4" />
                    </div>
                </button>
            </div>
            <div class="mt-4 text-sm text-center">
                <router-link class="text-gray-500 dark:text-white" :to="{ name: 'register' }">First time here? Register.</router-link>
            </div>
        </div>
        <div v-if="showError" class="absolute top-0 left-0 right-0 flex">
            <div class="mt-10 mx-auto py-3 px-5 flex bg-white border border-gray-200 rounded-lg shadow-sm">
                <XCircle class="text-red-600" :size="20" />
                <div class="ml-3 text-sm">Unable to log in</div>
            </div>
        </div>
    </div>
</template>
