<template>
    <ClientareaLayout title="Caja">
        <template #header>
            <span class="title">
                {{ seller.name }}: {{ week_resume?.data?.week_label }}
            </span>
        </template>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 text-gray-600 mb-6">
            <WeekResume :week="week_resume.data" />
        </div>

        <div class="flex items-center justify-between mb-4 text-gray-600">
            <span class="title">
                Movimientos
            </span>
            <button @click="openModal = true" type="button" class="primary-button">
                Nuevo
            </button>
        </div>

        <div v-if="movements.data.length == 0" class="text-center text-gray-400 mb-4">
            No hay movimientos
        </div>

        <div v-else class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
            <div class="bg-gray-100 p-3 rounded-lg" v-for="i in movements.data">
                <div class="flex items-center justify-between">
                    <div class="text-gray-400 text-sm mb-2">
                        {{ i.created_at }}
                    </div>
                    <Dropdown>
                        <div class="px-1 py-1">
                            <DropdownItem @click="destroy(i.id)" title="Eliminar" :icon="IconTrash" />
                        </div>
                    </Dropdown>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-600 font-bold">
                        {{ i.type }}
                    </span>
                    <span class="text-xl text-gray-600 font-bold">
                        {{ i.amount }}
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
import ClientareaLayout from '@/Layouts/ClientareaLayout.vue';
import { confirmAlert } from '@/Use/helpers';
import { toast } from '@/Use/toast';
import { router, useForm } from '@inertiajs/vue3';
import { IconTrash } from '@tabler/icons-vue';
import { ref } from 'vue';
import WeekResume from '@/Components/WeekResume.vue';

const props = defineProps({
    movements: {
        type: Object,
        required: true,
    },
    seller: {
        type: Object,
        required: true,
    },
    week: {
        type: String,
        required: true,
    },
    week_resume: {
        type: Object,
        required: true,
    }
})

const openModal = ref(false);

const form = useForm({
    id: null,
    type: 'RETIRO',
    week: props.week,
    amount: null,
});

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
        onError: (err) => {
            console.log(err)
        }
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
