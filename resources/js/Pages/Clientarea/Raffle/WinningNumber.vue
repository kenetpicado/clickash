<template>
    <ClientareaLayout title="Ganadores">
        <template #header>
            <span class="title">
                Ganadores
            </span>
            <button type="button" class="simple-button" @click="openModal = true">
                Nuevo
            </button>
        </template>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-4 mb-4">
            <StatCard v-for="stat in stats" :stat="stat" :key="stat.title" />
        </div>

        <div v-if="winners.length == 0" class="w-full text-center text-gray-400">
            No hay transacciones
        </div>
        <div v-else class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-4">
            <Transaction :transaction="transaction" v-for="transaction in winners" :key="transaction.id" />
        </div>

    </ClientareaLayout>
</template>

<script setup>
import StatCard from '@/Components/StatCard.vue';
import Transaction from '@/Components/Transaction.vue';
import ClientareaLayout from '@/Layouts/ClientareaLayout.vue';
import { Carbon } from '@/Use/Carbon';
import { IconCheck } from '@tabler/icons-vue';
import { computed, defineProps } from 'vue';


const props = defineProps({
    winning_numbers: {
        type: Object,
        required: true,
    },
    winners: {
        type: Object,
        required: true,
    },
})

const stats = computed(() => {
    return props.winning_numbers.map((result) => {
        return {
            title: "Turno: " + Carbon.create().setTime(result.hour).getTimeFormat(),
            value: "Dígito: " + result.number,
            icon: IconCheck,
        }
    })
})

</script>