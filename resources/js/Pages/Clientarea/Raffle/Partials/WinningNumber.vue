<template>
    <div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
            <div v-for="result in results" class="bg-white p-8 rounded-xl items-center flex justify-center border">
                <div class="text-center">
                    <div class="text-2xl font-bold mb-2 badge-primary">
                        {{ result.number }}
                    </div>
                    <div class="text-center text-sm">
                        {{ Carbon.create().setTime(result.hour).getTimeFormat() }}
                    </div>
                </div>
            </div>
        </div>

        <TableSection>
            <template #header>
                <th>Vendedor</th>
                <th>Cliente</th>
                <th>Turno</th>
                <th>Numero</th>
                <th>Premio</th>
                <th>Fecha</th>
            </template>
            <template #body>
                <tr v-for="winner in winners">
                    <td>
                        {{ winner.user.name }}
                    </td>
                    <td>
                        {{ winner.client }}
                    </td>
                    <td>
                        <span class="badge-primary whitespace-nowrap">
                            {{ Carbon.create().setTime(winner.hour).getTimeFormat() }}
                        </span>
                    </td>
                    <td>
                        <span class="font-semibold">
                            {{ winner.digit }}
                        </span>
                    </td>
                    <td>
                        <span class="text-sm">
                            C${{ winner.prize }}
                        </span>
                    </td>
                    <td>
                        {{ Carbon.create(winner.created_at).format('d/m/Y') }}
                    </td>
                </tr>
                <tr v-if="winners.length == 0">
                    <td colspan="6" class="text-center">No hay datos</td>
                </tr>
            </template>
        </TableSection>

        <FormModal :show="openModal" title="Resultado" @onCancel="resetValues" @onSubmit="onSubmit">
            <div class="grid grid-cols-2 gap-2">
                <SelectForm v-model="form.hour" text="Turno" required>
                    <option value="" disabled selected>Seleccione un turno</option>
                    <option v-for="hour in hours" :value="hour">
                        {{ Carbon.create().setTime(hour).getTimeFormat() }}
                    </option>
                </SelectForm>
                <InputForm v-model="form.number" type="number" text="Numero" required />
            </div>

            <div class="text-red-500 mb-4" v-if="hours.length == 0">
                No se encontraron turnos disponibles para el dia en curso. Por favor, verifique la disponibilidad en
                "Horario"
            </div>
            <div class="text-gray-400" v-else>
                Verifique que los datos ingresados
                sean correctos antes de guardar, ya que para garantizar la integridad de los datos no se permite
                eliminar ni
                editar los resultados.
            </div>

        </FormModal>
    </div>
</template>

<script setup>
import TableSection from '@/Components/TableSection.vue';
import { useForm } from '@inertiajs/vue3';
import { computed } from 'vue';
import FormModal from '@/Components/Modal/FormModal.vue';
import InputForm from '@/Components/Form/InputForm.vue';
import SelectForm from '@/Components/Form/SelectForm.vue';
import { Carbon } from '@/Use/Carbon.js';
import { toast } from '@/Use/toast';
import { confirmAlert } from '@/Use/helpers';

const props = defineProps({
    results: {
        type: Object,
        required: true,
    },
    raffle: {
        type: Object,
        required: true,
    },
    openModal: {
        type: Boolean,
        required: true,
    },
    currentBlockedHours: {
        type: Object,
        required: true,
    },
    winners: {
        type: Object,
        required: true,
    },
});

const form = useForm({
    number: null,
    hour: null,
});

const emit = defineEmits(['update:openModal']);

const hours = computed(() => {
    if (props.currentBlockedHours.length == 0) {
        return [];
    }

    return props.currentBlockedHours[0].blocked_hours;
});

const resetValues = () => {
    form.reset();
    emit('update:openModal', false);
};

const onSubmit = () => {
    if (props.results.find((item) => item.hour == form.hour)) {
        toast.error('Ya existe un resultado para este turno');
        return;
    }

    confirmAlert({
        title: 'Confirmar',
        message: '¿Esta seguro de agregar este resultado?',
        onConfirm: () => {
            form.post(route('clientarea.raffles.winning-numbers.store', props.raffle.id), {
                preserveScroll: true,
                preserveState: true,
                onSuccess: () => {
                    resetValues();
                    toast.success('Guardado correctamente');
                },
                onError: (err) => {
                    toast.error(err.message);
                }
            });
        }
    });
}

</script>