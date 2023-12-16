<script setup>
import { Tag } from 'lucide-vue';
import { computed, onMounted, ref } from 'vue';

import Navigation from '../../components/Navigation.vue';

const transactions = ref([]);

const spans = computed(() => {
    return transactions
        .value
        .map(transaction => {
            const happenedOn = new Date(transaction.happened_on);

            return {
                month: happenedOn.getMonth() + 1,
                year: happenedOn.getFullYear(),
            };
        })
        .filter((span, i, spans) => {
            return i === spans.findIndex(other => other.year === span.year && other.month === span.month);
        })
        .sort((a, b) => {
            if (a.year === b.year) {
                return b.month - a.month;
            }

            return b.year - a.year;
        });
});

const getMonthName = (month) => {
    const months = [
        'january',
        'february',
        'march',
        'april',
        'may',
        'june',
        'july',
        'august',
        'september',
        'october',
        'november',
        'december',
    ];

    return months[month - 1];
};

const getTransactionsBySpan = (span) => {
    return transactions.value
        .filter(transaction => {
            const happenedOn = new Date(transaction.happened_on);

            return happenedOn.getMonth() + 1 === span.month && happenedOn.getFullYear() === span.year;
        })
        .sort((a, b) => {
            return new Date(b.happened_on) - new Date(a.happened_on);
        });
};

const fetchTransactions = () => {
    fetch('/api/transactions', { headers: { 'api-key': localStorage.getItem('api_key') } })
        .then(response => response.json())
        .then(data => {
            transactions.value = data;
        });
};

onMounted(() => {
    fetchTransactions();
});
</script>

<template>
    <div>
        <Navigation />
        <div class="max-w-3xl mx-auto my-10 space-y-10">
            <div v-for="span in spans" class="flex">
                <div class="w-48">
                    <div class="font-medium dark:text-white">{{ $t('months.' + getMonthName(span.month)) }}</div>
                    <div class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ span.year }}</div>
                </div>
                <div class="flex-1">
                    <div class="py-4 px-5 space-y-4 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg">
                        <div class="flex items-center justify-between" v-for="transaction in getTransactionsBySpan(span)">
                            <div class="flex-1 text-sm text-gray-500 dark:text-white">{{ transaction.description }}</div>
                            <div v-if="transaction.tag" class="flex-1 flex items-center space-x-1 dark:text-white">
                                <span :style="{ color: '#' + transaction.tag.color } ">
                                    <Tag :size="16" />
                                </span>
                                <span class="text-sm text-gray-500">{{ transaction.tag.name }}</span>
                            </div>
                            <div class="w-20 text-right text-sm" :class="'text-' + (transaction.type === 'earning' ? 'green' : 'red') + '-600'">{{ transaction.type === 'earning' ? '+' : '-' }}{{ (transaction.amount / 100).toFixed(2) }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
