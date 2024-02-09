<template>
    <ClientareaLayout title="Transacciones">
        <template #header>
            <span class="title">
                Transacciones
            </span>
        </template>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-4 text-gray-600">
            <InputForm v-model="queryParams.date" text="Fecha" type="date" />
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-4 mb-4">
            <StatCard
                :stat="{ title: 'Ventas del dia', value: 'C$ ' + daily_transactions.toLocaleString(), icon: IconCurrencyDollar }"/>
        </div>

        <div v-if="transactions.data.length == 0" class="w-full text-center text-gray-400">
            No hay transacciones
        </div>
        <div v-else class="grid grid-cols-1 lg:grid-cols-3 gap-4 mb-4">
            <Transaction :transaction="transaction" v-for="transaction in transactions.data" :key="transaction.id" />
        </div>

        <ThePaginator :links="transactions.links" />

    </ClientareaLayout>
</template>

<script setup>
import ClientareaLayout from '@/Layouts/ClientareaLayout.vue';
import InputForm from '@/Components/Form/InputForm.vue';
import { reactive, watch } from 'vue';
import ThePaginator from '@/Components/ThePaginator.vue';
import Transaction from '@/Components/Transaction.vue';
import StatCard from '@/Components/StatCard.vue';
import { IconCurrencyDollar } from '@tabler/icons-vue';
import { router } from "@inertiajs/vue3";

const props = defineProps({
    transactions: {
        type: Object,
        required: true,
    },
    daily_transactions: {
        type: Number,
        required: true,
    },
});

const searchParams = new URLSearchParams(window.location.search);

const queryParams = reactive({
    date: searchParams.get('date') ?? '',
});

watch(() => queryParams, () => {
    let params = { ...route().params, ...queryParams };

    for (const key in params) {
        if (params[key] === '') {
            delete params[key];
        }
    }

    router.get(route('clientarea.transactions.index'), params, {
        preserveState: true,
        preserveScroll: true,
        only: ['transactions', 'daily_transactions'],
        replace: true,
    });
}, { deep: true });

</script>