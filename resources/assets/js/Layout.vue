<script setup>
import { computed } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';

const page = usePage();

const user = computed(() => page.props.auth.user);
</script>

<template>
    <div>
        <div v-if="user" class="flex items-center h-16 bg-white border-b border-gray-200">
            <div class="mx-auto flex-1 flex items-center justify-between max-w-3xl">
                <div class="flex space-x-10">
                    <Link class="flex items-center text-gray-500 hover:text-black" href="/dashboard">
                        <svg class="h-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 21v-8a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v8"/><path d="M3 10a2 2 0 0 1 .709-1.528l7-5.999a2 2 0 0 1 2.582 0l7 5.999A2 2 0 0 1 21 10v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/></svg>
                        <div class="ml-1 text-sm">Dashboard</div>
                    </Link>
                    <Link class="flex items-center text-gray-500 hover:text-black" href="/transactions">
                        <svg class="h-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M8 3 4 7l4 4"/><path d="M4 7h16"/><path d="m16 21 4-4-4-4"/><path d="M20 17H4"/></svg>
                        <div class="ml-1 text-sm">Transactions</div>
                    </Link>
                </div>
                <div class="flex space-x-5">
                    <Link class="flex items-center text-gray-500 hover:text-black" href="/transactions/create">
                        <svg class="h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M8 12h8"/><path d="M12 8v8"/></svg>
                    </Link>
                    <Link class="flex items-center text-gray-500 hover:text-black" href="/log-out">
                        <svg class="h-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" x2="9" y1="12" y2="12"/></svg>
                    </Link>
                </div>
            </div>
        </div>
        <slot />
    </div>
</template>
