<template>
    <ClientareaLayout title="Balance">
        <template #header>
            <span class="title">
                Balance
            </span>
        </template>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-4 text-gray-600">
            <InputForm v-model="queryParams.date" text="Fecha" type="date"/>
        </div>

        <h2 class="mb-4" v-if="!queryParams.date">Balance de la SEMANA en curso</h2>
        <h2 class="mb-4" v-else>Balance del DIA {{  Carbon.create(queryParams.date).format('d/m/Y') }}</h2>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-4 mb-4">
            <StatCard v-for="stat in stats" :stat="stat" :key="stat.title" />
        </div>

    </ClientareaLayout>
</template>

<script setup>
import InputForm from '@/Components/Form/InputForm.vue';
import StatCard from '@/Components/StatCard.vue';
import ClientareaLayout from '@/Layouts/ClientareaLayout.vue';
import { Carbon } from '@/Use/Carbon';
import { router } from '@inertiajs/vue3';
import { IconCurrencyDollar } from '@tabler/icons-vue';
import { watch, reactive, computed } from 'vue';

const props = defineProps({
    balance: {
        type: Object,
        required: true,
    },
    seller: {
        type: Object,
        required: true,
    }
})

const queryParams = reactive({
    date: ''
})

const searchParams = new URLSearchParams(window.location.search);

if (searchParams.get("date")) {
    queryParams.date = searchParams.get("date");
}

watch(() => [queryParams.date], ([date]) => {

    if (!date)
        delete queryParams.date

    router.get(route('clientarea.sellers.balance', props.seller.id), queryParams, {
        preserveState: true,
        preserveScroll: true,
        only: ['balance'],
    });
});

const stats = computed(() => {
    return [
        {
            title: 'Ingresos',
            value: "C$" + props.balance.income.toLocaleString(),
            icon: IconCurrencyDollar,
        },
        {
            title: 'Egresos',
            value: "C$" + props.balance.expenditure.toLocaleString(),
            icon: IconCurrencyDollar,
        },
        {
            title: 'Balance',
            value: "C$" + (props.balance.income - props.balance.expenditure).toLocaleString(),
            icon: IconCurrencyDollar,
        },
    ]
})

</script>