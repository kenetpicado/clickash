<template>
    <div class="bg-card p-3 rounded-xl">
        <div class="flex items-center justify-between text-sm mb-2">
            <span class="text-gray-400">{{ Carbon.create(transaction.created_at).format('d/m/Y H:i') }}</span>
            <span class="text-gray-600">{{ transaction.status }}</span>
        </div>
        <span class="block text-sm text-gray-600 mb-2 font-bold">
            No. {{ transaction.id }}
        </span>
        <span v-if="transaction.user" class="block text-sm text-gray-600 mb-2">
            {{ transaction.user.name }}
        </span>
        <div class="text-gray-600 grid grid-cols-2 gap-1 text-sm">
            <span v-if="transaction.raffle">
                Rifa: {{ transaction.raffle.name }}
            </span>
            <span>Hora: {{ Carbon.create().setTime(transaction.hour).getTimeFormat() }}</span>
            <span>Dígito: {{ transaction.digit }}</span>
            <span>Super X: {{ transaction.super_x ? 'Si' : 'No' }}</span>
            <span>Monto: C${{ transaction.super_x ? transaction.amount / 2 : transaction.amount }}</span>
            <strong>Premio: C${{ transaction.prize.toLocaleString() }}</strong>
        </div>
        <div class="mt-3 text-end text-gray-600">
            <strong>Total: C${{ transaction.amount.toLocaleString() }}</strong>
        </div>
    </div>
</template>

<script setup>
import { Carbon } from '@/Use/Carbon.js';

const props = defineProps({
    transaction: {
        type: Object,
        required: true
    }
})

</script>