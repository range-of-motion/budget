<template>
    <div v-click-outside="hide">
        <input type="hidden" :name="name" :value="inputValue" />
        <div class="searchable__input" @click="toggleShown">
            <span v-if="!selected">Select</span>
            <span v-else v-html="selected.label"></span>
        </div>
        <div class="searchable__list" v-if="shown">
            <input type="search" v-model="query" placeholder="Search" ref="query" />
            <ul>
                <li v-for="item in queriedItems" @click="select(item)" v-html="item.label"></li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['name', 'items', 'initial'],

        data() {
            return {
                shown: false,
                selected: this.initial ? this.getItemByKey(this.initial) : null,
                query: ''
            }
        },

        computed: {
            inputValue() {
                if (this.selected) {
                    return this.selected.key
                }

                return ''
            },

            queriedItems() {
                return this.items.filter(item => {
                    if (this.query.length < 1 || item.label.toUpperCase().indexOf(this.query.toUpperCase()) > -1) {
                        return item
                    }
                })
            }
        },

        methods: {
            getItemByKey(key) {
                for (let i = 0; i < this.items.length; i ++) {
                    if (this.items[i].key == key) {
                        return this.items[i]
                    }
                }
            },

            toggleShown() {
                this.shown = !this.shown

                this.$nextTick(() => {
                    if (this.$refs.query) {
                        this.$refs.query.focus()
                    }
                })
            },

            show() {
                this.shown = true
            },

            hide() {
                this.shown = false
            },

            select(payload) {
                this.selected = payload

                this.hide()
            }
        }
    }
</script>
