<script setup>
import axios from 'axios';
import { Loader2 } from 'lucide-vue';
import { getCurrentInstance, ref } from 'vue';

const router = getCurrentInstance().proxy.$router;

const isBusy = ref(false);
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
                password.value = '';

                alert('Unable to log in');
            }
        })
        .catch(() => {
            isBusy.value = false;
            password.value = '';

            alert('Unable to log in');
        });
};
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
            <div class="mt-5 text-sm text-center dark:text-white">{{ versionNumber }}</div>
        </div>
    </div>
</template>
