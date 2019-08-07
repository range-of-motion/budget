<template>
    <div>
        <div class="bg mb-2">
            <button
                class="bg__button"
                :class="{ 'bg__button--active': type == 'earning' }"
                @click="switchType('earning')">{{ $t('models.earning') }}</button>
            <button
                class="bg__button"
                :class="{ 'bg__button--active': type == 'spending' }"
                @click="switchType('spending')">{{ $t('models.spending') }}</button>
        </div>
        <div class="input" v-if="type == 'spending'">
            <label>{{ $t('models.tag') }}</label>
            <searchable
                name="tag"
                :items="tags"
                @SelectUpdated="tagUpdated"></searchable>
            <validation-error v-if="errors.tag_id" :message="errors.tag_id"></validation-error>
        </div>
        <div class="input">
            <label>{{ $t('fields.date') }}</label>
            <date-picker @DateUpdated="onDateUpdate"></date-picker>
            <div class="hint mt-05">YYYY-MM-DD</div>
            <validation-error v-if="errors.date" :message="errors.date"></validation-error>
            <validation-error v-if="errors.day" :message="errors.day"></validation-error>
        </div>
        <div class="input">
            <label>{{ $t('fields.description') }}</label>
            <input type="text" v-model="description" :placeholder="type == 'earning' ? $t('messages.transaction_wizard.new_earning_description') : $t('messages.transaction_wizard.new_spending_description')" />
            <validation-error v-if="errors.description" :message="errors.description"></validation-error>
        </div>
        <div class="input">
            <label>{{ $t('fields.amount') }}</label>
            <input type="text" v-model="amount" />
            <validation-error v-if="errors.amount" :message="errors.amount"></validation-error>
        </div>
        <div v-if="type == 'spending'">
            <div class="input row">
                <div class="row__column row__column--compact mr-1">
                    <input type="checkbox" id="test" v-model="isRecurring" />
                </div>
                <div class="row__column">
                    <label for="test">{{ $t('messages.transaction_wizard.recurring_explanation') }}</label>
                </div>
            </div>
            <div v-if="isRecurring">
                <div class="input">
                    <label>{{ $t('messages.transaction_wizard.recurring_duration') }}</label>
                    <div class="row">
                        <div class="row__column row__column--compact mr-1">
                            <input id="noEnd" type="radio" v-model="recurringEnd" value="forever" />
                        </div>
                        <div class="row__column">
                            <label for="noEnd">{{ $t('messages.transaction_wizard.forever') }}</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="row__column row__column--compact mr-1">
                            <input id="fixedEnd" type="radio" v-model="recurringEnd" value="fixed" />
                        </div>
                        <div class="row__column">
                            <label for="fixedEnd">{{ $t('messages.transaction_wizard.until')}}</label>
                            <date-picker name="end" :start-date="recurringEndDate" @DateUpdated="onEndUpdate"></date-picker>
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
            <span v-if="loading">{{ $t('messages.transaction_wizard.loading')}}</span>
            <span v-if="!loading">{{ $t('actions.create')}}</span>
        </button>
        <div
            v-if="success"
            class="mt-2"
            style="color: green;"
        >{{ $t('messages.transaction_wizard.successfully_created') }}</div>
    </div>
</template>

<script>
    export default {
        props: ['tags'],

        data() {
            return {
                type: 'earning',
                errors: [],

                tag: null,
                date: this.getTodaysDate(),
                description: '',
                amount: '10.00',
                isRecurring: false,
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

            createEarning() {
                if (!this.loading) {
                    this.loading = true

                    if (this.type == 'spending' && this.isRecurring) { // It's a recurring
                        let body = {
                            _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            day: this.date.slice(-2),
                            description: this.description,
                            amount: this.amount
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
