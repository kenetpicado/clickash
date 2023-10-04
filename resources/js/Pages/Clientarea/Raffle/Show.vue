<template>
    <AppLayout title="Rifa" :breads="breads">

        <template #header>
            <span class="title">
                {{ raffle.name }}
            </span>
            <AddButton v-if="currentTab == 1" @click="openModalNumber = true" />
            <AddButton v-if="currentTab == 2" @click="openModalSchedule = true" />
        </template>

        <div class="flex gap-3 overflow-x-auto hide-scrollbar mb-4">
            <div :class="currentTab == 0 ? 'active-tab' : 'inactive-tab'" @click="currentTab = 0" role="button">
                Ventas
            </div>
            <div :class="currentTab == 1 ? 'active-tab' : 'inactive-tab'" @click="currentTab = 1" role="button">
                Bloqueados
            </div>
            <div :class="currentTab == 2 ? 'active-tab' : 'inactive-tab'" @click="currentTab = 2" role="button">
                Disponibilidad
            </div>
        </div>

        <Transaction v-if="currentTab == 0" :transactions="transactions" />

        <BlockedNumber v-if="currentTab == 1" :blockeds="blockeds" :raffle="raffle" v-model:openModal="openModalNumber" />

        <Availability v-if="currentTab == 2" :availability="availability" :raffle="raffle"
            v-model:openModal="openModalSchedule" />

    </AppLayout>
</template>

<script setup>
import AddButton from '@/Components/Buttons/AddButton.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { ref, watch } from 'vue';
import Availability from "./Partials/Availability.vue";
import BlockedNumber from './Partials/BlockedNumber.vue';
import Transaction from './Partials/Transaction.vue';

const props = defineProps({
    raffle: {
        type: Object,
        required: true,
    },
    transactions: {
        type: Object,
        required: true,
    },
    blockeds: {
        type: Object,
        required: true,
    },
    availability: {
        type: Object,
        required: true,
    },
});

const breads = [
    {
        name: 'Inicio',
        route: route('clientarea.index'),
    },
    {
        name: 'Rifas',
        route: route('clientarea.raffles.index'),
    },
    {
        name: props.raffle.name,
        route: route('clientarea.raffles.show', props.raffle.id),
    }
];

const currentTab = ref(localStorage.getItem('currentTab') || 0);
const openModalNumber = ref(false);
const openModalSchedule = ref(false);

watch(currentTab, (value) => {
    localStorage.setItem('currentTab', value);
});

</script>