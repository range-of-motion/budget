<script setup>
import { Construction } from "lucide-vue";

import Navigation from '../components/Navigation.vue';

const getTimeSensitiveGreeting = () => {
    const hour = new Date().getHours();

    if (hour < 12) {
        return 'Good morning';
    } else if (hour < 18) {
        return 'Good afternoon';
    } else {
        return 'Good evening';
    }
};
</script>

<template>
    <div>
        <Navigation />
        <div class="my-10 mx-auto max-w-3xl">
            <div class="flex flex-col items-center text-gray-400">
                <Construction :size="32" :strokeWidth="1.5" />
                <div class="mt-2 text-center text-sm text-gray-400">{{ getTimeSensitiveGreeting() }} and<br /> welcome to the prototype.</div>
            </div>
        </div>
    </div>
</template>
