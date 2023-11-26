<template>
    <AppLayout title="Rifa" :breads="breads">

        <template #header>
            <span class="title">
                Rifa
            </span>
            <AddButton @click="openModal = true" />
        </template>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-4">
            <div v-for="raffle in raffles" class="bg-card rounded-xl p-2 w-full">
                <div class="flex justify-between">
                    <span class="mb-2">{{ raffle.name }}</span>

                    <Dropdown>
                        <div class="px-1 py-1">
                            <DropdownItem @click="setToClone(raffle)" title="Clonar" :icon="IconCopy" />
                            <DropdownItem @click="edit(raffle)" title="Editar" :icon="IconEdit" />
                        </div>
                    </Dropdown>
                </div>

                <div class="text-xs text-gray-600">
                    <pre class="bg-white w-full p-3">{{ raffle.settings }}</pre>
                </div>
            </div>
        </div>

        <FormModal :show="openModal" title="Rifa" @onCancel="resetValues" @onSubmit="onSubmit">
            <InputForm text="Nombre" v-model="form.name" />

            <div class="grid grid-cols-2 gap-4">
                <InputForm text="Limite general C$" v-model="form.settings.general_limit" type="number" />
                <InputForm text="Limite indiv. C$" v-model="form.settings.individual_limit" type="number" />
            </div>

            <div class="grid grid-cols-2 gap-4 mb-1">
                <Checkbox v-model:checked="form.settings.super_x" text="Super X" />
                <Checkbox v-model:checked="form.settings.date" text="Fecha" />
            </div>

            <div class="grid grid-cols-2 gap-4" v-if="!form.settings.date">
                <InputForm text="Número inicio" v-model="form.settings.min" required type="number" />
                <InputForm text="Número final" v-model="form.settings.max" required type="number" />
            </div>

            <InputForm text="Multiplicador" v-model="form.settings.multiplier" type="number" required />
        </FormModal>

        <FormModal :show="openModalClone" title="Clonar" @onCancel="resetValues" @onSubmit="onClone">
            <InputForm text="Nuevo nombre" v-model="form.name" required="" />
        </FormModal>

    </AppLayout>
</template>

<script setup>
import AddButton from '@/Components/Buttons/AddButton.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownItem from '@/Components/DropdownItem.vue';
import Checkbox from '@/Components/Form/Checkbox.vue';
import InputForm from '@/Components/Form/InputForm.vue';
import FormModal from '@/Components/Modal/FormModal.vue';
import { useRaffle } from '@/Composables/useRaffle.js';
import AppLayout from '@/Layouts/AppLayout.vue';
import { toast } from "@/Use/toast";
import { IconCopy } from '@tabler/icons-vue';
import { IconEdit } from '@tabler/icons-vue';
import { ref, watch } from 'vue';

defineProps({
    raffles: {
        type: Object,
        required: true,
    }
});

const breads = [
    {
        name: 'Home',
        route: route('dashboard.raffles.index'),
    },
    {
        name: 'Rifas',
        route: route('dashboard.raffles.index'),
    },
];

const openModal = ref(false);
const openModalClone = ref(false);
const isNew = ref(true);
const { store, update, form, clone } = useRaffle();

function edit(raffle) {
    Object.assign(form, raffle);
    openModal.value = true;
    isNew.value = false;
}

watch(() => form.settings.date, (value) => {
    if (value) {
        form.settings.min = null;
        form.settings.max = null;
    }
});

function onSubmit() {
    if (isNaN(form.settings.min)) {
        toast.error('Min must be a number');
        return;
    }

    if (isNaN(form.settings.max)) {
        toast.error('Max must be a number');
        return;
    }

    if (isNaN(form.settings.general_limit)) {
        toast.error('General Limit must be a number');
        return;
    }

    if (isNaN(form.settings.individual_limit)) {
        toast.error('Individual Limit must be a number');
        return;
    }

    if (isNew.value) {
        store(resetValues)
    } else {
        update(resetValues)
    }
}

const resetValues = () => {
    form.reset();
    openModal.value = false;
    openModalClone.value = false;
    isNew.value = true;
};

function setToClone(raffle) {
    form.id = raffle.id;
    form.name = raffle.name + ' (Copia)';
    openModalClone.value = true;
}

function onClone() {
    clone(resetValues);
}

</script>