<template>
    <a class="color-inherit box__section row row--middle" :href="detailsUrl">
        <div class="row__column row__column--double">
            <div class="row row--middle">
                <div class="color-dark">{{ description }}</div>
                <i v-if="recurringId" class="fas fa-recycle ml-1"></i>
            </div>
            <div class="fs-sm mt-1">{{ dateToDate(happenedOn) + getOrdinalNumberSuffix(dateToDate(happenedOn)) }}</div>
        </div>
        <div class="row__column">
            <div v-if="tag" style="display: inline-flex; padding: 0 10px; font-size: 14px; font-weight: 600; line-height: 22px; height: 22px; border-radius: 12.5px;" :style="'background: #' + lighten(tag.color) + '; color: #' + darken(tag.color) + ';'">{{ tag.name }}</div>
        </div>
        <div class="row__column text-right color-dark">{{ amountPrefix + formatNumber(amount) }}</div>
    </a>
</template>

<script>
import tinycolor from 'tinycolor2';

export default {
    props: [
        'id',
        'recurringId',
        'tag',
        'happenedOn',
        'description',
        'amount',
        'type'
    ],

    computed: {
        detailsUrl() {
            return '/' + this.type + 's/' + this.id;
        },

        amountPrefix() {
            return this.type === 'earning' ? '+' : '-';
        }
    },

    methods: {
        dateToDate(date) {
            return date.substr(8, 2).replace(/\b0+/g, ''); // Remove leading zeros
        },

        getOrdinalNumberSuffix(date) {
            switch (date) {
                case '1': return 'st';
                case '2': return 'nd';
                case '3': return 'rd';
                default: return 'th';
            }
        },

        lighten(color) {
            var colorTiny = tinycolor(color);
            var brightness = colorTiny.getBrightness();

            while (brightness < 235) {
                colorTiny.lighten(2);
                brightness = colorTiny.getBrightness();
            }

            return colorTiny.toHex();
        },

        darken(color) {
            var colorTiny = tinycolor(color);
            var brightness = colorTiny.getBrightness();

            while (brightness > 50) {
                colorTiny.darken(2);
                brightness = colorTiny.getBrightness();
            }

            return colorTiny.toHex();
        },

        formatNumber(n) {
            return Number(n / 100).toFixed(2);
        }
    }
};
</script>
