<template>
    <ClientareaLayout title="Inicio">
        <template #options>
            <Tabs />
        </template>
        <template #header>
            <span class="title">
                {{ raffle.name }}: Ganadores
            </span>
        </template>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-4 text-gray-600">
            <InputForm v-model="queryParams.date" text="Fecha" type="date" />
        </div>

        <div v-if="transactions.length == 0" class="w-full text-center text-gray-400">
            No hay transacciones
        </div>
        <div v-else class="grid grid-cols-1 lg:grid-cols-3 gap-4 mb-4">
            <Transaction :transaction="transaction" v-for="transaction in transactions" :key="transaction.id" />
        </div>

    </ClientareaLayout>
</template>

<script setup>
import ClientareaLayout from '@/Layouts/ClientareaLayout.vue';
import Tabs from '@/Components/Tabs.vue';
import InputForm from '@/Components/Form/InputForm.vue';
import { reactive, watch } from 'vue';
import { router } from "@inertiajs/vue3";
import Transaction from '@/Components/Transaction.vue';

const props = defineProps({
    transactions: {
        type: Object,
        required: true,
    },
    raffle: {
        type: Object,
        required: true,
    },
});

const queryParams = reactive({
    date: '',
});

watch(() => queryParams.date, (value) => {
    if (!value) {
        delete queryParams.date
    }

    router.get(route('clientarea.results.show', props.raffle.id), queryParams, {
        preserveState: true,
        only: ['transactions'],
    });
});

</script>