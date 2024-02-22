<template>
    <Link :href="route('clientarea.invoices.show', invoice.invoice_number)" class="bg-card p-3 rounded-xl" role="button">
        <div class="flex items-center justify-between text-sm mb-2">
            <span class="text-gray-400">{{ invoice.created_at }}</span>
            <span class="text-gray-600">{{ invoice.deleted_at ? 'ELIMINADA' : 'VENDIDO' }}</span>
        </div>
        <span class="block text-sm text-gray-600 mb-2 font-bold">
            No. {{ invoice.invoice_number }}
        </span>
        <span class="block text-sm text-gray-600 mb-2">
            {{ invoice.user }}
        </span>
        <span class="block text-sm text-gray-600 mb-2">
            Rifa: {{ invoice.raffle }}
        </span>
        <div class="mt-3 text-end text-gray-600">
            <strong>Total: {{ invoice.total }}</strong>
        </div>
    </Link>
</template>

<script setup>
import { Carbon } from '@/Use/Carbon.js';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    invoice: {
        type: Object,
        required: true
    }
})

</script>
