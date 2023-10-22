<template>
    <AppLayout title="Ventas" :breads="breads">

        <template #header>
            <span class="title">
                Ventas
            </span>
        </template>

        <div class="grid grid-cols-4 gap-4 mb-4">
            <StatCard v-for="stat in stats" :stat="stat" :key="stat.title" />
        </div>

        <TableSection>
            <template #header>
                <th>Vendedor</th>
                <th>Rifa</th>
                <th>Turno</th>
                <th>Monto</th>
                <th>Numero</th>
                <th>Fecha</th>
            </template>
            <template #body>
                <tr v-for="transaction in transactions.data">
                    <td>
                        {{ transaction.user.name }}
                    </td>
                    <td>
                        {{ transaction.raffle.name }}
                    </td>
                    <td>
                        <span class="whitespace-nowrap">
                            {{ Carbon.create().setTime(transaction.hour).getTimeFormat() }}
                        </span>
                    </td>
                    <td>
                        C${{ transaction.amount }}
                    </td>
                    <td>
                        {{ transaction.digit }}
                    </td>
                    <td>
                        {{ Carbon.create(transaction.created_at).format('d/m/Y H:i') }}
                    </td>
                </tr>
                <tr v-if="transactions.data.length == 0">
                    <td colspan="4" class="text-center">No hay datos</td>
                </tr>
            </template>
            <template #paginator>
                <ThePaginator :links="transactions.links" />
            </template>
        </TableSection>
    </AppLayout>
</template>

<script setup>
import StatCard from '@/Components/StatCard.vue';
import TableSection from '@/Components/TableSection.vue';
import ThePaginator from '@/Components/ThePaginator.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { Carbon } from '@/Use/Carbon.js';
import { IconCurrencyDollar } from '@tabler/icons-vue';
import { computed } from 'vue';


const props = defineProps({
    transactions: {
        type: Object,
        required: true,
    },
    daily_transactions: {
        type: Object,
        required: true,
    },
});

const breads = [
    {
        name: 'Inicio',
        route: route('clientarea.index'),
    },
    {
        name: 'Ventas',
        route: route('clientarea.transactions.index'),
    },
];

const stats = computed(() => {
    return [
        {
            title: 'Ventas del dia',
            value: "C$" + props.daily_transactions.toLocaleString(),
            icon: IconCurrencyDollar,
        },
    ]
})

</script>