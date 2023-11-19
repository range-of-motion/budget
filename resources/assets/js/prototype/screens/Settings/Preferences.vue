<script setup>
import axios from 'axios';
import { onMounted, ref } from 'vue';

import Navigation from '../../components/Navigation.vue';

const language = ref('en');
const theme = ref('light');

const retrieve = () => {
    axios
        .get('/api/settings', { headers: { 'api-key': localStorage.getItem('api_key') } })
        .then(response => {
            language.value = response.data.language;
            theme.value = response.data.theme;
        });
};

const update = () => {
    axios
        .post('/api/settings', { language: language.value, theme: theme.value }, { headers: { 'api-key': localStorage.getItem('api_key') } })
        .then(() => {
            // Done
        })
        .catch(() => {
            alert('Unable to save');
        });
};

onMounted(() => retrieve());
</script>

<template>
    <div>
        <Navigation />
        <div class="my-10 mx-auto max-w-3xl">
            <div class="p-5 bg-white border border-gray-200 rounded-lg">
                <div class="space-y-5 max-w-xs">
                    <div>
                        <div class="mb-2 text-sm">Language</div>
                        <select class="px-3.5 py-2.5 w-full text-sm border border-gray-200 rounded-lg appearance-none" v-model="language" @change="update">
                            <option value="en">English</option>
                            <option value="nl">Dutch</option>
                            <option value="dk">Danish</option>
                            <option value="de">German</option>
                            <option value="fr">French</option>
                            <option value="pt">Portuguese</option>
                            <option value="ru">Russian</option>
                        </select>
                    </div>
                    <div>
                        <div class="mb-2 text-sm">Theme</div>
                        <select class="px-3.5 py-2.5 w-full text-sm border border-gray-200 rounded-lg appearance-none" v-model="theme" @change="update">
                            <option value="light">Light</option>
                            <option value="dark">Dark</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
