<template>
    <AppLayout title="Ventas" :breads="breads">

        <template #header>
            <span class="title">
                Todas las ventas
            </span>
        </template>

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
                        <span class="badge-blue whitespace-nowrap">
                            {{ Carbon.create().setTime(transaction.hour).getTimeFormat() }}
                        </span>
                    </td>
                    <td>
                        C${{ transaction.amount }}
                    </td>
                    <td>
                        <span class="badge-blue">
                            {{ transaction.digit }}
                        </span>
                    </td>
                    <td>
                        {{ Carbon.create(transaction.created_at).format('d/m/Y') }}
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
import TableSection from '@/Components/TableSection.vue';
import ThePaginator from '@/Components/ThePaginator.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { Carbon } from '@/Use/Carbon.js';


const props = defineProps({
    transactions: {
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

</script>