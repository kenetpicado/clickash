<template>
    <ClientareaLayout title="Vendedores">
        <template #header>
            <span class="title">
                Vendedores
            </span>
            <button @click="triggerNew = !triggerNew" type="button" class="primary-button">
                Nuevo
            </button>
        </template>

        <SellerTab :triggerNew="triggerNew" />

    </ClientareaLayout>
</template>

<script setup>
import SellerTab from '@/Components/SellerTab.vue';
import ClientareaLayout from '@/Layouts/ClientareaLayout.vue';
import { ref } from 'vue';

const triggerNew = ref(false)

</script>