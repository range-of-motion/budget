<script setup>
import { ref } from 'vue';

import Navigation from '../components/Navigation.vue';

const activities = ref([]);

const fetchActivities = () => {
    fetch('/api/activities', { headers: { 'api-key': localStorage.getItem('api_key') } })
        .then(response => response.json())
        .then(data => {
            activities.value = data.sort((a, b) => new Date(b.occurred_at) - new Date(a.occurred_at));
        });
};

fetchActivities();
</script>

<template>
    <div>
        <Navigation />
        <div class="my-10 mx-auto max-w-3xl">
            <div class="p-5 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg">
                <div class="relative ml-2.5 space-y-5 border-l border-gray-300">
                    <div v-for="(activity, i) in activities" :key="i">
                        <div class="flex items-start">
                            <div class="absolute -left-2.5 w-5 h-5 bg-gray-100 border border-gray-300 ring-8 ring-white rounded-full"></div>
                            <div class="pl-5">
                                <div class="-mt-px text-sm">
                                    <span>{{ activity.user ? activity.user.name : 'Budget' }} {{ $t('activities.' + activity.action, { id: activity.entity_id }) }}</span>
                                </div>
                                <div class="mt-1 text-xs text-gray-500">{{ new Date(activity.occurred_at).toJSON().split('T')[0] }}</div>
                            </div>
                        </div>
                    </div>
                    <!-- Patch (yes, it's ugly) -->
                    <div class="absolute bottom-0 -left-2 w-4 h-4 bg-white"></div>
                </div>
            </div>
        </div>
    </div>
</template>
