<template>
    <ClientareaLayout title="Rifa">
        <template #header>
            <span class="title">
                {{ raffle.name }}
            </span>
        </template>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-4 text-gray-600">
            <InputForm v-model="queryParams.date" text="Fecha" type="date" />
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-4 mb-4">
            <StatCard v-for="stat in stats" :stat="stat" :key="stat.title" />
        </div>

        <div v-if="invoices.data.length == 0" class="w-full text-center text-gray-400">
            No hay transacciones
        </div>
        <div v-else class="grid grid-cols-1 lg:grid-cols-3 gap-4 mb-4">
            <Invoice :invoice="i" v-for="i in invoices.data" :key="i.invoice_number" />
        </div>

        <ThePaginator :links="invoices.meta.links" />
    </ClientareaLayout>
</template>

<script setup>
import StatCard from '@/Components/StatCard.vue';
import ThePaginator from '@/Components/ThePaginator.vue';
import ClientareaLayout from '@/Layouts/ClientareaLayout.vue';
import Invoice from '@/Components/Invoice.vue';
import { IconCurrencyDollar } from '@tabler/icons-vue';
import { computed, watch, reactive } from 'vue';
import { router } from '@inertiajs/vue3';
import InputForm from '@/Components/Form/InputForm.vue';

const props = defineProps({
    raffle: {
        type: Object,
        required: true,
    },
    invoices: {
        type: Object,
        required: true,
    },
    total: {
        type: String,
        required: true,
    },
});

const stats = computed(() => {
    return [
        {
            title: 'Total',
            value: props.total.toLocaleString(),
            icon: IconCurrencyDollar,
        },
    ]
})

const urlParams = new URLSearchParams(window.location.search);

const queryParams = reactive({
    date: urlParams.get('date') ?? '',
});

watch(() => queryParams, () => {
    let params = { ...route().params, ...queryParams };

    for (const key in params) {
        if (!params[key] || key == 'raffle') delete params[key];
    }

    router.get(route('clientarea.raffles.show', props.raffle.id), params, {
        preserveState: true,
        preserveScroll: true,
        only: ['invoices', 'total'],
        replace: true,
    });
}, { deep: true });

</script>
