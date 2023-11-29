<template>
    <ClientareaLayout title="Balance">
        <template #header>
            <span class="title">
                Balance: {{ seller.name }}
            </span>
        </template>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-4 text-gray-600">
            <InputForm v-model="queryParams.date" text="Fecha" type="date" />
        </div>

        <h2 class="mb-4" v-if="!queryParams.date">Balance de la SEMANA en curso</h2>
        <h2 class="mb-4" v-else>Balance del DIA {{ Carbon.create(queryParams.date).format('d/m/Y') }}</h2>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-4 mb-8">
            <StatCard v-for="stat in stats" :stat="stat" :key="stat.title" />
        </div>

        <div class="flex items-center justify-between mb-4 text-gray-600">
            <span class="title">
                Movimientos
            </span>
            <button @click="openModal = true" type="button" class="simple-button">
                Nuevo
            </button>
        </div>

        <div v-if="archings.data.length == 0" class="text-center text-gray-400 mb-4">
            No hay movimientos
        </div>

        <div v-else class="grid grid-cols-1 lg:grid-cols-4 gap-4 mb-4">
            <div class="bg-card p-3 rounded-xl" v-for="i in archings.data">
                <div class="flex items-center justify-between">
                    <div class="text-gray-400 text-sm mb-2">
                        {{ Carbon.create(i.created_at).format('d/m/Y H:i') }}
                    </div>
                    <Dropdown>
                        <DropdownItem @click="destroy(i.id)" title="Eliminar" :icon="IconTrash"/>
                    </Dropdown>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-600 font-bold">
                        {{ i.type }}
                    </span>
                    <span class="text-xl text-gray-600 font-bold">
                        C${{ i.amount }}
                    </span>
                </div>
            </div>
        </div>

        <FormModal :show="openModal" title="Movimiento" @onCancel="resetValues" @onSubmit="onSubmit">
            <SelectForm v-model="form.type" text="Tipo" required>
                <option value="RETIRO">RETIRO</option>
                <option value="DEPOSITO">DEPOSITO</option>
            </SelectForm>
            <InputForm v-model="form.amount" type="number" text="Cantidad" required />

        </FormModal>

    </ClientareaLayout>
</template>

<script setup>
import Dropdown from '@/Components/Dropdown.vue';
import DropdownItem from '@/Components/DropdownItem.vue';
import InputForm from '@/Components/Form/InputForm.vue';
import SelectForm from '@/Components/Form/SelectForm.vue';
import FormModal from '@/Components/Modal/FormModal.vue';
import StatCard from '@/Components/StatCard.vue';
import ClientareaLayout from '@/Layouts/ClientareaLayout.vue';
import { Carbon } from '@/Use/Carbon';
import { confirmAlert } from '@/Use/helpers';
import { toast } from '@/Use/toast';
import { router, useForm } from '@inertiajs/vue3';
import { IconCurrencyDollar, IconTrash } from '@tabler/icons-vue';
import { watch, reactive, computed, ref } from 'vue';

const props = defineProps({
    balance: {
        type: Object,
        required: true,
    },
    seller: {
        type: Object,
        required: true,
    },
    archings: {
        type: Object,
        required: true,
    },
})

const queryParams = reactive({
    date: ''
})

const openModal = ref(false);

const form = useForm({
    id: null,
    type: 'RETIRO',
    amount: null,
});

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
        only: ['balance', 'archings'],
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

function resetValues() {
    form.reset();
    openModal.value = false;
}

function onSubmit() {
    form.post(route('clientarea.sellers.archings.store', props.seller.id), {
        preserveScroll: true,
        preserveState: true,
        onSuccess: () => {
            resetValues();
            toast.success('Movimiento agregado');
        },
    });
}

function destroy(id) {
    confirmAlert({
        message: "¿Está seguro de eliminar este registro?",
        onConfirm: () => {
            router.delete(route("clientarea.sellers.archings.destroy", [props.seller.id, id]), {
                preserveScroll: true,
                preserveState: true,
                onSuccess: () => {
                    toast.success("Eliminado correctamente");
                },
            });
        },
    });
}

</script>