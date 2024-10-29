<script setup>
defineProps({
    yearMonth: String,
    earnings: String,
    spendings: String,
    net: String,
    tags: Array,
});
</script>

<template>
    <div>
        <div class="my-10 mx-auto max-w-3xl">
            <div class="mb-5">
                <div class="mb-2 font-bold text-xl">Dashboard</div>
                <div class="text-sm text-gray-500" v-html="yearMonth"></div>
            </div>
            <div class="bg-white border border-gray-200 rounded-lg">
                <div class="flex divide-x divide-gray-100">
                    <div class="flex-1 p-5">
                        <div class="mb-1 font-semibold text-lg" v-html="earnings"></div>
                        <div class="text-sm text-gray-500">Earnings</div>
                    </div>
                    <div class="flex-1 p-5">
                        <div class="mb-1 font-semibold text-lg" v-html="spendings"></div>
                        <div class="text-sm text-gray-500">Spendings</div>
                    </div>
                    <div class="flex-1 p-5">
                        <div class="mb-1 font-semibold text-lg" v-html="net"></div>
                        <div class="text-sm text-gray-500">Net</div>
                    </div>
                </div>
            </div>
            <div class="mt-10 mb-5">
                <div class="font-semibold">Breakdown</div>
            </div>
            <div class="bg-white border border-gray-200 rounded-lg">
                <div class="divide-y divide-gray-100">
                    <div class="p-5 flex items-center space-x-5" v-for="tag in tags">
                        <div class="flex-1 text-sm">{{ tag.name }}</div>
                        <div class="flex-1 flex items-center">
                            <div class="w-72 h-1.5 bg-gray-100 rounded-full">
                                <div class="min-w-2 h-1.5 bg-gray-900 rounded-full" :style="'width: ' + tag.percentage + '%;'"></div>
                            </div>
                            <div class="ml-5 text-sm text-gray-500">{{ tag.percentage }}%</div>
                        </div>
                        <div class="flex-1 text-right text-sm" v-html="tag.amount"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
