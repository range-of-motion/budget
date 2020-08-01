<template>
    <div>
        <div class="row">
            <input type="text" placeholder="Groceries, insurance, etc." class="mw-400" v-model="query" />
            <button class="button button--secondary ml-2">Filter</button>
        </div>
        <div v-for="period in filteredPeriods">
            <h2 class="mt-3 mb-1">{{ getMonthName(period.month) }}, {{ period.year }}</h2>
            <div class="box">
                <a v-for="transaction in period.transactions" class="color-inherit box__section row row--middle" :href="'/' + transaction.type + 's/' + transaction.id">
                    <div class="row__column">
                        <div class="row row--middle">
                            <div class="color-dark">{{ transaction.description }}</div>
                            <i v-if="transaction.recurring_id" class="fas fa-recycle ml-1"></i>
                        </div>
                        <div class="fs-sm mt-1">{{ dateToDate(transaction.happened_on) + getOrdinalNumberSuffix(dateToDate(transaction.happened_on)) }}</div>
                    </div>
                    <div class="row__column">
                        <div v-if="transaction.tag_id" style="display: inline-flex; padding: 0 10px; font-size: 14px; font-weight: 600; line-height: 22px; height: 22px; border-radius: 12.5px;" :style="'background: #' + lighten(transaction.tag.color) + '; color: #' + darken(transaction.tag.color) + ';'">{{ transaction.tag.name }}</div>
                    </div>
                    <div class="row__column text-right" :class="transaction.type === 'earning' ? 'color-green' : 'color-red'">{{ (transaction.type === 'earning' ? '+' : '-') + formatNumber(transaction.amount) }}</div>
                </a>
            </div>
        </div>
    </div>
</template>

<script>
import tinycolor from 'tinycolor2';

export default {
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
        },

        dateToDate(date) {
            return date.substr(8, 2).replace(/\b0+/g, ''); // Remove leading zeros
        },

        getOrdinalNumberSuffix(date) {
            switch (date) {
                case '1': return 'st';
                case '2': return 'nd';
                case '3': return 'rd';
                default: return 'th';
            }
        },

        lighten(color) {
            var colorTiny = tinycolor(color);
            var brightness = colorTiny.getBrightness();

            while (brightness < 235) {
                colorTiny.lighten(2);
                brightness = colorTiny.getBrightness();
            }

            return colorTiny.toHex();
        },

        darken(color) {
            var colorTiny = tinycolor(color);
            var brightness = colorTiny.getBrightness();

            while (brightness > 50) {
                colorTiny.darken(2);
                brightness = colorTiny.getBrightness();
            }

            return colorTiny.toHex();
        },

        formatNumber(n) {
            return Number(n / 100).toFixed(2);
        }
    }
};
</script>
