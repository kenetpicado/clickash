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
            <div v-for="a in availability" class="bg-card p-4 rounded-xl text-gray-600 border-4 border-gray-200">
                <div class="flex justify-between items-center mb-2">
                    <span>{{ a.day }}: {{ a.time_label }}</span>
                    <Dropdown>
                        <div class="px-1 py-1">
                            <DropdownItem @click="editDay(a)" title="Editar" :icon="IconEdit" />
                            <DropdownItem @click="destroyDay(a.id)" title="Eliminar" :icon="IconTrash" />
                        </div>
                    </Dropdown>
                </div>
                <h2 class="font-semibold mb-2 text-sm">Sorteos</h2>

                <div class="grid grid-cols-3 lg:grid-cols-4 gap-2">
                    <div v-for="hour in a.blocked_hours_parsed" class="text-sm text-white text-center rounded-xl py-1" :class="getBgColor(hour)">
                        {{ hour }}
                    </div>
                </div>
            </div>
        </div>

        <FormModal :show="openModal" title="Horario" @onCancel="resetValues" @onSubmit="onSubmit">
            <SelectForm v-model="form.day" text="Dia" name="day">
                <option value="" selected>Seleccione un dia</option>
                <option v-for="day in days" :value="day">{{ day }}</option>
            </SelectForm>
            <div class="grid grid-cols-2 gap-2">
                <InputForm text="Hora incio" v-model="form.start_time" type="time" required />
                <InputForm text="Hora fin" v-model="form.end_time" type="time" required />
            </div>
            <InputForm v-model="selectedHour" type="time" text="Sorteo" />
            <button type="button" class="primary-button" @click="pushToBlockedHours">
                Agregar
            </button>
            <p class="text-sm text-primary mt-1" v-if="$page.props.errors['blocked_hours']">
                {{ $page.props.errors['blocked_hours'] }}
            </p>

            <div class="mt-4 mb-2">
                Sorteos
            </div>

            <div class="grid grid-cols-2 lg:grid-cols-3 gap-2">
                <div v-for="(hour, index) in form.blocked_hours"
                    class="border px-2 py-1 rounded-xl flex items-center justify-between">
                    <span>{{ hour }}</span>
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
import { confirmAlert } from '@/Use/helpers';
import { toast } from '@/Use/toast';
import { router, useForm } from '@inertiajs/vue3';
import { IconEdit, IconTrash } from '@tabler/icons-vue';
import { defineProps, ref } from 'vue';

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
    day: null,
    start_time: "07:00:00",
    end_time: "21:00:00",
    raffle_id: props.raffle.id,
    blocked_hours: ["11:00:00", "15:00:00", "21:00:00"],
});

const days = ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'];

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
    form.day = day.day;
    isNew.value = false;
    openModal.value = true
}

const pushToBlockedHours = () => {
    if (!selectedHour.value) {
        toast.error('Seleccione una hora');
        return;
    }

    form.blocked_hours.push(selectedHour.value);
}

const onSubmit = () => {
    if (isNew.value) {
        form.post(route('clientarea.raffles.availability.store', props.raffle.id), {
            preserveScroll: true,
            preserveState: true,
            onSuccess: () => {
                resetValues();
                toast.success('Guardado correctamente');
            },
        });
    } else {
        form.put(route('clientarea.raffles.availability.update', [props.raffle.id, form.id]), {
            preserveScroll: true,
            preserveState: true,
            onSuccess: () => {
                resetValues();
                toast.success('Actualizado correctamente');
            },
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

function getBgColor(hour) {
    if (hour.includes("11:")) return "bg-cyan-600";
    if (hour.includes("9:")) return "bg-indigo-600";
    if (hour.includes("6:")) return "bg-emerald-600";
    if (hour.includes("3:")) return "bg-amber-600";
    return "bg-rose-600";
}

</script>
