<template>
    <AppLayout title="Vendedores" :breads="breads">
        <template #header>
            <span class="title">
                Vendedores
            </span>
            <AddButton @click="openModal = true" />
        </template>

        <TableSection>
            <template #header>
                <th>Nombre</th>
                <th>Actividad</th>
                <th>Estado</th>
                <th>Acciones</th>
            </template>
            <template #body>
                <tr v-for="seller in sellers">
                    <td>
                        {{ seller.name }}
                        <div class="text-gray-400">
                            {{ seller.email }}
                        </div>
                    </td>
                    <td>
                        <span class="whitespace-nowrap">{{ seller.online }}</span>
                    </td>
                    <td>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" class="sr-only peer" :checked="seller.status == 'enabled'"
                                @change="toggle(seller.id)">
                            <div
                                class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:indigo-4 peer-focus:indigo-indigo-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-primary">
                            </div>
                        </label>
                    </td>
                    <td>
                        <div class="flex items-center gap-3">
                            <Link :href="route('clientarea.sellers.show', seller.id)" tooltip="Ventas">
                            <IconCurrencyDollar size="22"/>
                            </Link>
                            <span tooltip="Editar" role="button" @click="edit(seller)">
                                <IconEdit size="22"/>
                            </span>
                            <span tooltip="Eliminar" role="button" @click="destroy(seller.id)">
                                <IconTrash size="22"/>
                            </span>
                        </div>
                    </td>
                </tr>
                <tr v-if="sellers.length == 0">
                    <td colspan="4" class="text-center">No hay datos</td>
                </tr>
            </template>
        </TableSection>

        <FormModal :show="openModal" title="Vendedor" @onCancel="resetValues" @onSubmit="onSubmit">
            <InputForm text="Nombre" v-model="form.name" required />
            <InputForm text="Correo" v-model="form.email" type="email" required />
            <template v-if="isNew">
                <InputForm text="Contraseña" v-model="form.password" type="password" required />
                <InputForm text="Confirmar contraseña" v-model="form.password_confirmation" type="password" required />
            </template>
        </FormModal>

    </AppLayout>
</template>

<script setup>
import AddButton from '@/Components/Buttons/AddButton.vue';
import InputForm from '@/Components/Form/InputForm.vue';
import FormModal from '@/Components/Modal/FormModal.vue';
import { useSeller } from '@/Composables/useSeller.js';
import AppLayout from '@/Layouts/AppLayout.vue';
import { ref } from 'vue';
import TableSection from '@/Components/TableSection.vue';
import { IconEye } from '@tabler/icons-vue';
import { Link } from '@inertiajs/vue3';
import { IconEdit, IconTrash, IconEyeDollar, IconCurrencyDollar } from '@tabler/icons-vue';

defineProps({
    sellers: {
        type: Object,
        required: true,
    },
});

const { store, update, form, toggleStatus, destroy } = useSeller();
const isNew = ref(true);

const breads = [
    {
        name: 'Inicio',
        route: route('clientarea.index'),
    },
    {
        name: 'Vendedores',
        route: route('clientarea.sellers.index'),
    },
];

const openModal = ref(false);

function onSubmit() {
    if (isNew.value) {
        store(resetValues);
    } else {
        update(resetValues);
    }
}

const resetValues = () => {
    form.reset();
    openModal.value = false;
    isNew.value = true;
};

function edit(seller) {
    isNew.value = false;
    Object.assign(form, seller);
    openModal.value = true;
}

function toggle(id) {
    form.id = id;
    toggleStatus()
}

</script>