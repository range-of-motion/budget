<script setup>
import { router } from '@inertiajs/vue3';
import { reactive } from 'vue';

defineProps({
    tags: Array,
    errors: Object,
});

const form = reactive({
    type: 'earning',
    tag_id: null,
    happened_on: new Date().toISOString().split('T')[0],
    description: null,
    amount: null,
});

const create = () => {
    router.post('/transactions', form);
};
</script>

<template>
    <div class="my-10 mx-auto max-w-sm">
        <div class="mb-5 font-bold text-xl">Create a transaction</div>
        <div class="p-5 bg-white border border-gray-200 rounded-lg">
            <div class="mb-5">
                <div class="inline-flex overflow-hidden divide-x divide-gray-200 border border-gray-200 rounded-lg">
                    <button class="px-4 py-2 text-sm" :class="form.type === 'earning' ? 'bg-gray-100' : null" @click="form.type = 'earning'">Earning</button>
                    <button class="px-4 py-2 text-sm" :class="form.type === 'spending' ? 'bg-gray-100' : null" @click="form.type = 'spending'">Spending</button>
                </div>
            </div>
            <div v-if="form.type === 'spending'" class="mb-5">
                <label class="mb-2 block text-sm">Tag</label>
                <select class="w-full px-3.5 py-2.5 text-sm border border-gray-200 rounded-lg appearance-none" v-model="form.tag_id">
                    <option :value="null">-</option>
                    <option v-for="tag in tags" :value="tag.id">{{ tag.name }}</option>
                </select>
            </div>
            <div class="mb-5">
                <label class="mb-2 block text-sm">Date</label>
                <input class="w-full px-3.5 py-2.5 text-sm border border-gray-200 rounded-lg" v-model="form.happened_on" @keyup.enter="create" />
                <div v-if="errors.happened_on" class="mt-2 text-sm text-red-500">{{ errors.happened_on }}</div>
            </div>
            <div class="mb-5">
                <label class="mb-2 block text-sm">Description</label>
                <input class="w-full px-3.5 py-2.5 text-sm border border-gray-200 rounded-lg" v-model="form.description" :placeholder="form.type === 'earning' ? 'Paycheck' : 'Groceries'" @keyup.enter="create" />
                <div v-if="errors.description" class="mt-2 text-sm text-red-500">{{ errors.description }}</div>
            </div>
            <div class="mb-5">
                <label class="mb-2 block text-sm">Amount</label>
                <div class="relative">
                    <div class="absolute top-0 bottom-0 left-0 flex items-center pl-3.5 text-sm text-gray-400">€</div>
                    <input class="w-full pl-7 pr-3.5 py-2.5 text-sm border border-gray-200 rounded-lg" v-model="form.amount" placeholder="0.00" @keyup.enter="create" />
                </div>
                <div v-if="errors.amount" class="mt-2 text-sm text-red-500">{{ errors.amount }}</div>
            </div>
            <button class="px-4 py-3 leading-none font-medium text-sm text-white bg-gray-900 rounded-lg" @click="create">Create</button>
        </div>
    </div>
</template>
