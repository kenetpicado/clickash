<template>
    <div>
        <TableSection>
            <template #header>
                <th>Numero</th>
                <th>Cantidad</th>
                <th>Total</th>
            </template>
            <template #body>
                <tr v-for="item in sales">
                    <td>
                        {{ item.digit }}
                    </td>
                    <td>
                        {{ item.count }}
                    </td>
                    <td>
                        C$ {{ item.total.toLocaleString() }}
                    </td>
                </tr>
                <tr v-if="sales.length == 0">
                    <td colspan="3" class="text-center">No hay datos</td>
                </tr>
            </template>
        </TableSection>
    </div>
</template>

<script setup>
import TableSection from '@/Components/TableSection.vue';

const props = defineProps({
    sales: {
        type: Object,
        required: true,
    },
});

</script>