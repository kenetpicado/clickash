<template>
    <div class="bg-card p-3 rounded-xl">
        <div class="flex items-center justify-between text-sm mb-2">
            <span class="text-gray-400">{{ transaction.created_at }}</span>
            <span class="text-gray-600">{{ transaction.status }}</span>
        </div>
        <span v-if="showInvoice" class="block text-sm text-gray-600 mb-2 font-bold">
            Recibo: {{ transaction.invoice_number }}
        </span>
        <span v-if="transaction.user" class="block text-sm text-gray-600 mb-2">
            Vendedor: {{ transaction.user.data?.name }}
        </span>
        <div class="text-gray-600 grid grid-cols-2 gap-1 text-sm">
            <span v-if="transaction.raffle">
                Rifa: {{ transaction.raffle.data?.name }}
            </span>
            <span>Hora: {{ transaction.hour }}</span>
            <span>Dígito: {{ transaction.digit }}</span>
            <span>Super X: {{ transaction.super_x ? 'Si' : 'No' }}</span>
            <span>Monto: C${{ transaction.super_x ? transaction.amount / 2 : transaction.amount }}</span>
            <strong>Premio: {{ transaction.prize }}</strong>
        </div>
        <div class="mt-3 text-end text-gray-600">
            <strong>Total: C${{ transaction.amount.toLocaleString() }}</strong>
        </div>
    </div>
</template>

<script setup>

const props = defineProps({
    transaction: {
        type: Object,
        required: true
    },
    showInvoice: {
        type: Boolean,
        default: false
    }
})

</script>