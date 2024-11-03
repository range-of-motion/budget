<script setup>
import { Tag } from 'lucide-vue-next';
import { computed } from 'vue';

const props = defineProps({
    currency: String,
    transactions: Array,
});

const spans = computed(() => {
    return props.transactions
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

    return months[month - 1].charAt(0).toUpperCase() + months[month - 1].slice(1);
};

const getTransactionsBySpan = (span) => {
    return props.transactions
        .filter(transaction => {
            const happenedOn = new Date(transaction.happened_on);

            return happenedOn.getMonth() + 1 === span.month && happenedOn.getFullYear() === span.year;
        })
        .sort((a, b) => {
            return new Date(b.happened_on) - new Date(a.happened_on);
        });
};
</script>

<template>
    <div class="my-10 mx-auto max-w-3xl">
        <div class="mb-5">
            <div class="font-bold text-xl">Transactions</div>
        </div>
        <div class="space-y-5">
            <div v-for="span in spans" class="flex">
                <div class="w-48">
                    <div class="font-semibold">{{ getMonthName(span.month) }}</div>
                    <div class="mt-2 text-sm text-gray-500">{{ span.year }}</div>
                </div>
                <div class="flex-1">
                    <div class="py-4 px-5 space-y-4 bg-white border border-gray-200 rounded-lg">
                        <div class="flex items-center justify-between" v-for="transaction in getTransactionsBySpan(span)">
                            <div class="flex-1 text-sm text-gray-500">{{ transaction.description }}</div>
                            <div v-if="transaction.tag_id" class="flex-1 flex items-center">
                                <Tag class="mr-1" :size="14" />
                                <span class="text-sm text-gray-500">{{ transaction.tag.name }}</span>
                            </div>
                            <div class="w-20 text-right text-sm" :class="'text-' + (transaction.type === 'earning' ? 'green' : 'red') + '-600'" v-html="(transaction.type === 'earning' ? '+' : '-') + props.currency + (transaction.amount / 100).toFixed(2)"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>