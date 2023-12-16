<script setup>
import { ArrowRightLeft, Home, LogOut, PlusCircle, RotateCcw, Settings2 } from 'lucide-vue';
import { getCurrentInstance } from 'vue';

const router = getCurrentInstance().proxy.$router;

const logOut = () => {
    localStorage.removeItem('api_key');

    router.push({ name: 'login' });
};
</script>

<template>
    <div class="flex items-center h-16 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
        <div class="mx-auto flex-1 flex items-center justify-between max-w-5xl">
            <div class="flex space-x-4">
                <router-link class="flex items-center py-1 px-3 text-gray-500 dark:text-gray-400 hover:text-black dark:hover:text-white" :to="{ name: 'dashboard' }">
                    <Home :size="16" />
                    <span class="ml-2 text-sm">{{ $t('dashboard') }}</span>
                </router-link>
                <router-link class="flex items-center py-1 px-3 text-gray-500 dark:text-gray-400 hover:text-black dark:hover:text-white" :to="{ name: 'transactions.index' }">
                    <ArrowRightLeft :size="16" />
                    <span class="ml-2 text-sm">{{ $t('transactions') }}</span>
                </router-link>
            </div>
            <div class="flex items-center space-x-4">
                <router-link class="flex py-1 px-3 text-gray-500 dark:text-gray-400 hover:text-black dark:hover:text-white" :to="{ name: 'transactions.create' }">
                    <PlusCircle :size="20" :strokeWidth="1.6" />
                </router-link>
                <router-link class="flex py-1 px-3 text-gray-500 dark:text-gray-400 hover:text-black dark:hover:text-white" :to="{ name: 'activities' }">
                    <RotateCcw :size="16" />
                </router-link>
                <router-link class="flex py-1 px-3 text-gray-500 dark:text-gray-400 hover:text-black dark:hover:text-white" :to="{ name: 'settings.preferences' }">
                    <Settings2 :size="16" />
                </router-link>
                <button class="flex py-1 px-3 text-gray-500 dark:text-gray-400 hover:text-black dark:hover:text-white" @click="logOut()">
                    <LogOut :size="16" />
                </button>
            </div>
        </div>
    </div>
</template>
