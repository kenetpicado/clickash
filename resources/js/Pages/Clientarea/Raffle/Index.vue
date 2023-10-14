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
                <th>Multiplicador</th>
                <th>Rango</th>
                <th>Limite Individual</th>
                <th>Limite General</th>
                <th>Super X</th>
                <th>Acciones</th>
            </template>
            <template #body>
                <tr v-for="raffle in raffles">
                    <td>
                        {{ raffle.raffle.name }}
                    </td>
                    <td>
                        <span class="badge-primary"> C${{ raffle.settings.multiplier }}</span>
                    </td>
                    <td>
                        <div v-if="raffle.settings.date">
                            Fecha
                        </div>
                        <div v-else>
                            {{ raffle.settings.min }} - {{ raffle.settings.max }}
                        </div>
                    </td>
                    <td>
                        <div v-if="raffle.settings.individual_limit" class="badge-primary">
                            C${{ raffle.settings.individual_limit }}
                        </div>
                        <div v-else class="text-xs text-gray-400">
                            Ninguno
                        </div>
                    </td>
                    <td>
                        <div v-if="raffle.settings.general_limit" class="badge-primary">
                            C${{ raffle.settings.general_limit }}
                        </div>
                        <div v-else class="text-xs text-gray-400">
                            Ninguno
                        </div>
                    </td>
                    <td>
                        <div v-if="raffle.settings.super_x" class="badge-primary">
                            Super X
                        </div>
                    </td>
                    <td>
                        <div class="flex items-center gap-3">
                            <Link :href="route('clientarea.raffles.show', raffle.raffle_id)" tooltip="Detalles">
                            <IconEye size="22" />
                            </Link>
                            <span tooltip="Editar" role="button" @click="edit(raffle)">
                                <IconEdit size="22" />
                            </span>
                        </div>
                    </td>
                </tr>
                <tr v-if="raffles.length == 0">
                    <td colspan="2" class="text-center">No hay datos</td>
                </tr>
            </template>
        </TableSection>

        <FormModal :show="openModal" :title="form.raffle_name" @onCancel="resetValues" @onSubmit="onSubmit">
            <Checkbox v-model:checked="form.settings.super_x" text="Super X" />
            <Checkbox v-model:checked="form.settings.date" text="Fecha" />

            <div class="grid grid-cols-2 gap-4" v-if="!form.settings.date">
                <InputForm text="Minimo" v-model="form.settings.min" required type="number" />
                <InputForm text="Maximo" v-model="form.settings.max" required type="number" />
            </div>

            <div class="grid grid-cols-2 gap-4">
                <InputForm text="Limite general" v-model="form.settings.general_limit" type="number" />
                <InputForm text="Limite individual" v-model="form.settings.individual_limit" type="number" />
            </div>

            <InputForm text="Multiplicador" v-model="form.settings.multiplier" type="number" required />
        </FormModal>

    </AppLayout>
</template>

<script setup>
import Checkbox from '@/Components/Form/Checkbox.vue';
import InputForm from '@/Components/Form/InputForm.vue';
import FormModal from '@/Components/Modal/FormModal.vue';
import TableSection from '@/Components/TableSection.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { toast } from '@/Use/toast';
import { Link, useForm } from '@inertiajs/vue3';
import { IconEdit, IconEye } from '@tabler/icons-vue';
import { ref, watch } from 'vue';

defineProps({
    raffles: {
        type: Object,
        required: true,
    },
});

const form = useForm({
    raffle_name: null,
    raffle_id: null,
    settings: {
        super_x: true,
        date: false,
        min: null,
        max: null,
        general_limit: null,
        individual_limit: null,
        multiplier: 70
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
    form.raffle_name = raffle.raffle.name;
    form.raffle_id = raffle.raffle_id;
    Object.assign(form.settings, raffle.settings);
    openModal.value = true;
}

</script>