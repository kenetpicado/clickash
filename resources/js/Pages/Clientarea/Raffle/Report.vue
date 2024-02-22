<template>
    <ClientareaLayout title="Reporte">
        <template #header>
            <span class="title">
                {{ raffle.name }}: Reporte de ventas
            </span>
        </template>

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 text-gray-600">
            <InputForm v-model="queryParams.date" text="Fecha" type="date" />
            <SelectForm v-model="queryParams.hour" text="Turno">
                <option value="">Ninguno</option>
                <option v-for="i in raffle.hours" :value="i">
                    {{ Carbon.create().setTime(i).getTimeFormat() }}
                </option>
            </SelectForm>
        </div>

        <ReportView :sales="sales" :total="total" />
    </ClientareaLayout>
</template>

<script setup>
import InputForm from '@/Components/Form/InputForm.vue';
import SelectForm from '@/Components/Form/SelectForm.vue';
import ReportView from '@/Components/ReportView.vue';
import ClientareaLayout from '@/Layouts/ClientareaLayout.vue';
import { Carbon } from '@/Use/Carbon';
import { router } from '@inertiajs/vue3';
import { watch, reactive } from 'vue';

const props = defineProps({
    raffle: {
        type: Object,
        required: true,
    },
    sales: {
        type: Object,
        required: false
    },
    total: {
        type: String,
        required: false
    }
})

const searchParams = new URLSearchParams(window.location.search);

const queryParams = reactive({
    hour: searchParams.get("hour") ?? '',
    date: searchParams.get("date") ?? '',
})

watch(() => queryParams, () => {
    let params = { ...queryParams }

    for (const key in params) {
        if (!params[key]) delete params[key];
    }

    router.get(route('clientarea.raffles.reports', props.raffle.id), params, {
        preserveState: true,
        preserveScroll: true,
        only: ['sales', 'total'],
        replace: true
    });
}, { deep: true, immediate: true });

</script>
