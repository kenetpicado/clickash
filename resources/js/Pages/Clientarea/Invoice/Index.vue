<template>
    <ClientareaLayout title="Recibos">
        <template #header>
            <span class="title">
                Recibos
            </span>
        </template>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-4 text-gray-600">
            <InputForm v-model="queryParams.date" text="Fecha" type="date" />
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-4 mb-4">
            <StatCard
                :stat="{ title: 'Total', value: total, icon: IconCurrencyDollar }"/>
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

        <div v-if="invoices.data.length == 0" class="w-full text-center text-gray-400">
            No hay datos que mostrar
        </div>
        <div v-else class="grid grid-cols-1 lg:grid-cols-3 gap-4 mb-4">
            <Invoice :invoice="i" v-for="i in invoices.data" :key="i.invoice_number" />
        </div>

        <ThePaginator :links="invoices.meta.links" />

    </ClientareaLayout>
</template>

<script setup>
import ClientareaLayout from '@/Layouts/ClientareaLayout.vue';
import InputForm from '@/Components/Form/InputForm.vue';
import { reactive, watch } from 'vue';
import ThePaginator from '@/Components/ThePaginator.vue';
import Invoice from '@/Components/Invoice.vue';
import StatCard from '@/Components/StatCard.vue';
import { IconCurrencyDollar } from '@tabler/icons-vue';
import { router } from "@inertiajs/vue3";
import { Switch, SwitchGroup, SwitchLabel } from '@headlessui/vue'

const props = defineProps({
    invoices: {
        type: Object,
        required: true,
    },
    total: {
        type: String,
        required: true,
    },
});

const searchParams = new URLSearchParams(window.location.search);

const queryParams = reactive({
    date: searchParams.get('date') ?? '',
    trashed: searchParams.get('trashed') === 'true',
});

watch(() => queryParams, () => {
    let params = { ...route().params, ...queryParams };

    for (const key in params) {
        if (!params[key]) delete params[key];
    }

    router.get(route('clientarea.invoices.index'), params, {
        preserveState: true,
        preserveScroll: true,
        only: ['invoices', 'total'],
        replace: true,
    });
}, { deep: true });

</script>
