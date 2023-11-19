<script setup>
import axios from 'axios';
import { ref } from 'vue';

import Navigation from '../../components/Navigation.vue';

const type = ref('earning');
const happened_on = ref('2023-11-02');
const description = ref('');
const amount = ref(10.00);

const create = () => {
    axios.post('/api/transactions', {
        type: type.value,
        happened_on: happened_on.value,
        description: description.value,
        amount: amount.value,
    }, {
        headers: {
            'api-key': localStorage.getItem('api_key'),
        },
    })
        .then(() => {
            alert('wtf, dat werkte');
        })
        .catch(() => {
            alert('Something went wrong');
        });
};
</script>

<template>
    <div>
        <Navigation />
        <div class="my-10 mx-auto max-w-sm">
            <div class="p-5 space-y-5 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg">
                <div class="flex space-x-3">
                    <button class="px-4 py-2.5 text-sm dark:text-white border border-gray-200 dark:border-gray-600 rounded-lg" :class="{ 'bg-gray-100 dark:bg-gray-700': type === 'earning' }" @click="type = 'earning'">Earning</button>
                    <button class="px-4 py-2.5 text-sm dark:text-white border border-gray-200 dark:border-gray-600 rounded-lg" :class="{ 'bg-gray-100 dark:bg-gray-700': type === 'spending' }" @click="type = 'spending'">Spending</button>
                </div>
                <div v-if="type === 'spending'">
                    <label class="mb-2 block text-sm dark:text-white">Tag</label>
                    <input class="w-full px-3.5 py-2.5 text-sm dark:text-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg" type="text" value="Coming soon" disabled />
                </div>
                <div>
                    <label class="mb-2 block text-sm dark:text-white">Date</label>
                    <input class="w-full px-3.5 py-2.5 text-sm dark:text-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg" type="text" v-model="happened_on" />
                </div>
                <div>
                    <label class="mb-2 block text-sm dark:text-white">Description</label>
                    <input class="w-full px-3.5 py-2.5 text-sm dark:text-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg" type="text" :placeholder="type === 'earning' ? 'Paycheck February' : 'Birthday present for Angela'" v-model="description" />
                </div>
                <div>
                    <label class="mb-2 block text-sm dark:text-white">Amount</label>
                    <input class="w-full px-3.5 py-2.5 text-sm dark:text-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg" type="text" v-model="amount" />
                </div>
                <button class="w-full py-3 text-sm text-white bg-gray-900 dark:bg-gray-950 rounded-lg" @click="create()">Create</button>
            </div>
        </div>
    </div>
</template>
