<template>
    <div>
        <div>
            <label>Search</label>
            <div class="mw-400 mt-1">
                <input type="text" placeholder="Groceries, insurance, etc." v-model="query" />
            </div>
        </div>
        <Period
            v-for="period in filteredPeriods"
            :key="'periods-' + period.year + '-' + period.month"
            :year="period.year"
            :month="period.month"
            :transactions="period.transactions"
        />
    </div>
</template>

<script>
import Period from './Period.vue';

export default {
    components: {
        Period
    },

    props: [
        'periods'
    ],

    computed: {
        query: {
            get() {
                return this.debouncedQuery;
            },
            set(v) {
                if (this.debounceTimeout) {
                    clearTimeout(this.debounceTimeout);
                }
                this.debounceTimeout = setTimeout(() => {
                    this.debouncedQuery = v;
                }, 300);
            }
        },

        filteredPeriods() {
            const lowercaseQuery = this.debouncedQuery.toLowerCase();

            return this.periods.map((period, i) => {
                const transactions = this.periods[i].transactions.filter(transaction => {
                    const lowercaseDescription = transaction.description.toLowerCase();

                    if (lowercaseQuery.length > 0) {
                        return lowercaseDescription.indexOf(lowercaseQuery) !== -1;
                    }

                    return true;
                });

                return {
                    ...period,
                    transactions
                }
            }).filter(period => period.transactions.length > 0);
        }
    },

    data() {
        return {
            debouncedQuery: '',
            debounceTimeout: null
        };
    },
};
</script>
