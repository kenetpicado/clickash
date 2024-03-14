<template>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        <div v-for="raffle in raffles" class="bg-gray-100 rounded-lg p-2 w-full">
            <div class="flex justify-between">
                <span>{{ raffle.name }}</span>

                <Dropdown>
                    <div class="px-1 py-1">
                        <DropdownItem :href="route('clientarea.raffles.show', raffle.id)" title="Ventas"
                            :icon="IconEyeDollar" />

                        <DropdownItem :href="route('clientarea.raffles.winning-numbers.index', raffle.id)"
                            title="Ganadores" :icon="IconUserCheck" />

                        <DropdownItem :href="route('clientarea.raffles.reports', raffle.id)" title="Reportes"
                            :icon="IconReportAnalytics" />
                    </div>
                    <div class="px-1 py-1">
                        <DropdownItem :href="route('clientarea.raffles.blocked-numbers.index', raffle.id)"
                            title="Dígitos bloqueados" :icon="IconLock" />

                        <DropdownItem :href="route('clientarea.raffles.availability.index', raffle.id)" title="Horario"
                            :icon="IconDeviceWatch" />

                        <DropdownItem @click="edit(raffle)" title="Configuración" :icon="IconSettings" />
                    </div>
                </Dropdown>
            </div>

            <div class="flex items-center gap-2 mb-3">
                <div class="rounded-lg w-20 h-20 overflow-hidden">
                    <img v-if="raffle.image" :src="raffle.image" alt="" class="w-full h-full">
                    <img v-else src="/games.png" alt="" class="w-full h-full">
                </div>
                <div class="flex flex-col gap-1 text-xs">
                    <span>Super X: {{ raffle.settings.super_x ? 'Activado' : 'Desactivado' }}</span>
                    <span v-if="raffle.settings.general_limit">
                        Limite general: C${{ raffle.settings.general_limit }}
                    </span>
                    <span v-if="raffle.settings.individual_limit">
                        Limite individual: C${{ raffle.settings.individual_limit }}
                    </span>
                    <span v-if="!raffle.settings.date">
                        {{ raffle.settings.min }} - {{ raffle.settings.max }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <FormModal :show="openModal" :title="form.raffle_name" @onCancel="resetValues" @onSubmit="onSubmit">
        <div class="grid grid-cols-2 gap-4">
            <InputForm text="Limite general C$" v-model="form.settings.general_limit" type="number" />
            <InputForm text="Limite indiv. C$" v-model="form.settings.individual_limit" type="number" />
        </div>

        <div class="grid grid-cols-2 gap-4 mb-1">
            <Checkbox v-model:checked="form.settings.super_x" text="Super X" />
            <Checkbox v-model:checked="form.settings.date" text="Fecha" />
        </div>

        <div class="grid grid-cols-2 gap-4" v-if="!form.settings.date">
            <InputForm text="Número inicio" v-model="form.settings.min" required type="number" />
            <InputForm text="Número final" v-model="form.settings.max" required type="number" />
        </div>

        <InputForm text="Multiplicador" v-model="form.settings.multiplier" type="number" required />
    </FormModal>
</template>

<script setup>
import { toast } from '@/Use/toast';
import { useForm } from '@inertiajs/vue3';
import { IconDeviceWatch, IconEyeDollar, IconLock, IconReportAnalytics, IconSettings, IconUserCheck } from '@tabler/icons-vue';
import { ref, watch } from 'vue';
import Dropdown from './Dropdown.vue';
import DropdownItem from './DropdownItem.vue';
import Checkbox from './Form/Checkbox.vue';
import InputForm from './Form/InputForm.vue';
import FormModal from './Modal/FormModal.vue';

const props = defineProps({
    raffles: {
        type: Object,
        required: true
    }
})

const openModal = ref(false);

const form = useForm({
    raffle_name: null,
    raffle_id: null,
    settings: {
        super_x: true,
        date: false,
        min: null,
        max: null,
        general_limit: null,
        individual_limit: null,
        multiplier: 70
    },
});

function edit(raffle) {
    form.raffle_name = raffle.name;
    form.raffle_id = raffle.id;
    Object.assign(form.settings, raffle.settings);
    openModal.value = true;
}

function onSubmit() {
    form.put(route('clientarea.raffles.update', form.raffle_id), {
        preserveScroll: true,
        onSuccess: () => {
            resetValues();
            toast.success('Rifa actualizada');
        },
    });
}

const resetValues = () => {
    form.reset();
    openModal.value = false;
};

watch(() => form.settings.date, (value) => {
    if (value) {
        form.settings.min = null;
        form.settings.max = null;
    }
});

</script>