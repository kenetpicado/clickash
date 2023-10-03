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
            </template>
            <template #body>
                <tr v-for="transaction in transactions.data">
                    <td>
                        <div class="text-xs text-gray-400 mb-1">
                            #{{ transaction.id }} - {{ Carbon.create(transaction.created_at).diffForHumans() }}
                        </div>
                        <div class="mb-1 ">
                            {{ transaction.raffle.name }}
                        </div>
                        <div class="text-gray-400">
                            {{ transaction.client }}
                        </div>
                    </td>
                    <td>
                        <span class="badge-blue whitespace-nowrap" >
                            {{ Carbon.create().setTime(transaction.hour).getTimeFormat() }}
                        </span>
                    </td>
                    <td>
                        C${{ transaction.amount }}
                    </td>
                    <td>
                        <span class="font-semibold">
                            #{{ transaction.digit }}
                        </span>
                    </td>
                </tr>
                <tr v-if="transactions.data.length == 0">
                    <td colspan="4" class="text-center">No hay datos</td>
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