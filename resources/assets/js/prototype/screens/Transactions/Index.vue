<script setup>
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
        'January',
        'February',
        'March',
        'April',
        'May',
        'June',
        'July',
        'August',
        'September',
        'October',
        'November',
        'December',
    ];

    return months[month - 1];
};

const getTransactionsBySpan = (span) => {
    return transactions.value.filter(transaction => {
        const happenedOn = new Date(transaction.happened_on);

        return happenedOn.getMonth() + 1 === span.month && happenedOn.getFullYear() === span.year;
    });
};

const fetchTransactions = () => {
    fetch('/api/transactions')
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
                    <div class="font-medium">{{ getMonthName(span.month) }}</div>
                    <div class="mt-1 text-sm text-gray-500">{{ span.year }}</div>
                </div>
                <div class="flex-1">
                    <div class="py-4 px-5 space-y-2 bg-white rounded-lg border border-gray-200">
                        <div class="flex items-center justify-between" v-for="transaction in getTransactionsBySpan(span)">
                            <div class="text-sm text-gray-500">{{ transaction.description }}</div>
                            <div class="text-sm" :class="'text-' + (transaction.type === 'earning' ? 'green' : 'red') + '-600'">+{{ (transaction.amount / 100).toFixed(2) }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
