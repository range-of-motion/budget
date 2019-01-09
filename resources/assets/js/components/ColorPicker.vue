<template>
    <div>
        <input type="hidden" name="color" :value="colorWithoutHashtag" />
        <chrome-picker v-model="color" disable-alpha="true" disable-fields="true"></chrome-picker>
    </div>
</template>

<script>
    export default {
        props: {
            initialColor: {
                type: String,
                default: function () {
                    return (Math.random() * 0xFFFFFF<<0).toString(16)
                }
            }
        },

        data() {
            return {
                color: {
                    hex: this.initialColor
                }
            }
        },

        computed: {
            colorWithoutHashtag() {
                let color = this.color.hex

                if (color.charAt(0) == '#') {
                    color = color.substring(1)
                }

                return color
            }
        }
    }
</script>
