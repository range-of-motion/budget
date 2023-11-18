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
        <div class="flex-1 max-w-sm p-5 space-y-5 bg-white border rounded-lg">
            <div>
                <label class="block mb-2 text-sm">E-mail</label>
                <input class="w-full px-3.5 py-2.5 text-sm border rounded-lg" type="email" v-model="email" />
            </div>
            <div>
                <label class="block mb-2 text-sm">Password</label>
                <input class="w-full px-3.5 py-2.5 text-sm border rounded-lg" type="password" v-model="password" @keyup.enter="logIn" />
            </div>
            <button class="w-full py-3 text-sm text-white bg-gray-900 rounded-lg" @click="logIn">Log in</button>
        </div>
    </div>
</template>
