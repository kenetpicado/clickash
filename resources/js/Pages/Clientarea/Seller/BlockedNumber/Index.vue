<template>
    <ClientareaLayout title="Bloqueados">
        <template #header>
            <span class="title">
                {{ seller.name }}: Bloqueados
            </span>
            <button v-if="queryParams.raffle_id" type="button" class="simple-button" @click="openModal = true">
                Nuevo
            </button>
        </template>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-4 text-gray-600">
            <SelectForm v-model="queryParams.raffle_id" text="Rifa" required>
                <option value="" selected>Seleccione una rifa</option>
                <option v-for="r in raffles" :value="r.id">{{ r.name }}</option>
            </SelectForm>
        </div>

        <div v-if="!queryParams.raffle_id" class="w-full text-center text-gray-400">
            Por favor seleccione una rifa
        </div>
        <div v-else-if="blockeds.length == 0" class="w-full text-center text-gray-400">
            No hay dígitos bloqueados 😥️
        </div>
        <div v-else class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
            <BlockedNumber v-for="i in blockeds" :digit="i" :key="i.id" @destroy="destroy" />
        </div>

        <FormModal :show="openModal" :title="raffles.find((i) => queryParams.raffle_id == i.id)?.name"
            @onCancel="resetValues" @onSubmit="onSubmit">
            <InputForm text="Dígito" v-model="form.number" type="number" required />
            <div class="grid grid-cols-2 gap-2">
                <InputForm text="Limite individual" v-model="form.settings.individual_limit" type="number" />
                <InputForm text="Limite general" v-model="form.settings.general_limit" type="number" />
            </div>
            <p class="text-primary">
                <small>
                    Nota: Recuerde ingresar el dígito con los ceros necesarios según la numeración de la rifa, por ejemplo,
                    01, 001, etc. De lo contrario, el bloqueo no se realizará correctamente. En cuanto a las fechas, utilice
                    el formato dd/mm.
                </small>
            </p>
        </FormModal>
    </ClientareaLayout>
</template>

<script setup>
import BlockedNumber from '@/Components/BlockedNumber.vue';
import InputForm from '@/Components/Form/InputForm.vue';
import SelectForm from '@/Components/Form/SelectForm.vue';
import FormModal from '@/Components/Modal/FormModal.vue';
import ClientareaLayout from '@/Layouts/ClientareaLayout.vue';
import { confirmAlert } from '@/Use/helpers';
import { toast } from '@/Use/toast';
import { router, useForm } from '@inertiajs/vue3';
import { defineProps, ref, reactive, watch } from 'vue';

const props = defineProps({
    blockeds: {
        type: Object,
        required: true,
    },
    seller: {
        type: Object,
        required: true,
    },
    raffles: {
        type: Object,
        required: true,
    },
})

const form = useForm({
    number: null,
    raffle_id: null,
    settings: {
        general_limit: null,
        individual_limit: null,
    }
});

const openModal = ref(false)

const searchParams = new URLSearchParams(window.location.search);

const queryParams = reactive({
    raffle_id: searchParams.get('raffle_id') || null,
})

const onSubmit = () => {
    if (!form.settings.general_limit && !form.settings.individual_limit) {
        toast.error('Debe ingresar al menos un limite');
        return;
    }

    if (props.blockeds.find((item) => item.number == form.number)) {
        toast.error('Digito ya bloqueado');
        return;
    }

    form.raffle_id = queryParams.raffle_id;

    form.post(route('clientarea.sellers.blocked-numbers.store', props.seller.id), {
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

watch(() => queryParams, () => {
    let params = { ...queryParams };

    for (const key in params) {
        if (!params[key]) delete params[key];
    }

    router.get(route('clientarea.sellers.blocked-numbers.index', props.seller.id), params, {
        preserveState: true,
        only: ['blockeds'],
        replace: true,
    });
}, { deep: true });

const destroy = (id) => {
    confirmAlert({
        message: "¿Está seguro de eliminar este registro?",
        onConfirm: () => {
            router.delete(route("clientarea.sellers.blocked-numbers.destroy", [props.seller.id, id]), {
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