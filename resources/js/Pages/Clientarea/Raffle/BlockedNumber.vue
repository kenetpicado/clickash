<template>
    <ClientareaLayout title="Bloqueados">
        <template #header>
            <span class="title">
                {{ raffle.name }}: Bloqueados
            </span>
            <button type="button" class="simple-button" @click="openModal = true">
                Nuevo
            </button>
        </template>
        <div v-if="blockeds.length == 0" class="w-full text-center text-gray-400">
            No hay dígitos bloqueados 😥️
        </div>
        <div v-else class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
            <BlockedNumber v-for="i in blockeds" :digit="i" :key="i.id" @destroy="destroy" />
        </div>

        <FormModal :show="openModal" title="Bloquear" @onCancel="resetValues" @onSubmit="onSubmit">
            <InputForm text="Dígito" v-model="form.number" type="number" required />
            <div class="grid grid-cols-2 gap-2">
                <InputForm text="Limite individual" v-model="form.settings.individual_limit" type="number" />
                <InputForm text="Limite general" v-model="form.settings.general_limit" type="number" />
            </div>
            <p class="text-primary">
                <small>
                    Nota: Recuerde ingresar el dígito con los ceros necesarios según la numeración de la rifa, por ejemplo, 01, 001, etc. De lo contrario, el bloqueo no se realizará correctamente. En cuanto a las fechas, utilice el formato dd/mm.
                </small>
            </p>
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
import { defineProps, ref } from 'vue';
import BlockedNumber from '@/Components/BlockedNumber.vue';

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
    form.post(route('clientarea.raffles.blocked-numbers.store', props.raffle.id), {
        preserveScroll: true,
        preserveState: true,
        onSuccess: () => {
            resetValues();
            toast.success('Agregado correctamente');
        },
        onError: (e) => {
            toast.error(e.message);
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