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
            <input type="text" v-model="date" style="background: #FFF;" />
            <div class="hint mt-05">YYYY-MM-DD</div>
            <validation-error v-if="errors.date" :message="errors.date"></validation-error>
        </div>
        <div class="input">
            <label>Description</label>
            <input type="text" v-model="description" placeholder="Birthday Present Angela" style="background: #FFF;" />
            <validation-error v-if="errors.description" :message="errors.description"></validation-error>
        </div>
        <div class="input">
            <label>Amount</label>
            <input type="text" v-model="amount" style="background: #FFF;" />
            <validation-error v-if="errors.amount" :message="errors.amount"></validation-error>
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

                    // Reset
                    let errors = []

                    //
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
                        this.loading = false

                        this.errors = []

                        this.date = this.getTodaysDate()
                        this.description = ''
                        this.amount = ''

                        alert('Success')
                    }).catch(error => {
                        this.loading = false

                        const response = error.response

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
                    })
                }
            }
        }
    }
</script>
