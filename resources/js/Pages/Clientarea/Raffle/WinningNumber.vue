<template>
    <ClientareaLayout title="Ganadores">
        <template #header>
            <span class="title">
                {{ raffle.name }}: Ganadores
            </span>
            <button type="button" class="primary-button" @click="openModal = true">
                Nuevo
            </button>
        </template>

        <div v-if="stats.length == 0" class="w-full text-center text-gray-400 mb-4">
            No hay resultados
        </div>

        <div v-else class="grid grid-cols-1 lg:grid-cols-4 gap-4 mb-4">
            <StatCardActions v-for="stat in stats" :stat="stat" :key="stat.title">
                <Dropdown>
                    <div class="px-1 py-1">
                        <DropdownItem @click="destroy(stat.id)" title="Eliminar" :icon="IconTrash" />
                    </div>
                </Dropdown>
            </StatCardActions>
        </div>

        <FormModal :show="openModal" title="Resultado" @onCancel="resetValues" @onSubmit="onSubmit">
            <div class="text-red-500 mb-4" v-if="raffle.blocked_hours.length == 0">
                No se encontraron turnos disponibles para el dia en curso. Por favor, verifique la disponibilidad en
                "Horario"
            </div>

            <SelectForm v-else v-model="form.hour" text="Turno" required>
                <option value="" disabled selected>Seleccione un turno</option>
                <option v-for="hour in raffle.blocked_hours" :value="hour">
                    {{ Carbon.create().setTime(hour).getTimeFormat() }}
                </option>
            </SelectForm>

            <InputForm v-model="form.number" text="Dígito" required />
        </FormModal>

    </ClientareaLayout>
</template>

<script setup>
import Dropdown from '@/Components/Dropdown.vue';
import DropdownItem from '@/Components/DropdownItem.vue';
import InputForm from '@/Components/Form/InputForm.vue';
import SelectForm from '@/Components/Form/SelectForm.vue';
import FormModal from '@/Components/Modal/FormModal.vue';
import StatCardActions from '@/Components/StatCardActions.vue';
import ClientareaLayout from '@/Layouts/ClientareaLayout.vue';
import { Carbon } from '@/Use/Carbon';
import { confirmAlert } from '@/Use/helpers';
import { toast } from '@/Use/toast';
import { useForm } from '@inertiajs/vue3';
import { IconCheck, IconTrash } from '@tabler/icons-vue';
import { computed, ref } from 'vue';

const props = defineProps({
    winning_numbers: {
        type: Object,
        required: true,
    },
    raffle: {
        type: Object,
        required: true,
    },
})

const openModal = ref(false)

const form = useForm({
    number: null,
    hour: null,
});

const stats = computed(() => {
    return props.winning_numbers.map((result) => {
        return {
            id: result.id,
            title: "Turno: " + result.hour,
            value: "Dígito: " + result.number,
            date: "Fecha: " + result.date,
            icon: IconCheck,
        }
    })
})

function resetValues() {
    form.reset()
    openModal.value = false
}

const onSubmit = () => {
    if (props.winning_numbers.find((item) => item.hour == form.hour)) {
        toast.error('Ya existe un resultado para este turno');
        return;
    }

    if (props.raffle.settings.max) {
        if (parseInt(form.number) > parseInt(props.raffle.settings.max)) {
            toast.error('El número ingresado supera el máximo permitido: ' + props.raffle.settings.max);
            return;
        }

        if (form.number.length > props.raffle.settings.max.length) {
            toast.error("Los números solo pueden contener " + props.raffle.settings.max.length + " digitos");
            return;
        }
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

function destroy(id) {
    confirmAlert({
        message: "¿Está seguro de eliminar este registro?",
        onConfirm: () => {
            form.delete(route('clientarea.raffles.winning-numbers.destroy', [props.raffle.id, id]), {
                preserveScroll: true,
                preserveState: true,
                onSuccess: () => {
                    resetValues();
                    toast.success('Eliminado correctamente');
                },
                onError: (err) => {
                    toast.error(err.message);
                }
            });
        }
    });
}

</script>