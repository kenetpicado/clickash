<template>
    <AppLayout title="Raffles" :breads="breads">

        <template #header>
            <span class="title">
                Raffles
            </span>
            <AddButton @click="openModal = true" />
        </template>

        <TableSection>
            <template #header>
                <th>ID</th>
                <th>Nombre</th>
                <th>Settings</th>
                <th>Accciones</th>
            </template>

            <template #body>
                <tr v-for="(raffle, index) in raffles" class="hover:bg-gray-50">
                    <td>
                        {{ raffle.id }}
                    </td>
                    <td>
                        {{ raffle.name }}
                    </td>
                    <td>
                        <pre>{{ raffle.settings }}</pre>
                    </td>
                    <td>
                        <div class="flex gap-2 text-gray-400">
                            <IconPencil role="button" @click="edit(raffle)" />
                        </div>
                    </td>
                </tr>
                <tr v-if="raffles.length == 0">
                    <td colspan="3" class="text-center">No data to display</td>
                </tr>
            </template>
        </TableSection>

        <FormModal :show="openModal" title="Add" @onCancel="resetValues" @onSubmit="onSubmit">
            <InputForm text="Name" v-model="form.name" />
            <InputForm text="Image" v-model="form.image" type="url" />
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
import TableSection from '@/Components/TableSection.vue';
import { useRaffle } from '@/Composables/useRaffle.js';
import AppLayout from '@/Layouts/AppLayout.vue';
import { IconPencil } from '@tabler/icons-vue';
import { ref, watch } from 'vue';
import { toast } from "@/Use/toast";

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
        name: 'Raffles',
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