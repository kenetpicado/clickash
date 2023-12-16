<template>
    <ClientareaLayout title="Inicio">
        <template #header>
            <span class="title">
                Resultados
            </span>
        </template>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-4 text-gray-600">
            <InputForm v-model="queryParams.date" text="Fecha" type="date" />
        </div>

        <ResultTab :results="results" />

    </ClientareaLayout>
</template>

<script setup>
import ClientareaLayout from '@/Layouts/ClientareaLayout.vue';
import ResultTab from '@/Components/ResultTab.vue';
import InputForm from '@/Components/Form/InputForm.vue';
import { reactive, watch } from 'vue';
import { router } from "@inertiajs/vue3";

defineProps({
    results: {
        type: Object,
        required: true,
    },
});

const queryParams = reactive({
    date: '',
});

watch(() => queryParams.date, (value) => {
    if (!value) {
        delete queryParams.date
    }

    router.get(route('clientarea.results.index'), queryParams, {
        preserveState: true,
        only: ['results'],
    });
});

</script>