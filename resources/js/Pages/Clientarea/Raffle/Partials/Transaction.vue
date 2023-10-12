<template>
    <div>
        <TableSection>
            <template #header>
                <th>Vendedor</th>
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
                            {{ transaction.user.name }}
                        </div>
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
                </tr>
                <tr v-if="transactions.data.length == 0">
                    <td colspan="4" class="text-center">No hay datos</td>
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