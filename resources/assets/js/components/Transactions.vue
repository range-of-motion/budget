<template>
    <div>
        <div class="mw-400">
            <input placeholder="Groceries, fuel, etc." type="text" v-model="query" @keyup.enter="search" />
        </div>
        <div v-for="x in yearsMonths" class="mt-3">
            <h2>{{ getMonthName(x.month) }}, {{ x.year }}</h2>
            <div class="box box--shadow mt-2">
                <a v-for="transaction in getTransactionsByYearMonth(x.year, x.month)" class="box__section hoverable row row--separate row--middle" :href="'/' + transaction.type + 's/' + transaction.id">
                    <div class="row__column" style="flex: 2;">
                        <div class="row row--middle">
                            <div class="color-dark mr-1">{{ transaction.description }}</div>
                            <i v-if="transaction.recurring_id" class="fas fa-recycle"></i>
                        </div>
                        <div class="mt-1 fs-sm">{{ transaction.happened_on.substr(8, 2) }}th</div>
                    </div>
                    <div class="row__column">
                        <div v-if="transaction.tag_id" style="background: pink; color: darkred; display: inline-flex; font-size: 14px; padding: 0 15px; border-radius: 11px; line-height: 22px; height: 22px;">{{ transaction.tag.name }}</div>
                    </div>
                    <div class="row__column text-right" :class="transaction.type === 'earning' ? 'color-green' : 'color-red'">
                        <div class="mr-1">{{ (transaction.type === 'spending' ? '-' : '+') + Number(transaction.amount / 100).toFixed(2) }}</div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['transactions'],

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

        yearsMonths() {
            const lowercasedDebouncedQuery = this.debouncedQuery.toLowerCase();

            return this.transactions.filter((transaction, i, stack) => {
                const lowercasedDescription = transaction.description.toLowerCase();

                if (lowercasedDebouncedQuery.length) {
                    return lowercasedDescription.indexOf(lowercasedDebouncedQuery) !== -1;
                }

                return true;
            }).map((transaction, i, stack) => {
                const year = transaction.happened_on.substr(0, 4);
                const month = transaction.happened_on.substr(5, 2);

                return {
                    year,
                    month
                };
            }).filter((yearMonth, i, stack) => {
                return i === stack.findIndex(a => {
                    return a.year === yearMonth.year && a.month === yearMonth.month;
                });
            }).sort((a, b) => {
                if (a.year > b.year) {
                    return -1;
                } else if (a.year < b.year) {
                    return 1;
                }

                if (a.year === b.year) {
                    if (a.month > b.month) {
                        return -1;
                    } else if (a.month < b.month) {
                        return 1;
                    }
                }

                return 0;
            });
        }
    },

    data() {
        return {
            debouncedQuery: '',
            debounceTimeout: null
        };
    },

    methods: {
        getMonthName(month) {
            switch (month) {
                case '01': return 'January';
                case '02': return 'February';
                case '03': return 'March';
                case '04': return 'April';
                case '05': return 'May';
                case '06': return 'June';
                case '07': return 'July';
                case '08': return 'August';
                case '09': return 'September';
                case '10': return 'October';
                case '11': return 'November';
                case '12': return 'December';
            }
        },

        getTransactionsByYearMonth(year, month) {
            return this.transactions.filter(transaction => {
                const y = transaction.happened_on.substr(0, 4);
                const m = transaction.happened_on.substr(5, 2);

                if (this.debouncedQuery.length) {
                    const lowercasedDescription = transaction.description.toLowerCase();
                    const lowercasedDebouncedQuery = this.debouncedQuery.toLowerCase();

                    if (lowercasedDescription.indexOf(lowercasedDebouncedQuery) === -1) {
                        return false;
                    }
                }

                return year === y && month === m;
            }).sort((a, b) => {
                if (a.happened_on > b.happened_on) {
                    return -1
                } else if (a.happened_on < b.happened_on) {
                    return 1;
                }

                return 0;
            });
        }
    }
};
</script>
