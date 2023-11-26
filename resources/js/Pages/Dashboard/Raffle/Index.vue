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
            <InputForm text="Name" v-model="form.name" />
            <Checkbox v-model:checked="form.settings.super_x" text="Super X" />
            <Checkbox v-model:checked="form.settings.date" text="Date" />

            <div class="grid grid-cols-2 gap-4" v-if="!form.settings.date">
                <InputForm text="Min" v-model="form.settings.min" />
                <InputForm text="Max" v-model="form.settings.max" />
            </div>

            <div class="grid grid-cols-2 gap-4">
                <InputForm text="General Limit" v-model="form.settings.general_limit" />
                <InputForm text="Individual Limit" v-model="form.settings.individual_limit" />
            </div>

        </FormModal>

    </AppLayout>
</template>

<script setup>
import AddButton from '@/Components/Buttons/AddButton.vue';
import Checkbox from '@/Components/Form/Checkbox.vue';
import InputForm from '@/Components/Form/InputForm.vue';
import FormModal from '@/Components/Modal/FormModal.vue';
import { useRaffle } from '@/Composables/useRaffle.js';
import AppLayout from '@/Layouts/AppLayout.vue';
import { toast } from "@/Use/toast";
import { Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue';
import { IconList, IconSettings } from '@tabler/icons-vue';
import { ref, watch } from 'vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownItem from '@/Components/DropdownItem.vue';
import { IconEdit } from '@tabler/icons-vue';

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
const isNew = ref(true);
const { store, update, form } = useRaffle();

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
    isNew.value = true;
};

</script>