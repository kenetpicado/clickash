<template>
    <AppLayout title="Rifas" :breads="breads">
        <template #header>
            <span class="title">
                Rifas
            </span>
        </template>

        <TableSection>
            <template #header>
                <th>Nombre</th>
                <th>Detalles</th>
                <th>Acciones</th>
            </template>
            <template #body>
                <tr v-for="raffle in raffles">
                    <td>
                        <div class="font-semibold mb-1">
                            {{ raffle.raffle.name }}
                        </div>
                    </td>
                    <td>
                        <div v-if="raffle.settings.super_x" class="badge-blue m-1">
                            Super X
                        </div>
                        <div v-if="raffle.settings.date" class="badge-blue m-1">
                            Fecha
                        </div>
                        <div v-else class="badge-green whitespace-nowrap text-xs m-1">
                            Desde {{ raffle.settings.min }} hasta {{ raffle.settings.max }}
                        </div>
                        <div v-if="raffle.settings.individual_limit" class="badge-blue whitespace-nowrap text-xs m-1">
                            Limite individual: C${{ raffle.settings.individual_limit }}
                        </div>
                        <div v-if="raffle.settings.general_limit" class="badge-blue whitespace-nowrap text-x m-1">
                            Limite general: C${{ raffle.settings.general_limit }}
                        </div>
                    </td>
                    <td>
                        <div class="flex items-center gap-3">
                            <Link :href="route('clientarea.raffles.show', raffle.raffle_id)" tooltip="Detalles">
                            <IconEye size="22"/>
                            </Link>
                            <span tooltip="Editar" role="button" @click="edit(raffle)">
                                <IconEdit size="22"/>
                            </span>
                        </div>
                    </td>
                </tr>
                <tr v-if="raffles.length == 0">
                    <td colspan="2" class="text-center">No hay datos</td>
                </tr>
            </template>
        </TableSection>

        <FormModal :show="openModal" title="Rifa" @onCancel="resetValues" @onSubmit="onSubmit">
            <Checkbox v-model:checked="form.settings.super_x" text="Super X" />
            <Checkbox v-model:checked="form.settings.date" text="Fecha" />

            <div class="grid grid-cols-2 gap-4" v-if="!form.settings.date">
                <InputForm text="Minimo" v-model="form.settings.min" />
                <InputForm text="Maximo" v-model="form.settings.max" />
            </div>

            <div class="grid grid-cols-2 gap-4">
                <InputForm text="Limite general" v-model="form.settings.general_limit" />
                <InputForm text="Limite individual " v-model="form.settings.individual_limit" />
            </div>
        </FormModal>

    </AppLayout>
</template>

<script setup>
import InputForm from '@/Components/Form/InputForm.vue';
import FormModal from '@/Components/Modal/FormModal.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { ref, watch } from 'vue';
import TableSection from '@/Components/TableSection.vue';
import { IconEye } from '@tabler/icons-vue';
import { Link, useForm } from '@inertiajs/vue3';
import { IconEdit } from '@tabler/icons-vue';
import Checkbox from '@/Components/Form/Checkbox.vue';
import { toast } from '@/Use/toast';

defineProps({
    raffles: {
        type: Object,
        required: true,
    },
});

const form = useForm({
    raffle_id: null,
    settings: {
        super_x: true,
        date: false,
        min: null,
        max: null,
        general_limit: null,
        individual_limit: null,
    },
});

watch(() => form.settings.date, (value) => {
    if (value) {
        form.settings.min = null;
        form.settings.max = null;
    }
});

const breads = [
    {
        name: 'Inicio',
        route: route('clientarea.index'),
    },
    {
        name: 'Rifas',
        route: route('clientarea.raffles.index'),
    },
];

const openModal = ref(false);

function onSubmit() {
    if (!form.settings.date) {
        if (form.settings.min == null) {
            toast.error('Minimo es requerido');
            return;
        }

        if (form.settings.max == null) {
            toast.error('Maximo es requerido');
            return;
        }

        if (isNaN(form.settings.min)) {
            toast.error('Minimo debe ser un numero valido');
            return;
        }

        if (isNaN(form.settings.max)) {
            toast.error('Maximo debe ser un numero valido');
            return;
        }
    }

    if (isNaN(form.settings.general_limit)) {
        toast.error('Limite general debe ser un numero valido');
        return;
    }

    if (isNaN(form.settings.individual_limit)) {
        toast.error('Limite individual debe ser un numero valido');
        return;
    }

    form.put(route('clientarea.raffles.update', form.raffle_id), {
        preserveScroll: true,
        onSuccess: () => {
            resetValues();
            toast.success('Rifa actualizada');
        },
    });
}

const resetValues = () => {
    form.reset();
    openModal.value = false;
};

function edit(raffle) {
    form.raffle_id = raffle.raffle_id;
    Object.assign(form.settings, raffle.settings);
    openModal.value = true;
}

</script>