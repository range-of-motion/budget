<template>
    <div class="dropdown">
        <button
            ref="trigger"
            class="dropdown__button"
            @click="toggleModal">
            <slot name="button"></slot>
        </button>
        <div
            v-show="showModal"
            class="dropdown__menu">
            <slot name="menu"></slot>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            showModal: false
        }
    },

    methods: {
        toggleModal() {
            this.showModal = !this.showModal
        },

        closeModal() {
            if (!this.belongsToUs(event.target)) {
                this.showModal = false
            }
        },

        belongsToUs(element) {
            if (element == this.$refs.trigger) {
                return true
            }

            if (this.$refs.trigger != undefined) {
                const children = this.$refs.trigger.querySelectorAll('*')

                for (const child of children) {
                    if (element == child) {
                        return true
                    }
                }
            }

            return false
        }
    },

    created() {
        document.addEventListener('click', this.closeModal)
    }
}
</script>
