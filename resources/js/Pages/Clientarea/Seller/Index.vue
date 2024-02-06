<template>
    <ClientareaLayout title="Inicio">
        <template #header>
            <span class="title">
                Vendedores
            </span>
            <button @click="triggerNew = !triggerNew" type="button" class="simple-button">
                Nuevo
            </button>
        </template>

        <SellerTab :sellers="sellers" :triggerNew="triggerNew" />

    </ClientareaLayout>
</template>

<script setup>
import SellerTab from '@/Components/SellerTab.vue';
import ClientareaLayout from '@/Layouts/ClientareaLayout.vue';
import { ref } from 'vue';

defineProps({
    sellers: {
        type: Object,
        required: true,
    },
});

const triggerNew = ref(false)

</script>