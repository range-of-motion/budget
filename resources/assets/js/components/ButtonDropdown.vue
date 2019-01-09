<template>
    <div class="dropdown" v-click-outside="closeMenu">
        <div class="button-dropdown row">
            <div class="button-dropdown__section row__column">
                <slot name="button" style="color: #FFF;"></slot>
            </div>
            <div class="button-dropdown__section row__column row__column--compact">
                <button @click="toggleMenu">
                    <i class="fas fa-caret-down fa-sm"></i>
                </button>
            </div>
        </div>
        <div
            class="dropdown__menu"
            v-show="showMenu"
        >
            <slot name="menu"></slot>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                showMenu: false
            }
        },

        methods: {
            toggleMenu() {
                this.showMenu = !this.showMenu
            },

            closeMenu() {
                this.showMenu = false
            }
        }
    }
</script>
