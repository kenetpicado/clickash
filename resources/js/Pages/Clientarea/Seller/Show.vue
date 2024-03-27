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

        <div v-if="invoices.data?.length == 0" class="w-full text-center text-gray-400">
            No hay transacciones
        </div>
        <div v-else class="grid grid-cols-1 lg:grid-cols-3 gap-4 mb-4">
            <Invoice :invoice="i" v-for="i in invoices.data" :key="i.invoice_number" />
        </div>

        <ThePaginator :links="invoices.meta?.links" />
    </ClientareaLayout>
</template>

<script setup>
import StatCard from '@/Components/StatCard.vue';
import ThePaginator from '@/Components/ThePaginator.vue';
import ClientareaLayout from '@/Layouts/ClientareaLayout.vue';
import Invoice from '@/Components/Invoice.vue';
import { IconCurrencyDollar } from '@tabler/icons-vue';
import { computed, reactive, watch } from 'vue';
import InputForm from '@/Components/Form/InputForm.vue';
import { Switch, SwitchGroup, SwitchLabel } from '@headlessui/vue'
import { useInvoice } from '@/Composables/useInvoice.js';
import { onMounted } from 'vue';

const props = defineProps({
    seller: {
        type: Object,
        required: true,
    },
});

const stats = computed(() => {
    return [
        {
            title: 'Total',
            value: invoices.value?.total?.toLocaleString(),
            icon: IconCurrencyDollar,
        },
    ]
})

const { invoices, getInvoices } = useInvoice();

const queryParams = reactive({
    date: '',
    trashed: false,
});

watch(() => queryParams, onGetInvoices, { deep: true });

onMounted(() => {
    onGetInvoices();
})

function onGetInvoices() {
    let params = { ...queryParams };

    for (const key in params) {
        if (!params[key]) delete params[key];
    }

    getInvoices({ user_id: props.seller.id, ...params });
}

</script>
