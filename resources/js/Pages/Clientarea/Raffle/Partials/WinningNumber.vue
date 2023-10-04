<template>
    <div>
        <TableSection>
            <template #header>
                <th>Fecha</th>
                <th>Turno</th>
                <th>Numero</th>
            </template>
            <template #body>
                <tr v-for="result in results">
                    <td>
                        Hoy
                    </td>
                    <td>
                        <span class="badge-blue whitespace-nowrap">
                            {{ result.hour }}
                        </span>
                    </td>
                    <td>
                        <span class="text-sm badge-green">
                            {{ result.number }}
                        </span>
                    </td>
                </tr>
                <tr v-if="results.length == 0">
                    <td colspan="3" class="text-center">No hay datos</td>
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
                <InputForm v-model="form.number" type="number" text="Numero" />
            </div>
            <p class="text-red-500 mb-4" v-if="hours.length == 0">
                No se encontraron turnos disponibles para el dia en curso. Por favor, verifique la disponibilidad en "Horario"
            </p>
            <p class="text-gray-400" v-else>
                Solo puede agregar resultados del dia de hoy y 1 por turno.
            </p>
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

</script>