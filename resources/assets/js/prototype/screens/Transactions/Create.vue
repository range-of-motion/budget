<script setup>
import axios from 'axios';
import { getCurrentInstance, ref } from 'vue';

import Navigation from '../../components/Navigation.vue';

const router = getCurrentInstance().proxy.$router;

const tags = ref([]);

const type = ref('earning');
const tagId = ref(null);
const happenedOn = ref(new Date().toJSON().slice(0, 10));
const description = ref('');
const amount = ref(10.00);
const isRecurring = ref(false);
const recurringInterval = ref('monthly');

const fetchTags = () => {
    fetch('/api/tags', { headers: { 'api-key': localStorage.getItem('api_key') } })
        .then(response => response.json())
        .then(data => {
            tags.value = data;
        });
};

const create = () => {
    if (isRecurring.value === true) {
        axios.post('/api/recurrings', {
            type: type.value,
            interval: recurringInterval.value,
            day: happenedOn.value.split('-')[2],
            start: happenedOn.value,
            tag_id: tagId.value,
            description: description.value,
            amount: amount.value,
        }, {
            headers: {
                'api-key': localStorage.getItem('api_key'),
            },
        })
            .then(() => {
                router.push({ name: 'transactions.index' });
            })
            .catch(() => {
                alert('Something went wrong');
            });
    } else {
        axios.post('/api/transactions', {
            type: type.value,
            tag_id: tagId.value,
            happened_on: happenedOn.value,
            description: description.value,
            amount: amount.value,
        }, {
            headers: {
                'api-key': localStorage.getItem('api_key'),
            },
        })
            .then(() => {
                router.push({ name: 'transactions.index' });
            })
            .catch(() => {
                alert('Something went wrong');
            });
    }
};

fetchTags();
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
                    <select class="w-full px-3.5 py-2.5 text-sm dark:text-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg appearance-none" v-model="tagId">
                        <option :value="null">-</option>
                        <option v-for="tag in tags" :key="tag.id" :value="tag.id">{{ tag.name }}</option>
                    </select>
                </div>
                <div>
                    <label class="mb-2 block text-sm dark:text-white">Date</label>
                    <input class="w-full px-3.5 py-2.5 text-sm dark:text-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg" type="text" v-model="happenedOn" />
                </div>
                <div>
                    <label class="mb-2 block text-sm dark:text-white">Description</label>
                    <input class="w-full px-3.5 py-2.5 text-sm dark:text-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg" type="text" :placeholder="type === 'earning' ? 'Paycheck February' : 'Birthday present for Angela'" v-model="description" />
                </div>
                <div>
                    <label class="mb-2 block text-sm dark:text-white">Amount</label>
                    <input class="w-full px-3.5 py-2.5 text-sm dark:text-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg" type="text" v-model="amount" />
                </div>
                <div class="flex space-x-2">
                    <button class="mt-0.5 w-5 h-5 border rounded-md" :class="{ 'bg-gray-900 border-none': isRecurring }" @click="isRecurring = !isRecurring"></button>
                    <button class="flex-1 text-left text-sm dark:text-white" @click="isRecurring = !isRecurring">This is a recurring transaction—create it for me in the future</button>
                </div>
                <div v-if="isRecurring" class="flex flex-wrap gap-2">
                    <button class="px-3 py-2 text-sm border border-gray-200 rounded-lg" :class="{ 'bg-gray-100': recurringInterval === 'yearly' }" @click="recurringInterval = 'yearly'">Yearly</button>
                    <button class="px-3 py-2 text-sm border border-gray-200 rounded-lg" :class="{ 'bg-gray-100': recurringInterval === 'monthly' }" @click="recurringInterval = 'monthly'">Monthly</button>
                    <button class="px-3 py-2 text-sm border border-gray-200 rounded-lg" :class="{ 'bg-gray-100': recurringInterval === 'biweekly' }" @click="recurringInterval = 'biweekly'">Biweekly</button>
                    <button class="px-3 py-2 text-sm border border-gray-200 rounded-lg" :class="{ 'bg-gray-100': recurringInterval === 'weekly' }" @click="recurringInterval = 'weekly'">Weekly</button>
                    <button class="px-3 py-2 text-sm border border-gray-200 rounded-lg" :class="{ 'bg-gray-100': recurringInterval === 'daily' }" @click="recurringInterval = 'daily'">Daily</button>
                </div>
                <button class="w-full py-3 text-sm text-white bg-gray-900 dark:bg-gray-950 rounded-lg" @click="create()">Create</button>
            </div>
        </div>
    </div>
</template>
