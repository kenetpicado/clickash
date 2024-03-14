<template>
    <ClientareaLayout title="Detalles">
        <template #header>
            <span class="title">
                Detalles
            </span>
        </template>

        <div class="mb-4 text-gray-600 space-y-2">
            <h2>Recibo: {{ invoice_number }}</h2>
            <h2>Rifa: {{ raffle }}</h2>
            <h2>Vendedor: {{ user }}</h2>
            <h2>Total: C$ {{ total.toLocaleString() }}</h2>
        </div>

        <div v-if="transactions.length == 0" class="w-full text-center text-gray-400">
            No hay datos que mostrar
        </div>
        <div v-else class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-4">
            <Transaction :transaction="i" v-for="i in transactions" :key="i.id" />
        </div>

    </ClientareaLayout>
</template>

<script setup>
import ClientareaLayout from '@/Layouts/ClientareaLayout.vue';
import Transaction from '@/Components/Transaction.vue';

const props = defineProps({
    transactions: {
        type: Object,
        required: true,
    },
    total: {
        type: [String, Number],
        required: true,
    },
    invoice_number: {
        type: String,
        required: true,
    },
    raffle: {
        type: String,
        required: true,
    },
    user: {
        type: String,
        required: true,
    },
});

</script>