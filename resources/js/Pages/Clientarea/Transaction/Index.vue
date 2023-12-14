<template>
    <ClientareaLayout title="Inicio">
        <template #options>
            <Tabs />
        </template>
        <template #header>
            <span class="title">
                Transacciones
            </span>
        </template>

        <TransactionTab :transactions="transactions" :dailyTransactions="daily_transactions" />

    </ClientareaLayout>
</template>

<script setup>
import ClientareaLayout from '@/Layouts/ClientareaLayout.vue';
import Tabs from '@/Components/Tabs.vue';
import TransactionTab from '@/Components/TransactionTab.vue';

defineProps({
    transactions: {
        type: Object,
        required: true,
    },
    daily_transactions: {
        type: Number,
        required: true,
    },
});

</script>