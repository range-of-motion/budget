<template>
    <div>
        <div class="bg mb-2">
            <button
                class="bg__button"
                :class="{ 'bg__button--active': type == 'earning' }"
                @click="switchType('earning')">Earning</button>
            <button
                class="bg__button"
                :class="{ 'bg__button--active': type == 'spending' }"
                @click="switchType('spending')">Spending</button>
        </div>
        <div class="input" v-if="type == 'spending'">
            <label>Tag</label>
            <searchable
                name="tag"
                :items="tags"
                @SelectUpdated="tagUpdated"></searchable>
            <validation-error v-if="errors.tag_id" :message="errors.tag_id"></validation-error>
        </div>
        <div class="input">
            <label>Date</label>
            <date-picker
                :first-day-of-week="firstDayOfWeek"
                @DateUpdated="onDateUpdate"></date-picker>
            <div class="hint mt-05">YYYY-MM-DD</div>
            <validation-error v-if="errors.date" :message="errors.date"></validation-error>
            <validation-error v-if="errors.day" :message="errors.day"></validation-error>
        </div>
        <div class="input">
            <label>Description</label>
            <input type="text" v-model="description" :placeholder="type == 'earning' ? 'Paycheck February' : 'Birthday Present for Angela'" />
            <validation-error v-if="errors.description" :message="errors.description"></validation-error>
        </div>
        <div class="input">
            <label>Amount</label>
            <div class="row">
                <div class="row__column row__column--double">
                    <input type="text" v-model="amount" />
                </div>
                <div class="row__column ml-2">
                    <select v-model="selectedCurrencyId">
                        <option v-for="currency in currencies" :key="'currencies-' + currency.id" :value="currency.id">
                            <span v-html="currency.symbol"></span>
                        </option>
                    </select>
                </div>
            </div>
            <div class="hint mt-05" v-if="selectedCurrencyId !== defaultCurrencyId">{{ currencies.find(c => c.id === selectedCurrencyId).name }} will be converted into {{ currencies.find(c => c.id === defaultCurrencyId).name }}</div>
            <validation-error v-if="errors.amount" :message="errors.amount"></validation-error>
        </div>
        <div>
            <div class="input row">
                <div class="row__column row__column--compact mr-1">
                    <input type="checkbox" id="test" v-model="isRecurring" />
                </div>
                <div class="row__column">
                    <label for="test">This is a recurring transaction&mdash;create it for me in the future</label>
                </div>
            </div>
            <div v-if="isRecurring">
                <div class="bg mb-2">
                    <button
                        v-for="interval in recurringsIntervals"
                        :key="'recurringsIntervals-' + interval"
                        class="bg__button"
                        :class="{ 'bg__button--active': recurringInterval == interval }"
                        @click="switchRecurringInterval(interval)">{{ interval | capitalize }}</button>
                </div>
                <div class="input">
                    <label>How long will this spending go on for?</label>
                    <div class="row">
                        <div class="row__column row__column--compact mr-1">
                            <input id="noEnd" type="radio" v-model="recurringEnd" value="forever" />
                        </div>
                        <div class="row__column">
                            <label for="noEnd">Forever</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="row__column row__column--compact mr-1">
                            <input id="fixedEnd" type="radio" v-model="recurringEnd" value="fixed" />
                        </div>
                        <div class="row__column">
                            <label for="fixedEnd">Until</label>
                            <date-picker
                                name="end"
                                :start-date="recurringEndDate"
                                :first-day-of-week="firstDayOfWeek"
                                @DateUpdated="onEndUpdate"></date-picker>
                            <div class="hint mt-05">YYYY-MM-DD</div>
                            <validation-error v-if="errors.end" :message="errors.end"></validation-error>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button
            class="button"
            @click="createEarning">
            <span v-if="loading">Loading</span>
            <span v-if="!loading">Create</span>
        </button>
        <div
            v-if="success"
            class="mt-2"
            style="color: green;"
        >Successfully created transaction</div>
    </div>
</template>

<script>
    export default {
        props: [
            'tags',
            'currencies',
            'defaultTransactionType',
            'firstDayOfWeek',
            'defaultCurrencyId',
            'recurringsIntervals'
        ],

        data() {
            return {
                type: this.defaultTransactionType,
                errors: [],

                tag: null,
                date: this.getTodaysDate(),
                description: '',
                amount: '10.00',
                selectedCurrencyId: this.defaultCurrencyId,
                isRecurring: false,
                recurringInterval: 'monthly',
                recurringEnd: 'forever',
                recurringEndDate: this.get100DaysFutureDate(),

                loading: false,
                success: false
            }
        },

        methods: {
            // Children
            onDateUpdate(date) {
                this.date = date
            },

            onEndUpdate(date) {
                this.recurringEndDate = date
            },

            //
            switchType(type) {
                this.type = type

                this.success = false
            },

            tagUpdated(payload) {
                this.tag = payload.key
            },

            getTodaysDate() {
                return new Date().toISOString().slice(0, 10)
            },

            get100DaysFutureDate() {
                let now = new Date()

                return (now.getFullYear() + 1) + '-' + ('0' + (now.getMonth() + 1)).slice(-2) + '-' + ('0' + now.getDate()).slice(-2)
            },

            switchRecurringInterval(interval) {
                this.recurringInterval = interval;
            },

            createEarning() {
                if (!this.loading) {
                    this.loading = true

                    if (this.isRecurring) { // It's a recurring
                        let body = {
                            _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            type: this.type,
                            interval: this.recurringInterval,
                            day: this.date.slice(-2),
                            start: this.date,
                            description: this.description,
                            amount: this.amount,
                            currency_id: this.selectedCurrencyId
                        }

                        if (this.recurringEnd == 'fixed') {
                            body.end = this.recurringEndDate
                        }

                        if (this.tag) {
                            body.tag_id = this.tag
                        }

                        axios.post('/recurrings', body).then(response => {
                            this.handleSuccess()
                        }).catch(error => {
                            this.handleErrors(error.response)
                        })
                    } else { // It's an earning or a spending, not a recurring
                        let body = {
                            _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            date: this.date,
                            description: this.description,
                            currency_id: this.selectedCurrencyId,
                            amount: this.amount
                        }

                        if (this.type == 'spending' && this.tag) {
                            body.tag_id = this.tag
                        }

                        axios.post('/' + this.type + 's', body).then(response => {
                            this.handleSuccess()
                        }).catch(error => {
                            this.handleErrors(error.response)
                        })
                    }
                }
            },

            handleSuccess() {
                this.loading = false

                this.errors = []

                //
                window.location.href = '/transactions'

                this.date = this.getTodaysDate()
                this.description = ''
                this.amount = ''
                // Leave isRecurring as is
                this.recurringEnd = 'forever'
                this.recurringEndDate = ''

                this.success = true
            },

            handleErrors(response) {
                this.loading = false

                let errors = []

                if (response.data.errors) {
                    for (let key in response.data.errors) {
                        if (response.data.errors.hasOwnProperty(key)) {
                            errors[key] = response.data.errors[key][0]
                        }
                    }
                }

                this.errors = errors

                if (response.status != 422) {
                    alert('Something went wrong')
                }

                this.success = false
            }
        }
    }
</script>
