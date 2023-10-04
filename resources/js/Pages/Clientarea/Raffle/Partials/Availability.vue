<template>
    <div>
        <TableSection>
            <template #header>
                <th>Dia</th>
                <th>Horario</th>
                <th>Sorteos</th>
                <th>Acciones</th>
            </template>
            <template #body>
                <tr v-for="day in availability">
                    <td>
                        {{ day.order }} - {{ day.day }}
                    </td>
                    <td>
                        <span class="whitespace-nowrap">
                            {{ Carbon.create().setTime(day.start_time).getTimeFormat() }} -
                        </span>
                        {{ Carbon.create().setTime(day.end_time).getTimeFormat() }}
                    </td>
                    <td>
                        <div v-for="hour in day.blocked_hours" class="badge-blue m-1 whitespace-nowrap">
                            {{ Carbon.create().setTime(hour).getTimeFormat() }}
                        </div>
                    </td>
                    <td>
                        <div class="flex items-center gap-3">
                            <span tooltip="Editar" role="button" @click="editDay(day)">
                                <IconEdit size="22" />
                            </span>
                            <span tooltip="Eliminar" role="button" @click="destroyDay(day.id)">
                                <IconTrash size="22" />
                            </span>
                        </div>
                    </td>
                </tr>
            </template>
        </TableSection>

        <FormModal :show="openModal" title="Horario" @onCancel="resetValuesSchedule" @onSubmit="onSubmit">
            <SelectForm v-model="formSchedule.order" text="Dia" required v-if="isNew">
                <option value="" disabled selected>Seleccione un dia</option>
                <option v-for="day in availableDays" :value="day.order">{{ day.name }}</option>
            </SelectForm>
            <p class="text-sm text-red-600 mb-4" v-if="availableDays.length == 0 && isNew">
                Ya se ha registrado todos los dias
            </p>
            <div class="grid grid-cols-2 gap-2">
                <InputForm text="Hora incio" v-model="formSchedule.start_time" type="time" required />
                <InputForm text="Hora fin" v-model="formSchedule.end_time" type="time" required />
            </div>
            <InputForm v-model="selectedHour" type="time" text="Sorteo" />
            <button type="button" class="primary-button" @click="pushToBlockedHours">
                Agregar
            </button>
            <p class="text-sm text-red-600 mt-1" v-if="$page.props.errors['blocked_hours']">
                {{ $page.props.errors['blocked_hours'] }}
            </p>

            <div class="flex gap-3 mt-5">
                <div v-for="(hour, index) in formSchedule.blocked_hours"
                    class="text-xs inline-flex items-center font-bold leading-sm px-3 py-1 bg-indigo-200 text-indigo-700 rounded-full">
                    <span class="mr-3"> {{ Carbon.create().setTime(hour).getTimeFormat() }}</span>
                    <span role="button" tooltip="Eliminar">
                        <IconTrash size="15" @click="popHour(index)" />
                    </span>
                </div>
            </div>
        </FormModal>
    </div>
</template>

<script setup>
import TableSection from '@/Components/TableSection.vue';
import FormModal from '@/Components/Modal/FormModal.vue';
import InputForm from '@/Components/Form/InputForm.vue';
import SelectForm from '@/Components/Form/SelectForm.vue';
import { Carbon } from '@/Use/Carbon.js';
import { computed, ref, watch } from 'vue';
import { IconEdit, IconTrash } from '@tabler/icons-vue';
import { confirmAlert } from "@/Use/helpers";
import { router, useForm } from '@inertiajs/vue3';
import { toast } from '@/Use/toast';

const selectedHour = ref(null);
const isNew = ref(true);

const props = defineProps({
    availability: {
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
});

const formSchedule = useForm({
    id: null,
    order: null,
    day: null,
    start_time: "07:00:00",
    end_time: "21:00:00",
    raffle_id: props.raffle.id,
    blocked_hours: [],
});

const emit = defineEmits(['update:openModal']);

const week = [
    {
        order: 0,
        name: "Domingo"
    },
    {
        order: 1,
        name: "Lunes"
    },
    {
        order: 2,
        name: "Martes"
    },
    {
        order: 3,
        name: "Miercoles"
    },
    {
        order: 4,
        name: "Jueves"
    },
    {
        order: 5,
        name: "Viernes"
    },
    {
        order: 6,
        name: "Sabado"
    },
]

const availableDays = computed(() => {
    let days = [];

    week.forEach((item) => {
        if (!props.availability.find((day) => day.day == item.name)) {
            days.push(item);
        }
    });

    return days;
});


watch(() => formSchedule.order, (value) => {
    if (value) {
        formSchedule.day = week.find((item) => item.order == value).name;
    }
});

const resetValuesSchedule = () => {
    formSchedule.reset();
    emit('update:openModal', false);
};

const editDay = (day) => {
    formSchedule.id = day.id;
    formSchedule.start_time = day.start_time;
    formSchedule.end_time = day.end_time;
    formSchedule.blocked_hours = day.blocked_hours;
    isNew.value = false;

    emit('update:openModal', true);
}

const pushToBlockedHours = () => {
    if (!selectedHour.value) {
        toast.error('Debe seleccionar una hora');
        return;
    }

    if (selectedHour.value) {
        if (!formSchedule.blocked_hours.find((item) => item == selectedHour.value)) {
            formSchedule.blocked_hours.push(selectedHour.value + ":00");
        }
        selectedHour.value = null;
    }
}

const onSubmit = () => {
    if (isNew.value) {
        formSchedule.post(route('clientarea.raffles.availability.store', props.raffle.id), {
            preserveScroll: true,
            preserveState: true,
            onSuccess: () => {
                resetValuesSchedule();
                toast.success('Guardado correctamente');
            }
        });
    } else {
        formSchedule.put(route('clientarea.raffles.availability.update', [props.raffle.id, formSchedule.id]), {
            preserveScroll: true,
            preserveState: true,
            onSuccess: () => {
                resetValuesSchedule();
                toast.success('Actualizado correctamente');
            }
        });
    }
}

const popHour = (index) => {
    formSchedule.blocked_hours.splice(index, 1);
}

const destroyDay = (id) => {
    confirmAlert({
        message: "¿Está seguro de eliminar este registro?",
        onConfirm: () => {
            router.delete(route("clientarea.raffles.availability.destroy", [props.raffle.id, id]), {
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