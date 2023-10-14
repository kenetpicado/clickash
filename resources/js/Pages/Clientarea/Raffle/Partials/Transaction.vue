<template>
    <div>
        <TableSection>
            <template #header>
                <th>Vendedor</th>
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
                        <span class="badge-primary whitespace-nowrap">
                            {{ Carbon.create().setTime(transaction.hour).getTimeFormat() }}
                        </span>
                    </td>
                    <td>
                        C${{ transaction.amount }}
                    </td>
                    <td>
                        <span class="badge-primary">
                            {{ transaction.digit }}
                        </span>
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
                <ThePaginator :links="transactions.links" />
            </template>
        </TableSection>
    </div>
</template>

<script setup>
import TableSection from '@/Components/TableSection.vue';
import ThePaginator from '@/Components/ThePaginator.vue';
import { Carbon } from '@/Use/Carbon.js';

const props = defineProps({
    transactions: {
        type: Object,
        required: true,
    },
});

</script>