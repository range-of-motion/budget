<script setup>
import { ref } from 'vue';

import Navigation from '../../components/Navigation.vue';

const imports = ref([]);

const fetchImports = () => {
    fetch('/api/imports', { headers: { 'api-key': localStorage.getItem('api_key') } })
        .then(response => response.json())
        .then(data => {
            imports.value = data;
        });
};

fetchImports();
</script>

<template>
    <div>
        <Navigation />
        <div class="max-w-3xl mx-auto my-10 space-y-10">
            <div v-for="_import in imports">
                <div class="py-4 px-5 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg">
                    <div class="text-sm">{{ _import.name }}</div>
                    <div class="mt-2 text-xs text-gray-500">Uploaded {{ new Intl.RelativeTimeFormat('en', { numeric: 'auto' }).format(Math.round((new Date(_import.created_at) - new Date()) / 86400000), 'day') }}</div>
                    <div class="mt-4 flex items-center space-x-2">
                        <div class="text-xs" :class="_import.status >= 0 ? 'text-green-600' : 'text-grey-500'">1. Upload</div>
                        <div class="w-4 h-px" :class="_import.status >= 1 ? 'bg-green-600' : 'bg-black'"></div>
                        <div class="text-xs" :class="_import.status >= 1 ? 'text-green-600' : 'text-grey-500'">2. Define columns</div>
                        <div class="w-4 h-px" :class="_import.status >= 2 ? 'bg-green-600' : 'bg-black'"></div>
                        <div class="text-xs" :class="_import.status >= 2 ? 'text-green-600' : 'text-grey-500'">3. Import</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
