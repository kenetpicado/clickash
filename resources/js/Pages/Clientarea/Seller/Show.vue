<template>
    <ClientareaLayout title="Ventas">
        <template #header>
            <span class="title">
                {{ seller.name }}
            </span>
        </template>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-4 text-gray-600">
            <InputForm v-model="queryParams.date" text="Fecha" type="date" />
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-4 mb-4">
            <StatCard v-for="stat in stats" :stat="stat" :key="stat.title" />
        </div>

        <SwitchGroup>
            <div class="flex items-center mb-5">
                <SwitchLabel class="mr-4 text-gray-400">Ver eliminadas</SwitchLabel>
                <Switch v-model="queryParams.trashed" :class='queryParams.trashed ? "bg-primary" : "bg-gray-200"'
                    class="relative inline-flex h-6 w-11 items-center rounded-full transition-colors">
                    <span :class='queryParams.trashed ? "translate-x-6" : "translate-x-1"'
                        class="inline-block h-4 w-4 transform rounded-full bg-white transition-transform" />
                </Switch>
            </div>
        </SwitchGroup>

        <div v-if="transactions.data.length == 0" class="w-full text-center text-gray-400">
            No hay transacciones
        </div>
        <div v-else class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-4">
            <Transaction :transaction="transaction" v-for="transaction in transactions.data" :key="transaction.id" />
        </div>

        <ThePaginator :links="transactions.links" />
    </ClientareaLayout>
</template>

<script setup>
import StatCard from '@/Components/StatCard.vue';
import ThePaginator from '@/Components/ThePaginator.vue';
import ClientareaLayout from '@/Layouts/ClientareaLayout.vue';
import Transaction from '@/Components/Transaction.vue';
import { IconCurrencyDollar } from '@tabler/icons-vue';
import { computed, reactive, watch } from 'vue';
import InputForm from '@/Components/Form/InputForm.vue';
import { router } from '@inertiajs/vue3';
import { Switch, SwitchGroup, SwitchLabel } from '@headlessui/vue'

const props = defineProps({
    seller: {
        type: Object,
        required: true,
    },
    transactions: {
        type: Object,
        required: true,
    },
    daily_transactions: {
        type: [Number, String],
        required: true,
    }
});

const stats = computed(() => {
    return [
        {
            title: queryParams.date ? 'Ventas' : 'Ventas de hoy',
            value: "C$" + props.daily_transactions.toLocaleString(),
            icon: IconCurrencyDollar,
        },
    ]
})

const urlParams = new URLSearchParams(window.location.search);

const queryParams = reactive({
    date: urlParams.get('date') ?? '',
    trashed: Boolean(urlParams.get('trashed')),
});

watch(() => queryParams, () => {
    for (const key in queryParams) {
        if (!queryParams[key]) delete queryParams[key];
    }

    router.get(route('clientarea.sellers.show', props.seller.id), queryParams, {
        preserveState: true,
        preserveScroll: true,
        only: ['transactions', 'daily_transactions'],
    });
}, { deep: true });

</script>