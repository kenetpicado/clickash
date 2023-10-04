<template>
    <AppLayout title="Rifa" :breads="breads">

        <template #header>
            <span class="title">
                {{ raffle.name }}
            </span>
            <AddButton v-if="currentTab == 1" @click="openModalNumber = true" />
            <AddButton v-if="currentTab == 2" @click="openModalSchedule = true" />
        </template>

        <div class="flex gap-3 overflow-x-auto hide-scrollbar mb-4">
            <div :class="currentTab == 0 ? 'active-tab' : 'inactive-tab'" @click="currentTab = 0" role="button">
                Ventas
            </div>
            <div :class="currentTab == 1 ? 'active-tab' : 'inactive-tab'" @click="currentTab = 1" role="button">
                Bloqueados
            </div>
            <div :class="currentTab == 2 ? 'active-tab' : 'inactive-tab'" @click="currentTab = 2" role="button">
                Disponibilidad
            </div>
        </div>

        <TableSection v-if="currentTab == 0">
            <template #header>
                <th>Vendedor</th>
                <th>Turno</th>
                <th>Monto</th>
                <th>Numero</th>
            </template>
            <template #body>
                <tr v-for="transaction in transactions.data">
                    <td>
                        <div class="text-xs text-gray-400 mb-1">
                            #{{ transaction.id }} - {{ Carbon.create(transaction.created_at).diffForHumans() }}
                        </div>
                        <div class="mb-1 ">
                            {{ transaction.user.name }}
                        </div>
                        <div class="text-gray-400">
                            {{ transaction.client }}
                        </div>
                    </td>
                    <td>
                        <span class="badge-blue whitespace-nowrap">
                            {{ Carbon.create().setTime(transaction.hour).getTimeFormat() }}
                        </span>
                    </td>
                    <td>
                        C${{ transaction.amount }}
                    </td>
                    <td>
                        <span class="font-semibold">
                            #{{ transaction.digit }}
                        </span>
                    </td>
                </tr>
                <tr v-if="transactions.data.length == 0">
                    <td colspan="4" class="text-center">No hay datos</td>
                </tr>
            </template>
            <template #paginator>
                <ThePaginator :links="transactions.links" />
            </template>
        </TableSection>

        <TableSection v-if="currentTab == 1">
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

        <TableSection v-if="currentTab == 2">
            <template #header>
                <th>Dia</th>
                <th>Horario</th>
                <th>Sorteos</th>
                <th>Acciones</th>
            </template>
            <template #body>
                <tr v-for="day in availability">
                    <td>
                        {{ day.day }}
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
                        <span tooltip="Editar" role="button" @click="editDay(day)">
                            <IconEdit size="22" />
                        </span>
                    </td>
                </tr>
            </template>
        </TableSection>

        <FormModal :show="openModalNumber" title="Numero bloqueado" @onCancel="resetValues" @onSubmit="onSubmit">
            <InputForm text="Numero" v-model="form.number" type="number" required />
            <InputForm text="Limite individual" v-model="form.settings.individual_limit" type="number" />
            <InputForm text="Limite general" v-model="form.settings.general_limit" type="number" />
        </FormModal>

        <FormModal :show="openModalSchedule" title="Horario" @onCancel="resetValuesSchedule" @onSubmit="onSubmit">
            <pre>{{ availableDays }}</pre>
            <div class="grid grid-cols-2 gap-2">
                <InputForm text="Hora incio" v-model="formSchedule.start_time" type="time" required />
                <InputForm text="Hora fin" v-model="formSchedule.end_time" type="time" required />
            </div>
        </FormModal>
    </AppLayout>
</template>

<script setup>
import TableSection from '@/Components/TableSection.vue';
import ThePaginator from '@/Components/ThePaginator.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { Carbon } from '@/Use/Carbon.js';
import { computed, ref } from 'vue';
import AddButton from '@/Components/Buttons/AddButton.vue';
import InputForm from '@/Components/Form/InputForm.vue';
import FormModal from '@/Components/Modal/FormModal.vue';
import { router, useForm } from '@inertiajs/vue3';
import { toast } from '@/Use/toast';
import { IconTrash, IconEdit } from '@tabler/icons-vue';
import { confirmAlert } from "@/Use/helpers";
import SelectForm from '@/Components/Form/SelectForm.vue';

const props = defineProps({
    raffle: {
        type: Object,
        required: true,
    },
    transactions: {
        type: Object,
        required: true,
    },
    blockeds: {
        type: Object,
        required: true,
    },
    availability: {
        type: Object,
        required: true,
    },
});

const breads = [
    {
        name: 'Inicio',
        route: route('clientarea.index'),
    },
    {
        name: 'Rifas',
        route: route('clientarea.raffles.index'),
    },
    {
        name: props.raffle.name,
        route: route('clientarea.raffles.show', props.raffle.id),
    }
];

const currentTab = ref(0);
const openModalNumber = ref(false);
const openModalSchedule = ref(false);

const form = useForm({
    number: null,
    settings: {
        general_limit: null,
        individual_limit: null,
    }
});

const formSchedule = useForm({
    order: null,
    day: null,
    start_time: "07:00:00",
    end_time: "07:00:00",
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

//propiedad computada para obtener los dias que no existan en props.availability
const availableDays = computed(() => {
    let days = [];

    week.forEach((item) => {
        if (!props.availability.find((day) => day.day == item.name)) {
            days.push(item);
        }
    });

    return days;
});

const onSubmit = () => {
    if (isNaN(form.number)) {
        toast.error('Numero invalido');
        return;
    }

    if (!form.settings.general_limit && !form.settings.individual_limit) {
        toast.error('Debe ingresar al menos un limite');
        return;
    }

    if (props.blockeds.find((item) => item.number == form.number)) {
        toast.error('Numero ya bloqueado');
        return;
    }

    form.post(route('clientarea.raffles.blocked-numbers.store', props.raffle.id), {
        onSuccess: () => {
            resetValues();
            toast.success('Numero bloqueado');
        }
    });
}

const resetValues = () => {
    form.reset();
    openModalNumber.value = false;
};

const resetValuesSchedule = () => {
    formSchedule.reset();
    openModalSchedule.value = false;
};

const editDay = (day) => {
    console.log(day);
    openModalSchedule.value = true;
}

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