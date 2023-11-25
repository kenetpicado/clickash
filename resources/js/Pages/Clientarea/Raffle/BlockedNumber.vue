<template>
    <ClientareaLayout title="Bloqueados">
        <template #header>
            <span class="title">
                Bloqueados
            </span>
            <button type="button" class="simple-button" @click="openModal = true">
                Nuevo
            </button>
        </template>
        <div v-if="blockeds.length == 0" class="w-full text-center text-gray-400">
            No hay números bloqueados
        </div>
        <div v-else class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-4">
            <div v-for="i in blockeds" class="bg-card p-3 rounded-xl text-gray-600">
                <div class="flex justify-between items-center mb-2">
                    <span class="text-xl font-bold">{{ i.number }}</span>
                    <IconTrash class="text-primary" @click="destroy(i.id)" />
                </div>
                <div class="grid grid-cols-2 gap-2">
                    <div v-if="i.settings.general_limit">
                        <strong class="text-sm">Limite general C$</strong>
                        <div>
                            C${{ i.settings.general_limit }}
                        </div>
                    </div>
                    <div v-if="i.settings.individual_limit">
                        <strong class="text-sm">Limite indiv. C$</strong>
                        <div>
                            C${{ i.settings.individual_limit }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <FormModal :show="openModal" title="Bloquear" @onCancel="resetValues" @onSubmit="onSubmit">
            <InputForm text="Numero" v-model="form.number" type="number" required />
            <div class="grid grid-cols-2 gap-2">
                <InputForm text="Limite individual" v-model="form.settings.individual_limit" type="number" />
                <InputForm text="Limite general" v-model="form.settings.general_limit" type="number" />
            </div>
        </FormModal>
    </ClientareaLayout>
</template>

<script setup>
import InputForm from '@/Components/Form/InputForm.vue';
import FormModal from '@/Components/Modal/FormModal.vue';
import ClientareaLayout from '@/Layouts/ClientareaLayout.vue';
import { confirmAlert } from '@/Use/helpers';
import { toast } from '@/Use/toast';
import { router, useForm } from '@inertiajs/vue3';
import { IconTrash } from '@tabler/icons-vue';
import { defineProps, ref } from 'vue';

const props = defineProps({
    blockeds: {
        type: Object,
        required: true,
    },
    raffle: {
        type: Object,
        required: true,
    },
})

const form = useForm({
    number: null,
    settings: {
        general_limit: null,
        individual_limit: null,
    }
});

const openModal = ref(false)

const onSubmit = () => {
    if (!form.settings.general_limit && !form.settings.individual_limit) {
        toast.error('Debe ingresar al menos un limite');
        return;
    }

    if (props.blockeds.find((item) => item.number == form.number)) {
        toast.error('Numero ya bloqueado');
        return;
    }

    form.post(route('clientarea.raffles.blocked-numbers.store', props.raffle.id), {
        preserveScroll: true,
        preserveState: true,
        onSuccess: () => {
            resetValues();
            toast.success('Agregado correctamente');
        }
    });
}

const resetValues = () => {
    form.reset();
    openModal.value = false
};

const destroy = (id) => {
    confirmAlert({
        message: "¿Está seguro de eliminar este registro?",
        onConfirm: () => {
            router.delete(route("clientarea.raffles.blocked-numbers.destroy", [props.raffle.id, id]), {
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