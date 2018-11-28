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
        <div class="input input--small">
            <label>Date</label>
            <input type="text" v-model="date" />
        </div>
        <div class="input input--small">
            <label>Description</label>
            <input type="text" v-model="description" />
        </div>
        <div class="input input--small">
            <label>Amount</label>
            <input type="text" v-model="amount" />
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
        data() {
            return {
                type: 'earning',
                date: '',
                description: '',
                amount: '',
                loading: false
            }
        },

        methods: {
            switchType(type) {
                this.type = type
            },

            createEarning() {
                if (!this.loading) {
                    this.loading = true

                    axios.post('/' + this.type, {
                        _token: '33lp59tlzHIMCJ1aojp2CT4qZUttdCIWfkgFu1yk',
                        date: this.date,
                        description: this.description,
                        amount: this.amount
                    }).then(() => {
                        this.date = ''
                        this.description = ''
                        this.amount = ''

                        this.loading = false

                        alert('Success')
                    }).catch(() => {
                        this.loading = false

                        alert('Something went wrong')
                    })
                }
            }
        }
    }
</script>
