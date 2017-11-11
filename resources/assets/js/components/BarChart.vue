<template>
    <canvas ref="canvas"></canvas>
</template>

<script>
    export default {
        data() {
            return {
                colors: ['#2F323A', '#5E9CF2', '#FED52F', '#9CD926'],
                textColor: '#758193',
                barHeight: 8,
                barTagsOffset: 16,
                tagsDiameter: 16,
                font: 'Muli'
            }
        },

        props: ['slices'],

        methods: {
            drawRectangle(context, x, y, width, height, color = null) {
                if (color) {
                    context.fillStyle = color
                }

                context.fillRect(x, y, width, height)
            },

            drawCircle(context, x, y, radius, color = null) {
                if (color) {
                    context.fillStyle = color
                }

                context.beginPath()
                context.arc(x, y, radius, 0, 2 * Math.PI)
                context.fill()
            },

            drawText(context, x, y, text, color = null) {
                context.font = '16px ' + this.font
                context.textBaseline = 'middle'

                if (color) {
                    context.fillStyle = color
                }

                context.fillText(text, x, y)
            },

            render() {
                const slices = JSON.parse(this.slices)

                const canvas = this.$refs.canvas
                const context = canvas.getContext('2d')

                canvas.width = canvas.offsetWidth
                canvas.height = this.barHeight + this.barTagsOffset + this.tagsDiameter

                let total = 0

                for (const key in slices) {
                    total += slices[key]
                }

                let barX = 0
                let tagX = this.tagsDiameter / 2
                let index = 0

                const last = Object.keys(slices).length - 1

                for (const key in slices) {
                    const slice = slices[key]

                    const color = this.colors[index]
                    const barWidth = (slice / total) * canvas.width

                    // Bar
                    if (index === 0) {
                        this.drawCircle(context, barX + this.barHeight / 2, this.barHeight / 2, this.barHeight / 2, color)
                        this.drawRectangle(context, barX + this.barHeight / 2, 0, barWidth - this.barHeight / 2, this.barHeight, color)
                    } else if (index === last) {
                        this.drawCircle(context, barX + barWidth - this.barHeight / 2, this.barHeight / 2, this.barHeight / 2, color)
                        this.drawRectangle(context, barX, 0, barWidth - this.barHeight / 2, this.barHeight, color)
                    } else {
                        this.drawRectangle(context, barX, 0, barWidth, this.barHeight, color)
                    }

                    // Tags
                    this.drawCircle(context, tagX, this.barHeight + this.barTagsOffset + this.tagsDiameter / 2, this.tagsDiameter / 2, color)
                    this.drawText(context, tagX + 16, this.barHeight + this.barTagsOffset + this.tagsDiameter / 2, key, this.textColor)

                    barX += barWidth
                    tagX += 16 + context.measureText(key).width + 32
                    index ++
                }
            },
        },

        mounted() {
            this.render()

            window.addEventListener('resize', this.render)
        }
    }
</script>
