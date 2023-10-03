<template>
    <AppLayout title="Inicio" :breads="breads">
        <template #header>
            <span class="title">
                Overview
            </span>
        </template>
        <!-- <div class="grid grid-cols-1 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4">
            <div v-for="raffle in raffles" class="flex items-center bg-gray-200 rounded-xl p-2 gap-2">
                <div class="bg-white rounded-xl p-1">
                    <img src="/games.png" alt="" class="w-20 h-20">
                </div>
                <div class="gap-2">
                    <div class="font-semibold">{{ raffle.name }}</div>
                </div>
            </div>
        </div> -->
    </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';

defineProps({
    raffles: {
        type: Object,
        required: true,
    },
});

const breads = [
    {
        name: 'Inicio',
        route: route('clientarea.index'),
    },
];

</script>