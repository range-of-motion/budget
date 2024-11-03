<script setup>
import { ArrowRightLeft, CirclePlus, House, LogOut } from 'lucide-vue-next';
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
                        <House :size="16" />
                        <div class="ml-2 text-sm">Dashboard</div>
                    </Link>
                    <Link class="flex items-center text-gray-500 hover:text-black" href="/transactions">
                        <ArrowRightLeft :size="16" />
                        <div class="ml-2 text-sm">Transactions</div>
                    </Link>
                </div>
                <div class="flex space-x-5">
                    <Link class="flex items-center text-gray-500 hover:text-black" href="/transactions/create">
                        <CirclePlus :size="16" />
                    </Link>
                    <Link class="flex items-center text-gray-500 hover:text-black" href="/log-out">
                        <LogOut :size="16" />
                    </Link>
                </div>
            </div>
        </div>
        <slot />
    </div>
</template>
