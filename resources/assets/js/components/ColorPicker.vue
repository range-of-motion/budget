<template>
    <div>
        <input type="hidden" name="color" :value="colorWithoutHashtag" />
        <sketch-picker v-model="color" disable-alpha="true"></sketch-picker>
    </div>
</template>

<script>
    export default {
        props: ['initialColor'],

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
