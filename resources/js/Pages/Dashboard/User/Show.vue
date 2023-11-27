<template>
    <AppLayout title="Rifas" :breads="breads">

        <template #header>
            <span class="title">
                Rifas de: {{ user.name }}
            </span>
            <AddButton @click="openModal = true" />
        </template>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-4">
            <div v-for="raffle in raffles" class="bg-card rounded-xl p-2 w-full">
                <div class="flex justify-between">
                    <span class="mb-2">{{ raffle.name }}</span>

                    <Dropdown>
                        <div class="px-1 py-1">
                            <DropdownItem :href="route('dashboard.users.raffles.availability.index', [user.id, raffle.id])"
                                title="Horario" :icon="IconDeviceWatch" />
                            <DropdownItem @click="destroy(raffle.id)" title="Eliminar" :icon="IconTrash" />
                        </div>
                    </Dropdown>
                </div>

                <div class="text-xs text-gray-600">
                    <pre class="bg-white w-full p-3">{{ JSON.parse(raffle.pivot.settings) }}</pre>
                </div>
            </div>
        </div>

        <FormModal :show="openModal" title="Rifas" @onCancel="resetValues" @onSubmit="onSubmit">
            <SelectForm text="Rifas disponibles" v-model="raffle" required>
                <option selected disabled value="">Seleccionar rifa</option>
                <option v-for="raffle in all_raffles" :value="raffle.id">{{ raffle.name }}</option>
            </SelectForm>
        </FormModal>
    </AppLayout>
</template>

<script setup>
import AddButton from '@/Components/Buttons/AddButton.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownItem from '@/Components/DropdownItem.vue';
import SelectForm from '@/Components/Form/SelectForm.vue';
import FormModal from '@/Components/Modal/FormModal.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { confirmAlert } from '@/Use/helpers';
import { toast } from '@/Use/toast';
import { router } from '@inertiajs/vue3';
import { IconDeviceWatch } from '@tabler/icons-vue';
import { IconTrash } from '@tabler/icons-vue';
import { ref } from 'vue';

const props = defineProps({
    user: {
        type: Object,
        required: true,
    },
    raffles: {
        type: Object,
        required: true,
    },
    all_raffles: {
        type: Object,
        required: true,
    },
});

const breads = [
    {
        name: 'Home',
        route: route('dashboard.users.index'),
    },
    {
        name: 'Usuarios',
        route: route('dashboard.users.index'),
    },
];

const openModal = ref(false);
const raffle = ref(null);

function destroy(id) {
    confirmAlert({
        message: 'Are you sure you want to delete this raffle?',
        onConfirm: () => {
            router.delete(route('dashboard.users.raffles.destroy', [props.user.id, id]), {
                preserveScroll: true,
                preserveState: true,
                onSuccess: () => {
                    toast.success('Raffle deleted successfully');
                },
            });
        },
    })
}

function resetValues() {
    raffle.value = null;
    openModal.value = false;
}

function onSubmit() {
    router.post(route('dashboard.users.raffles.store', props.user.id), { raffle_id: raffle.value }, {
        onSuccess: () => {
            toast.success('Raffle added successfully');
            resetValues();
        },
    });
}

</script>