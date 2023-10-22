<template>
    <AppLayout title="Rifa" :breads="breads">

        <template #header>
            <span class="title">
                {{ raffle.name }}
            </span>
            <AddButton v-if="currentTab == 1" @click="openModalNumber = true" />
            <AddButton v-if="currentTab == 2" @click="openModalSchedule = true" />
            <AddButton v-if="currentTab == 3" @click="openModalResult = true" />
        </template>

        <div class="flex gap-3 overflow-x-auto hide-scrollbar mb-4">
            <div :class="currentTab == 0 ? 'active-tab' : 'inactive-tab'" @click="currentTab = 0" role="button">
                Ventas
            </div>
            <div :class="currentTab == 1 ? 'active-tab' : 'inactive-tab'" @click="currentTab = 1" role="button">
                Bloqueados
            </div>
            <div :class="currentTab == 2 ? 'active-tab' : 'inactive-tab'" @click="currentTab = 2" role="button">
                Horario
            </div>
            <div :class="currentTab == 3 ? 'active-tab' : 'inactive-tab'" @click="currentTab = 3" role="button">
                Resultados
            </div>
        </div>

        <template v-if="currentTab == 0">
            <div class="grid grid-cols-4 gap-4 mb-4">
                <StatCard v-for="stat in stats" :stat="stat" :key="stat.title" />
            </div>

            <Transaction :transactions="transactions" />
        </template>

        <BlockedNumber v-if="currentTab == 1" :blockeds="blockeds" :raffle="raffle" v-model:openModal="openModalNumber" />

        <Availability v-if="currentTab == 2" :availability="availability" :raffle="raffle"
            v-model:openModal="openModalSchedule" />

        <template v-if="currentTab == 3">
            <div class="grid grid-cols-4 gap-4 mb-4">
                <StatCard v-for="s in result_stats" :stat="s" :key="s.title" />
            </div>

            <WinningNumber :results="results" :raffle="raffle" v-model:openModal="openModalResult"
                :currentBlockedHours="currentBlockedHours" :winners="winners" :settings="settings" />
        </template>
    </AppLayout>
</template>

<script setup>
import AddButton from '@/Components/Buttons/AddButton.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { computed, ref, watch } from 'vue';
import Availability from "./Partials/Availability.vue";
import BlockedNumber from './Partials/BlockedNumber.vue';
import Transaction from './Partials/Transaction.vue';
import WinningNumber from './Partials/WinningNumber.vue';
import StatCard from '@/Components/StatCard.vue';
import { IconCurrencyDollar } from '@tabler/icons-vue';
import { Carbon } from '@/Use/Carbon';
import { IconCurrencyDollarOff } from '@tabler/icons-vue';

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
    results: {
        type: Object,
        required: true,
    },
    winners: {
        type: Object,
        required: true,
    },
    settings: {
        type: Object,
        required: true,
    },
    daily_transactions: {
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
const openModalResult = ref(false);

watch(currentTab, (value) => {
    localStorage.setItem('currentTab', value);
});

const currentBlockedHours = props.availability.filter((item) => {
    return item.order == new Date().getDay();
});

const stats = computed(() => {
    return [
        {
            title: 'Ventas del dia',
            value: "C$" + props.daily_transactions.toLocaleString(),
            icon: IconCurrencyDollar,
        },
        {
            title: 'Premios del dia',
            value: "C$" + props.winners.reduce((acc, item) => acc + parseFloat(item.prize), 0).toLocaleString(),
            icon: IconCurrencyDollarOff,
        }
    ]
})

const result_stats = computed(() => {
    return props.results.map((result) => {
        return {
            title: Carbon.create().setTime(result.hour).getTimeFormat(),
            value: result.number,
            icon: IconCurrencyDollar,
        }
    })
})

</script>