<template>
    <ClientareaLayout title="Inicio">
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
            <Transaction :transaction="transaction" v-for="transaction in transactions" :key="transaction.id" :showInvoice="true" />
        </div>

    </ClientareaLayout>
</template>

<script setup>
import ClientareaLayout from '@/Layouts/ClientareaLayout.vue';
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

const urlSearchParams = new URLSearchParams(window.location.search);

const queryParams = reactive({
    date: urlSearchParams.get('date') || null,
});

watch(() => queryParams, () => {
    let params = { ...queryParams };

    for (const key in params) {
        if (!params[key]) delete params[key];
    }

    router.get(route('clientarea.results.show', props.raffle.id), params, {
        preserveState: true,
        only: ['transactions'],
        replace: true,
    });
}, { deep: true });

</script>