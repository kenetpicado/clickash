<template>
    <ClientareaLayout title="Horario">
        <template #header>
            <span class="title">
                Horario
            </span>
            <button type="button" class="simple-button" @click="openModal = true">
                Nuevo
            </button>
        </template>
        <div v-if="availability.length == 0" class="w-full text-center text-gray-400">
            No hay horario
        </div>
        <div v-else class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-4">
            <div v-for="a in availability" class="bg-card p-4 rounded-xl text-gray-600">
                <div class="flex justify-between items-center mb-2">
                    <span>{{ a.day }}</span>
                    <Dropdown>
                        <DropdownItem @click="editDay(a)" title="Editar" :icon="IconEdit"/>
                        <DropdownItem @click="destroyDay(a.id)" title="Eliminar" :icon="IconTrash"/>
                    </Dropdown>
                </div>
                <div class="grid grid-cols-2 gap-2 mb-4">
                    <div>
                        <strong class="text-sm">Hora de inicio</strong>
                        <div>
                            {{ Carbon.create().setTime(a.start_time).getTimeFormat() }}
                        </div>
                    </div>
                    <div>
                        <strong class="text-sm">Hora de fin</strong>
                        <div>
                            {{ Carbon.create().setTime(a.end_time).getTimeFormat() }}
                        </div>
                    </div>
                </div>
                <h2 class="font-semibold mb-2 text-sm">Sorteos</h2>
                <div class="flex items-center gap-3 overflow-x-auto hide-scrollbar text-sm">
                    <div v-for="hour in a.blocked_hours"
                        class="inline-flex items-center bg-white px-2 py-1 rounded-xl whitespace-nowrap">
                        {{ Carbon.create().setTime(hour).getTimeFormat() }}
                    </div>
                </div>
            </div>
        </div>

        <FormModal :show="openModal" title="Horario" @onCancel="resetValues" @onSubmit="onSubmit">
            <SelectForm v-model="form.order" text="Dia" required v-if="isNew">
                <option v-if="availableDays.length > 0" value="" disabled selected>Seleccione un dia</option>
                <option v-else value="" disabled selected>No hay dias disponibles</option>
                <option v-for="day in availableDays" :value="day.order">{{ day.name }}</option>
            </SelectForm>
            <div class="grid grid-cols-2 gap-2">
                <InputForm text="Hora incio" v-model="form.start_time" type="time" required />
                <InputForm text="Hora fin" v-model="form.end_time" type="time" required />
            </div>
            <InputForm v-model="selectedHour" type="time" text="Sorteo" />
            <button type="button" class="primary-button" @click="pushToBlockedHours">
                Agregar
            </button>
            <p class="text-sm text-primaryDark mt-1" v-if="$page.props.errors['blocked_hours']">
                {{ $page.props.errors['blocked_hours'] }}
            </p>

            <div class="mt-4 mb-2">
                Sorteos
            </div>

            <div class="grid grid-cols-2 lg:grid-cols-3 gap-2">
                <div v-for="(hour, index) in form.blocked_hours"
                    class="border px-2 py-1 rounded-xl flex items-center justify-between">
                    <span> {{ Carbon.create().setTime(hour).getTimeFormat() }}</span>
                    <span role="button">
                        <IconTrash size="18" @click="popHour(index)" />
                    </span>
                </div>
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
import ClientareaLayout from '@/Layouts/ClientareaLayout.vue';
import { Carbon } from '@/Use/Carbon';
import { confirmAlert } from '@/Use/helpers';
import { toast } from '@/Use/toast';
import { router, useForm } from '@inertiajs/vue3';
import { IconEdit, IconTrash } from '@tabler/icons-vue';
import { computed, defineProps, ref, watch } from 'vue';

const props = defineProps({
    availability: {
        type: Object,
        required: true,
    },
    raffle: {
        type: Object,
        required: true,
    },
})

const openModal = ref(false);
const isNew = ref(true);
const selectedHour = ref(null);

const form = useForm({
    id: null,
    order: null,
    day: null,
    start_time: "07:00:00",
    end_time: "21:00:00",
    raffle_id: props.raffle.id,
    blocked_hours: ["11:00:00", "15:00:00", "21:00:00"],
});

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

watch(() => form.order, (value) => {
    if (value) {
        form.day = week.find((item) => item.order == value).name;
    }
});

const resetValues = () => {
    form.reset();
    isNew.value = true;
    openModal.value = false;
    selectedHour.value = null;
};

const editDay = (day) => {
    form.id = day.id;
    form.start_time = day.start_time;
    form.end_time = day.end_time;
    form.blocked_hours = day.blocked_hours;
    isNew.value = false;
    openModal.value = true
}

const pushToBlockedHours = () => {
    if (!selectedHour.value) {
        toast.error('Debe seleccionar una hora');
        return;
    }

    if (selectedHour.value) {
        if (!form.blocked_hours.find((item) => item == selectedHour.value + ":00")) {
            form.blocked_hours.push(selectedHour.value + ":00");
        }
        selectedHour.value = null;
    }
}

const onSubmit = () => {
    if (isNew.value) {
        form.post(route('clientarea.raffles.availability.store', props.raffle.id), {
            preserveScroll: true,
            preserveState: true,
            onSuccess: () => {
                resetValues();
                toast.success('Guardado correctamente');
            }
        });
    } else {
        form.put(route('clientarea.raffles.availability.update', [props.raffle.id, form.id]), {
            preserveScroll: true,
            preserveState: true,
            onSuccess: () => {
                resetValues();
                toast.success('Actualizado correctamente');
            }
        });
    }
}

const popHour = (index) => {
    form.blocked_hours.splice(index, 1);
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
            });
        },
    });
}

</script>