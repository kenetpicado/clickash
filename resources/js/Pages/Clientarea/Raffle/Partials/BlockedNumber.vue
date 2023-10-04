<template>
    <div>
        <TableSection>
            <template #header>
                <th>Numero</th>
                <th>Limite individual</th>
                <th>Limite general</th>
                <th>Acciones</th>
            </template>
            <template #body>
                <tr v-for="number in blockeds">
                    <td class="font-semibold">
                        {{ number.number }}
                    </td>
                    <td>
                        <span v-if="number.settings.individual_limit" class="badge-red">
                            C${{ number.settings.individual_limit }}
                        </span>
                        <span v-else>
                            Ninguno
                        </span>
                    </td>
                    <td>
                        <span v-if="number.settings.general_limit" class="badge-red">
                            C${{ number.settings.general_limit }}
                        </span>
                        <span v-else>
                            Ninguno
                        </span>
                    </td>
                    <td>
                        <span tooltip="Eliminar" role="button" @click="destroyNumber(number.id)">
                            <IconTrash size="22" />
                        </span>
                    </td>
                </tr>
                <tr v-if="blockeds.length == 0">
                    <td colspan="4" class="text-center">No hay datos</td>
                </tr>
            </template>
        </TableSection>

        <FormModal :show="openModal" title="Numero bloqueado" @onCancel="resetValues" @onSubmit="onSubmit">
            <InputForm text="Numero" v-model="form.number" type="number" required />
            <InputForm text="Limite individual" v-model="form.settings.individual_limit" type="number" />
            <InputForm text="Limite general" v-model="form.settings.general_limit" type="number" />
        </FormModal>
    </div>
</template>

<script setup>
import InputForm from '@/Components/Form/InputForm.vue';
import FormModal from '@/Components/Modal/FormModal.vue';
import TableSection from '@/Components/TableSection.vue';
import { confirmAlert } from "@/Use/helpers";
import { toast } from '@/Use/toast';
import { router, useForm } from '@inertiajs/vue3';
import { IconTrash } from '@tabler/icons-vue';

const props = defineProps({
    raffle: {
        type: Object,
        required: true,
    },
    blockeds: {
        type: Object,
        required: true,
    },
    openModal: {
        type: Boolean,
        required: true,
    },
});

const emit = defineEmits(['update:openModal']);

const form = useForm({
    number: null,
    settings: {
        general_limit: null,
        individual_limit: null,
    }
});

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
            toast.success('Numero bloqueado');
        }
    });
}

const resetValues = () => {
    form.reset();
    emit('update:openModal', false);
};

const destroyNumber = (id) => {
    confirmAlert({
        message: "¿Está seguro de eliminar este registro?",
        onConfirm: () => {
            router.delete(route("clientarea.raffles.blocked-numbers.destroy", [props.raffle.id, id]), {
                preserveScroll: true,
                preserveState: true,
                onSuccess: () => {
                    toast.success("Eliminado correctamente");
                },
                onError: (err) => {
                    console.log(err);
                },
            });
        },
    });
}


</script>