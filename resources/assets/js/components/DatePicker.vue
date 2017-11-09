<template>
    <div class="row spacing-bottom-medium" style="justify-content: space-between;">
        <input type="hidden" name="date" :value="year + '-' + month + '-' + date" />
        <div class="column tight">
            <div class="row gutter">
                <div class="column tight">
                    <button v-on:click="previousYear">Previous</button>
                </div>
                <div class="column tight align-middle">{{ year }}</div>
                <div class="column tight">
                    <button @click="nextYear">Next</button>
                </div>
            </div>
        </div>
        <div class="column tight">
            <div class="row gutter">
                <div class="column tight">
                    <button @click="previousMonth">Previous</button>
                </div>
                <div class="column tight align-middle">{{ month }}</div>
                <div class="column tight">
                    <button @click="nextMonth">Next</button>
                </div>
            </div>
        </div>
        <div class="column tight">
            <div class="row gutter">
                <div class="column tight">
                    <button @click="previousDate">Previous</button>
                </div>
                <div class="column tight align-middle">{{ date }}</div>
                <div class="column tight">
                    <button @click="nextDate">Next</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                year: 2017,
                month: 11,
                date: 4
            }
        },

        methods: {
            nextYear(e) {
                if (e) {
                    e.preventDefault()
                }

                this.year ++
            },

            previousYear(e) {
                if (e) {
                    e.preventDefault()
                }

                this.year --
            },

            nextMonth(e) {
                if (e) {
                    e.preventDefault()
                }

                this.month ++

                if (this.month > 12) {
                    this.nextYear()

                    this.month = 1
                }

                if (this.date > this.maxDays(this.year, this.month)) {
                    this.date = this.maxDays(this.year, this.month)
                }
            },

            previousMonth(e) {
                if (e) {
                    e.preventDefault()
                }

                this.month --

                if (this.month < 1) {
                    this.previousYear()

                    this.month = 12
                }

                if (this.date > this.maxDays(this.year, this.month)) {
                    this.date = this.maxDays(this.year, this.month)
                }
            },

            nextDate(e) {
                if (e) {
                    e.preventDefault()
                }

                this.date ++

                if (this.date > this.maxDays(this.year, this.month)) {
                    this.nextMonth()

                    this.date = 1
                }
            },

            previousDate(e) {
                if (e) {
                    e.preventDefault()
                }

                this.date --

                if (this.date < 1) {
                    this.previousMonth()

                    this.date = this.maxDays(this.year, this.month)
                }
            },

            maxDays(year, month) {
                return new Date(year, month, 0).getDate()
            }
        }
    }
</script>
