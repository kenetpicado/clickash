<template>
    <ClientareaLayout title="Reporte">
        <template #header>
            <span class="title">
                Reporte de ventas
            </span>
        </template>

        <div class="grid grid-cols-1 lg:grid-cols-4">
            <InputForm v-model="queryParams.date" text="Fecha" type="date"/>
            <SelectForm v-model="queryParams.hour" text="Turno">
                <option v-if="hours.length > 0" value="" selected>Seleccione un turno</option>
                <option v-else value="" selected>No hay turnos</option>
                <option v-for="i in hours" :value="i">{{ Carbon.create().setTime(i).getTimeFormat() }}</option>
            </SelectForm>
        </div>

        <TableSection>
            <template #header>
                <th>Dígito</th>
                <th>Total</th>
            </template>
            <template #body>
                <tr v-for="item in sales_by_number">
                    <td>
                        {{ item.digit }}
                    </td>
                    <td>
                        C${{ item.total.toLocaleString() }}
                    </td>
                </tr>
                <tr v-if="sales_by_number.length == 0">
                    <td colspan="2" class="text-center">No hay datos</td>
                </tr>
            </template>
        </TableSection>
    </ClientareaLayout>
</template>

<script setup>
import InputForm from '@/Components/Form/InputForm.vue';
import SelectForm from '@/Components/Form/SelectForm.vue';
import TableSection from '@/Components/TableSection.vue';
import ClientareaLayout from '@/Layouts/ClientareaLayout.vue';
import { Carbon } from '@/Use/Carbon';
import { router } from '@inertiajs/vue3';
import { watch, reactive } from 'vue';

const props = defineProps({
    raffle: {
        type: Object,
        required: true,
    },
    sales_by_number: {
        type: Object,
        required: true,
    },
    hours: {
        type: Object,
        required: true,
    },
})

const queryParams = reactive({
    hour: '',
    date: ''
})

const searchParams = new URLSearchParams(window.location.search);

if (searchParams.get("hour")) {
    queryParams.hour = searchParams.get("hour");
}

if (searchParams.get("date")) {
    queryParams.date = searchParams.get("date");
}

watch(() => [queryParams.hour, queryParams.date], ([hour, date]) => {

    if (!hour)
        delete queryParams.hour

    if (!date)
        delete queryParams.date

    router.get(route('clientarea.raffles.reports', props.raffle.id), queryParams, {
        preserveState: true,
        preserveScroll: true,
        only: ['sales_by_number'],
    });
});

</script>