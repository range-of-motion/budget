<script setup>
import colors from 'tailwindcss/colors';
import { onMounted } from 'vue';

import Navigation from '../components/Navigation.vue';

const isDarkMode = document.querySelector('html').classList.contains('dark');

const getTimeSensitiveGreeting = () => {
    const hour = new Date().getHours();

    if (hour < 12) {
        return 'Good morning';
    } else if (hour < 18) {
        return 'Good afternoon';
    } else {
        return 'Good evening';
    }
};

const fetchChartData = () => {
    fetch('/api/dashboard', { headers: { 'api-key': localStorage.getItem('api_key') } })
        .then(response => response.json())
        .then(data => {
            const options = {
                chart: {
                    type: 'line',

                    toolbar: {
                        show: false,
                    },

                    animations: {
                        enabled: false,
                    },
                },

                series: [
                    {
                        name: 'Balance',
                        data: Object.values(data.daily_balance),
                    },
                ],

                stroke: {
                    colors: [isDarkMode ? colors.white : colors.black],
                    width: 2,
                },

                tooltip: {
                    enabled: false,
                },

                grid: {
                    borderColor: isDarkMode ? colors.gray[700] : null,

                    padding: {
                        top: -10,
                        bottom: -10,
                    },
                },

                xaxis: {
                    show: false,

                    labels: {
                        show: false
                    },

                    axisBorder: {
                        show: false
                    },

                    axisTicks: {
                        show: false
                    }
                },

                yaxis: {
                    labels: {
                        style: {
                            colors: [isDarkMode ? colors.gray[400] : null],
                        },
                    },
                },
            };

            const chart = new ApexCharts(document.querySelector("#chart"), options);

            chart.render();
        });
};

onMounted(() => {
    fetchChartData();
});
</script>

<template>
    <div>
        <Navigation />
        <div class="my-10 mx-auto max-w-3xl">
            <div class="mb-5">
                <div class="font-medium dark:text-white">{{ getTimeSensitiveGreeting() }}</div>
                <div class="mt-1 text-sm text-gray-500 dark:text-gray-400">Here is your balance throughout the month</div>
            </div>
            <div class="p-5 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg">
                <div id="chart"></div>
            </div>
        </div>
    </div>
</template>
