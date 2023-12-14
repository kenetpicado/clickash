<template>
    <ClientareaLayout title="Ganadores">
        <template #header>
            <span class="title">
                Ganadores
            </span>
            <button type="button" class="simple-button" @click="openModal = true">
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

            <div class="text-red-500 mb-4" v-if="hours.length == 0">
                No se encontraron turnos disponibles para el dia en curso. Por favor, verifique la disponibilidad en
                "Horario"
            </div>

            <SelectForm v-else v-model="form.hour" text="Turno" required>
                <option value="" disabled selected>Seleccione un turno</option>
                <option v-for="hour in hours" :value="hour">
                    {{ Carbon.create().setTime(hour).getTimeFormat() }}
                </option>
            </SelectForm>

            <InputForm v-if="settings.date" v-model="selectedDate" type="date" text="Fecha" required />
            <InputForm v-else v-model="form.number" type="number" text="Numero" required />

            <div class="text-gray-400 text-sm">
                Verifique que los datos ingresados sean correctos antes de guardar, ya que para garantizar la integridad de
                los datos no se permite
                eliminar ni editar los resultados.
            </div>

            <div class="mt-5 text-basic" v-if="form.number && form.hour">
                Agregando el numero ganador: <span class="font-bold">{{ form.number }}</span> a la rifa {{ raffle.name }}
                para el turno de las {{ Carbon.create().setTime(form.hour).getTimeFormat() }} del corriente dia:
                {{ Carbon.create().format('d/m/Y') }}.
            </div>

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
import { computed, ref, watch } from 'vue';

const props = defineProps({
    winning_numbers: {
        type: Object,
        required: true,
    },
    hours: {
        type: Object,
        required: true,
    },
    settings: {
        type: Object,
        required: true,
    },
    raffle: {
        type: Object,
        required: true,
    },
})

const openModal = ref(false)
const selectedDate = ref('')

const form = useForm({
    number: null,
    hour: null,
});

const stats = computed(() => {
    return props.winning_numbers.map((result) => {
        return {
            id: result.id,
            title: "Turno: " + Carbon.create().setTime(result.hour).getTimeFormat(),
            value: "Dígito: " + result.number,
            icon: IconCheck,
        }
    })
})

function resetValues() {
    form.reset()
    openModal.value = false
}

watch(() => selectedDate.value, (value) => {
    if (value) {
        form.number = Carbon.create(value).format('d/m');
    } else
        form.number = null;
});

const onSubmit = () => {
    if (props.winning_numbers.find((item) => item.hour == form.hour)) {
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