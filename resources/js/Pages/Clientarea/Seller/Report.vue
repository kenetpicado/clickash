<template>
    <ClientareaLayout title="Reportes">
        <template #header>
            <span class="title">
                {{ seller.name }}: Reporte de ventas
            </span>
        </template>

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 text-gray-600">
            <SelectForm v-model="queryParams.raffle_id" text="Rifa" class="mb-0">
                <option value="" selected>Ninguna</option>
                <option v-for="i in raffles" :value="i.id">{{ i.name }}</option>
            </SelectForm>
            <SelectForm v-if="queryParams.raffle_id" v-model="queryParams.hour" text="Turno" class="mb-0">
                <option value="" selected>Ninguno</option>
                <option v-for="i in selectedRaffle?.hours" :value="i">
                    {{ i }}
                </option>
            </SelectForm>
            <InputForm v-model="queryParams.date" text="Fecha" type="date" />
        </div>

        <ReportView :sales="sales" :total="total" />
    </ClientareaLayout>
</template>

<script setup>
import InputForm from '@/Components/Form/InputForm.vue';
import SelectForm from '@/Components/Form/SelectForm.vue';
import ReportView from '@/Components/ReportView.vue';
import ClientareaLayout from '@/Layouts/ClientareaLayout.vue';
import { router } from '@inertiajs/vue3';
import { watch, reactive, computed } from 'vue';

const props = defineProps({
    seller: {
        type: Object,
        required: true,
    },
    raffles: {
        type: Object,
        required: true,
    },
    sales: {
        type: Object,
        required: true,
    },
    total: {
        type: String,
        required: true
    }
})

const searchParams = new URLSearchParams(window.location.search);

const queryParams = reactive({
    raffle_id: searchParams.get("raffle_id") ?? '',
    hour: searchParams.get("hour") ?? '',
    date: searchParams.get("date") ?? '',
})

const selectedRaffle = computed(() => {
    return props.raffles.find(i => i.id == queryParams.raffle_id);
});

watch(() => queryParams, () => {
    let params = { ...queryParams };

    for (const key in params) {
        if (!params[key]) delete params[key];
    }

    router.get(route('clientarea.sellers.reports.index', props.seller.id), params, {
        preserveState: true,
        preserveScroll: true,
        only: ['sales', 'total'],
        replace: true
    });
}, { deep: true, immediate: true });

</script>
