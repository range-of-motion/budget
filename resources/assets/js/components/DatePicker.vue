<template>
    <div v-click-outside="close">
        <input type="text" :name="name" v-model="form" @click="open" />
        <div class="abx">
            <div v-if="show" class="date-picker mt-1">
                <div class="date-picker__top">
                    <button @click="previous">
                        <i class="fa fa-arrow-left"></i>
                    </button>
                    <div>{{ displayYear }}, {{ displayMonth }}</div>
                    <button @click="next">
                        <i class="fa fa-arrow-right"></i>
                    </button>
                </div>
                <div class="date-picker__bottom">
                    <button
                        v-for="i in firstDayOffset"
                        disabled />
                    <button
                        v-for="i in maxDays(displayYear, displayMonth)"
                        @click="choose($event, i)"
                        :class="{ active: isActive(i) }"
                    >{{ i }}</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            name: {
                default: 'date'
            },

            startDate: {
                default: null
            },

            firstDayOfWeek: {
                type: String
            }
        },

        data() {
            return {
                show: false,

                displayYear: new Date().getFullYear(),
                displayMonth: new Date().getMonth() + 1,
                year: this.startDate ? this.startDate.substring(0, 4) : new Date().getFullYear(),
                month: this.startDate ? this.startDate.substring(5, 7) : new Date().getMonth() + 1,
                date: this.startDate ? this.startDate.substring(8, 10) : new Date().getDate()
            }
        },

        computed: {
            form: function () {
                return this.year + '-' + this.addPotentialDigit(this.month) + '-' + this.addPotentialDigit(this.date)
            },

            firstDayOffset: function () {
                let offset = new Date(this.displayYear, this.displayMonth - 1, 1).getDay();

                if (this.firstDayOfWeek === 'monday') {
                    offset -= 1;
                }

                return offset;
            }
        },

        methods: {
            open() {
                this.show = true
            },

            close() {
                this.show = false
            },

            isActive: function (index) {
                if (this.year == this.displayYear && this.month == this.displayMonth && this.date == index) {
                    return true
                }

                return false
            },

            addPotentialDigit(x) {
                if (x.toString().length == 1) {
                    x = '0' + x
                }

                return x
            },

            previous(e) {
                if (e) {
                    e.preventDefault()
                }

                this.displayMonth --

                if (this.displayMonth < 1) {
                    this.displayMonth = 12

                    this.displayYear --
                }
            },

            next(e) {
                if (e) {
                    e.preventDefault()
                }

                this.displayMonth ++

                if (this.displayMonth > 12) {
                    this.displayMonth = 1

                    this.displayYear ++
                }
            },

            choose(e, index) {
                if (e) {
                    e.preventDefault()
                }

                this.year = this.displayYear
                this.month = this.displayMonth
                this.date = index

                // Update
                this.$emit('DateUpdated', this.form)

                this.close()
            },

            maxDays(year, month) {
                return new Date(year, month, 0).getDate()
            }
        }
    }
</script>
