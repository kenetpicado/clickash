<template>
    <ClientareaLayout title="Rifa">
        <template #header>
            <span class="title">
                {{ raffle.name }}
            </span>
        </template>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-4 mb-4">
            <StatCard v-for="stat in stats" :stat="stat" :key="stat.title" />
        </div>

        <div v-if="transactions.data.length == 0" class="w-full text-center text-gray-400">
            No hay transacciones
        </div>
        <div v-else class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-4">
            <Transaction :transaction="transaction" v-for="transaction in transactions.data" :key="transaction.id" />
        </div>

        <ThePaginator :links="transactions.links" />
    </ClientareaLayout>
</template>

<script setup>
import StatCard from '@/Components/StatCard.vue';
import ThePaginator from '@/Components/ThePaginator.vue';
import ClientareaLayout from '@/Layouts/ClientareaLayout.vue';
import Transaction from '@/Components/Transaction.vue';
import { IconCurrencyDollar } from '@tabler/icons-vue';
import { computed } from 'vue';

const props = defineProps({
    raffle: {
        type: Object,
        required: true,
    },
    transactions: {
        type: Object,
        required: true,
    },
    daily_transactions: {
        type: [Number, String],
        required: true,
    }
});

const stats = computed(() => {
    return [
        {
            title: 'Ventas de hoy',
            value: "C$" + props.daily_transactions.toLocaleString(),
            icon: IconCurrencyDollar,
        },
    ]
})

</script>