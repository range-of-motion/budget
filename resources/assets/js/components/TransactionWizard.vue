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
            <input type="text" v-model="date" />
            <div class="hint mt-05">YYYY-MM-DD</div>
            <validation-error v-if="errors.date" :message="errors.date"></validation-error>
            <validation-error v-if="errors.day" :message="errors.day"></validation-error>
        </div>
        <div class="input">
            <label>Description</label>
            <input type="text" v-model="description" placeholder="Birthday Present Angela" />
            <validation-error v-if="errors.description" :message="errors.description"></validation-error>
        </div>
        <div class="input">
            <label>Amount</label>
            <input type="text" v-model="amount" />
            <validation-error v-if="errors.amount" :message="errors.amount"></validation-error>
        </div>
        <div v-if="type == 'spending'">
            <div class="input row">
                <div class="row__column row__column--compact mr-1">
                    <input type="checkbox" id="test" v-model="isRecurring" />
                </div>
                <div class="row__column">
                    <label for="test">This is a recurring spending&mdash;create it for me in the future</label>
                </div>
            </div>
            <div v-if="isRecurring">
                <div class="input">
                    <label>How long will this spending go on for?</label>
                    <div class="row">
                        <div class="row__column row__column--compact mr-1">
                            <input type="radio" v-model="recurringEnd" value="forever" />
                        </div>
                        <div class="row__column">
                            <label>Forever :(</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="row__column row__column--compact mr-1">
                            <input type="radio" v-model="recurringEnd" value="fixed" />
                        </div>
                        <div class="row__column">
                            <label>Until</label>
                            <input type="text" />
                            <validation-error v-if="errors.end" :message="errors.end"></validation-error>
                            <div class="hint mt-05">YYYY-MM-DD</div>
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
                amount: '',
                isRecurring: false,
                recurringEnd: 'forever',
                recurringEndDate: '',

                loading: false
            }
        },

        methods: {
            switchType(type) {
                this.type = type
            },

            tagUpdated(payload) {
                this.tag = payload.key
            },

            getTodaysDate() {
                return new Date().toISOString().slice(0, 10)
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

                this.date = this.getTodaysDate()
                this.description = ''
                this.amount = ''
                // Leave isRecurring as is
                this.recurringEnd = 'forever'
                this.recurringEndDate = ''

                alert('Success')
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
            }
        }
    }
</script>
