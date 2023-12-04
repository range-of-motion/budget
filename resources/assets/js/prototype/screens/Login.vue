<script setup>
import axios from 'axios';
import { getCurrentInstance, ref } from 'vue';

const router = getCurrentInstance().proxy.$router;

const email = ref('');
const password = ref('');

const logIn = () => {
    axios
        .post('/api/log-in', { email: email.value, password: password.value })
        .then(response => {
            const json = response.data;

            if (json.token) {
                localStorage.setItem('api_key', json.token);
                localStorage.setItem('theme', json.theme);

                const e = new Event('themeChanged');
                document.dispatchEvent(e);

                router.push('dashboard');
            }

            if (json.error) {
                alert('Unable to log in');
            }
        })
        .catch(() => {
            alert('Unable to log in');
        });
};
</script>

<template>
    <div class="flex items-center justify-center min-h-screen">
        <div class="flex-1 max-w-sm">
            <div class="p-5 space-y-5 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg">
                <div>
                    <label class="block mb-2 text-sm dark:text-white">E-mail</label>
                    <input class="w-full px-3.5 py-2.5 text-sm dark:text-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg" type="email" v-model="email" />
                </div>
                <div>
                    <label class="block mb-2 text-sm dark:text-white">Password</label>
                    <input class="w-full px-3.5 py-2.5 text-sm dark:text-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg" type="password" v-model="password" @keyup.enter="logIn" />
                </div>
                <button class="w-full py-3 text-sm text-white bg-gray-900 dark:bg-gray-950 rounded-lg" @click="logIn">Log in</button>
            </div>
            <div class="mt-5 text-sm text-center dark:text-white">{{ versionNumber }}</div>
        </div>
    </div>
</template>
