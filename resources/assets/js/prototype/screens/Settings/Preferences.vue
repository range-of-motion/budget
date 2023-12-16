<script setup>
import axios from 'axios';
import { onMounted, ref } from 'vue';

import Navigation from '../../components/Navigation.vue';

const language = ref('en');
const theme = ref('light');
const weeklyReport = ref(false);

const retrieve = () => {
    axios
        .get('/api/settings', { headers: { 'api-key': localStorage.getItem('api_key') } })
        .then(response => {
            language.value = response.data.language;
            theme.value = response.data.theme;
            weeklyReport.value = response.data.weekly_report;
        });
};

const toggleWeeklyReport = () => {
    weeklyReport.value = !weeklyReport.value;

    update();
};

const update = () => {
    axios
        .post('/api/settings', { language: language.value, theme: theme.value, weekly_report: weeklyReport.value }, { headers: { 'api-key': localStorage.getItem('api_key') } })
        .then(response => {
            // Done

            localStorage.setItem('language', response.data.language);
            localStorage.setItem('theme', response.data.theme);

            document.dispatchEvent(new Event('settingsChanged'));
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
            <div class="p-5 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg">
                <div class="space-y-5 max-w-xs">
                    <div>
                        <div class="mb-2 text-sm dark:text-white">{{ $t('language') }}</div>
                        <select class="px-3.5 py-2.5 w-full text-sm dark:text-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg appearance-none" v-model="language" @change="update">
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
                        <div class="mb-2 text-sm dark:text-white">{{ $t('theme') }}</div>
                        <select class="px-3.5 py-2.5 w-full text-sm dark:text-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg appearance-none" v-model="theme" @change="update">
                            <option value="light">Light</option>
                            <option value="dark">Dark</option>
                        </select>
                    </div>
                    <div>
                        <div class="mb-2 text-sm dark:text-white">{{ $t('weeklyReport') }}</div>
                        <button class="relative flex w-9 h-6 bg-gray-200 rounded-full" :class="{ 'bg-gray-900': weeklyReport }" @click="toggleWeeklyReport()">
                            <span class="absolute top-0.5 left-0.5 w-5 h-5 bg-white rounded-full" :class="{ 'left-auto right-0.5': weeklyReport }"></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
