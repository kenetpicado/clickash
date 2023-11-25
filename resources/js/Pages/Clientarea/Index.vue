<template>
    <ClientareaLayout title="Inicio">
        <template #options>
            <button type="button" :class="selectedTab == 'raffle' ? 'active-tab' : 'inactive-tab'"
                @click="selectedTab = 'raffle'">
                Rifas
            </button>
            <button type="button" :class="selectedTab == 'seller' ? 'active-tab' : 'inactive-tab'"
                @click="selectedTab = 'seller'">
                Vendedores
            </button>
            <button type="button" :class="selectedTab == 'transaction' ? 'active-tab' : 'inactive-tab'"
                @click="selectedTab = 'transaction'">
                Transacciones
            </button>
        </template>
        <template #header>
            <span class="title">
                {{ selectedTab == 'raffle' ? 'Rifas' : selectedTab == 'seller' ? 'Vendedores' : 'Transacciones' }}
            </span>
            <button v-if="selectedTab == 'seller'" @click="triggerNew = !triggerNew" type="button" class="simple-button">
                Nuevo
            </button>
        </template>

        <RaffleTab v-if="selectedTab == 'raffle'" :raffles="raffles" />

        <SellerTab v-if="selectedTab == 'seller'" :sellers="sellers" :triggerNew="triggerNew" />

        <TransactionTab v-if="selectedTab == 'transaction'" :transactions="transactions"
            :dailyTransactions="daily_transactions" />

    </ClientareaLayout>
</template>

<script setup>
import RaffleTab from '@/Components/RaffleTab.vue';
import SellerTab from '@/Components/SellerTab.vue';
import TransactionTab from '@/Components/TransactionTab.vue';
import ClientareaLayout from '@/Layouts/ClientareaLayout.vue';
import { ref, watch } from 'vue';

defineProps({
    raffles: {
        type: Object,
        required: true,
    },
    sellers: {
        type: Object,
        required: true,
    },
    transactions: {
        type: Object,
        required: true,
    },
    daily_transactions: {
        type: Number,
        required: true,
    },
});

const selectedTab = ref(localStorage.getItem('selectedTab') || 'raffle')
const triggerNew = ref(false)

watch(() => selectedTab.value, (value) => {
    localStorage.setItem('selectedTab', value)
})

</script>