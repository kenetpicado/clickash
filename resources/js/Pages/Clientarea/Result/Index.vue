<template>
    <ClientareaLayout title="Inicio">
        <template #options>
            <Tabs />
        </template>
        <template #header>
            <span class="title">
                Resultados
            </span>
        </template>

        <ResultTab :results="results" />

    </ClientareaLayout>
</template>

<script setup>
import ClientareaLayout from '@/Layouts/ClientareaLayout.vue';
import ResultTab from '@/Components/ResultTab.vue';
import Tabs from '@/Components/Tabs.vue';

defineProps({
    results: {
        type: Object,
        required: true,
    },
});

</script>