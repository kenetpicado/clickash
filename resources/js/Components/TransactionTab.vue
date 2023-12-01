<template>
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-4 mb-4">
        <StatCard v-for="stat in stats" :stat="stat" :key="stat.title" />
    </div>

    <div v-if="transactions.data.length == 0" class="w-full text-center text-gray-400">
        No hay transacciones
    </div>
    <div v-else class="grid grid-cols-1 lg:grid-cols-3 gap-4 mb-4">
        <Transaction :transaction="transaction" v-for="transaction in transactions.data" :key="transaction.id" />
    </div>

    <ThePaginator :links="transactions.links" />
</template>

<script setup>
import { IconCurrencyDollar } from '@tabler/icons-vue';
import ThePaginator from './ThePaginator.vue';
import Transaction from './Transaction.vue';
import StatCard from './StatCard.vue';

const props = defineProps({
    transactions: {
        type: Object,
        required: true
    },
    dailyTransactions: {
        type: Number,
        required: true
    }
})

const stats = [
    {
        title: 'Ventas del dia',
        value: "C$" + props.dailyTransactions.toLocaleString(),
        icon: IconCurrencyDollar,
    },
]

</script>