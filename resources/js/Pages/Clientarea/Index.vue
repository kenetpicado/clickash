<template>
    <ClientareaLayout title="Rifas">
        <template #header>
            <span class="title">
                Rifas
            </span>
        </template>

        <!-- SHOULD BE REMOVED -->

        <RaffleTab :raffles="raffles" />

    </ClientareaLayout>
</template>

<script setup>
import RaffleTab from '@/Components/RaffleTab.vue';
import ClientareaLayout from '@/Layouts/ClientareaLayout.vue';

defineProps({
    raffles: {
        type: Object,
        required: true,
    },
});

</script>