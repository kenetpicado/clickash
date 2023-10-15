<template>
    <AppLayout title="Vendedor" :breads="breads">

        <template #header>
            <span class="title">
                {{ seller.name }}
            </span>
        </template>

        <TableSection>
            <template #header>
                <th>Rifa</th>
                <th>Turno</th>
                <th>Monto</th>
                <th>Numero</th>
                <th>Fecha</th>
            </template>
            <template #body>
                <tr v-for="transaction in transactions.data">
                    <td>
                        {{ transaction.raffle.name }}
                    </td>
                    <td>
                        <span class="whitespace-nowrap" >
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
                        {{ Carbon.create(transaction.created_at).format('d/m/Y') }}
                    </td>
                </tr>
                <tr v-if="transactions.data.length == 0">
                    <td colspan="5" class="text-center">No hay datos</td>
                </tr>
            </template>
            <template #paginator>
               <ThePaginator :links="transactions.links"/>
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
    seller: {
        type: Object,
        required: true,
    },
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
        name: 'Vendedores',
        route: route('clientarea.sellers.index'),
    },
    {
        name: "Ver",
        route: route('clientarea.sellers.show', props.seller.id),
    }
];

</script>