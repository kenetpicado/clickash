<template>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
        <div v-for="raffle in raffles" class="bg-card rounded-xl p-2 w-full">
            <div class="flex justify-between">
                <span>{{ raffle.raffle.name }}</span>

                <Menu as="div" class="relative inline-block text-left">

                    <MenuButton>
                        <IconList class="text-primary" />
                    </MenuButton>

                    <transition enter-active-class="transition duration-100 ease-out"
                        enter-from-class="transform scale-95 opacity-0" enter-to-class="transform scale-100 opacity-100"
                        leave-active-class="transition duration-75 ease-in"
                        leave-from-class="transform scale-100 opacity-100" leave-to-class="transform scale-95 opacity-0">
                        <MenuItems
                            class="absolute z-10 right-0 mt-2 w-56 origin-top-right divide-y divide-gray-100 rounded-md bg-white shadow-lg ring-1 ring-black/5 focus:outline-none">
                            <div class="px-1 py-1">
                                <MenuItem v-slot="{ active }">
                                <Link :href="route('clientarea.raffles.winning-numbers.index', raffle.raffle_id)"
                                    :class="[active ? 'bg-primary text-white' : 'text-gray-800', 'group flex w-full items-center rounded-md px-2 py-2 text-sm']">
                                    <IconUserCheck :class="[active ? 'text-white' : '', 'mr-2 h-5 w-5 text-primary']" />
                                    Ganadores
                                </Link>
                                </MenuItem>
                                <MenuItem v-slot="{ active }">
                                <Link :href="route('clientarea.raffles.blocked-numbers.index', raffle.raffle_id)"
                                    :class="[active ? 'bg-primary text-white' : 'text-gray-800', 'group flex w-full items-center rounded-md px-2 py-2 text-sm']">
                                    <IconNumber :class="[active ? 'text-white' : '', 'mr-2 h-5 w-5 text-primary']"  />
                                    Números bloqueados
                                </Link>
                                </MenuItem>
                            </div>
                            <div class="px-1 py-1">
                                <MenuItem v-slot="{ active }">
                                <Link :href="route('clientarea.raffles.show', raffle.raffle_id)"
                                    :class="[active ? 'bg-primary text-white' : 'text-gray-800', 'group flex w-full items-center rounded-md px-2 py-2 text-sm']">
                                    <IconEyeDollar :class="[active ? 'text-white' : '', 'mr-2 h-5 w-5 text-primary']"  />
                                    Ventas
                                </Link>
                                </MenuItem>
                                <MenuItem v-slot="{ active }">
                                <Link :href="route('clientarea.raffles.reports', raffle.raffle_id)"
                                    :class="[active ? 'bg-primary text-white' : 'text-gray-800', 'group flex w-full items-center rounded-md px-2 py-2 text-sm']">
                                    <IconReportAnalytics :class="[active ? 'text-white' : '', 'mr-2 h-5 w-5 text-primary']"  />
                                    Reportes
                                </Link>
                                </MenuItem>
                            </div>
                            <div class="px-1 py-1">
                                <MenuItem v-slot="{ active }">
                                <Link :href="route('clientarea.raffles.availability.index', raffle.raffle_id)"
                                    :class="[active ? 'bg-primary text-white' : 'text-gray-800', 'group flex w-full items-center rounded-md px-2 py-2 text-sm']">
                                    <IconDeviceWatch :class="[active ? 'text-white' : '', 'mr-2 h-5 w-5 text-primary']"  />
                                    Horario
                                </Link>
                                </MenuItem>
                                <MenuItem v-slot="{ active }">
                                <button @click="edit(raffle)"
                                    :class="[active ? 'bg-primary text-white' : 'text-gray-800', 'group flex w-full items-center rounded-md px-2 py-2 text-sm']">
                                    <IconSettings :class="[active ? 'text-white' : '', 'mr-2 h-5 w-5 text-primary']"  />
                                    Configuración
                                </button>
                                </MenuItem>
                            </div>
                        </MenuItems>
                    </transition>
                </Menu>
            </div>

            <div class="flex items-center gap-2 mb-3">
                <div class="bg-white rounded-xl">
                    <img src="/games.png" alt="" class="w-20 h-20">
                </div>
                <div class="flex flex-col gap-1 text-xs text-gray-600">
                    <span>Super X: {{ raffle.settings.super_x ? 'Activado' : 'Desactivado' }}</span>
                    <span v-if="raffle.settings.general_limit">
                        Limite general en venta: C${{ raffle.settings.general_limit }}
                    </span>
                    <span v-if="raffle.settings.individual_limit">
                        Limite individual en venta: C${{ raffle.settings.individual_limit }}
                    </span>
                    <span v-if="raffle.settings.multiplier">
                        Multiplicador: {{ raffle.settings.multiplier }}
                    </span>
                </div>
            </div>
            <div class="w-full text-center bg-white py-1 rounded-xl text-gray-600 text-xs">
                <span v-if="raffle.settings.date">
                    Fecha
                </span>
                <span v-else>
                    Desde {{ raffle.settings.min }} hasta {{ raffle.settings.max }}
                </span>
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
import { Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue';
import { useForm } from '@inertiajs/vue3';
import { IconDeviceWatch, IconEyeDollar, IconList, IconNumber, IconReportAnalytics, IconSettings, IconUserCheck } from '@tabler/icons-vue';
import { ref, watch } from 'vue';
import FormModal from './Modal/FormModal.vue';
import InputForm from './Form/InputForm.vue';
import Checkbox from './Form/Checkbox.vue';
import { toast } from '@/Use/toast';
import { Link } from '@inertiajs/vue3';

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
    form.raffle_name = raffle.raffle.name;
    form.raffle_id = raffle.raffle_id;
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