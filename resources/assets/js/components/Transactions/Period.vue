<template>
    <div>
        <h2 class="mt-3 mb-1">{{ getMonthName(month) }}, {{ year }}</h2>
        <div class="box">
            <Transaction
                v-for="transaction in transactions"
                :key="'transaction-' + transaction.type + '-' + transaction.id"
                :id="transaction.id"
                :recurring-id="transaction.recurring_id"
                :tag="transaction.tag || null"
                :happened-on="transaction.happened_on"
                :description="transaction.description"
                :amount="transaction.amount"
                :type="transaction.type"
            />
        </div>
    </div>
</template>

<script>
import Transaction from './Transaction.vue';

export default {
    components: {
        Transaction
    },

    props: [
        'year',
        'month',
        'transactions'
    ],

    methods: {
        getMonthName(m) {
            switch (m) {
                case 1: return 'January';
                case 2: return 'February';
                case 3: return 'March';
                case 4: return 'April';
                case 5: return 'May';
                case 6: return 'June';
                case 7: return 'July';
                case 8: return 'August';
                case 9: return 'September';
                case 10: return 'October';
                case 11: return 'November';
                case 12: return 'December';
            }
        }
    }
};
</script>
