<template>
    <AppLayout title="Users" :breads="breads">

        <template #header>
            <span class="title">
                {{ user.name }}
            </span>
            <AddButton v-if="selectedTab == 'raffles'" @click="openModal = true" />
        </template>

        <div class="flex gap-3 overflow-x-auto hide-scrollbar mb-4">
            <div :class="selectedTab == 0 ? 'active-tab' : 'inactive-tab'" @click="selectedTab = 0" role="button">
                Vendedores
            </div>
            <div :class="selectedTab == 1 ? 'active-tab' : 'inactive-tab'" @click="selectedTab = 1" role="button">
                Rifas
            </div>
        </div>

        <TableSection v-if="selectedTab == 0">
            <template #header>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Active</th>
                <th>Status</th>
            </template>

            <template #body>
                <tr v-for="(user, index) in sellers" class="hover:bg-gray-50">
                    <td>
                        {{ index + 1 }}
                    </td>
                    <td>
                        {{ user.name }}
                    </td>
                    <td>
                        {{ user.email }}
                    </td>
                    <td>
                        <span v-if="user.online == 'Now'" class="badge-primary">
                            {{ user.online }}
                        </span>

                        <span v-else>
                            {{ user.online }}
                        </span>
                    </td>
                    <td>
                        <span class="uppercase">{{ user.status }}</span>
                    </td>
                </tr>
                <tr v-if="sellers.length == 0">
                    <td colspan="4" class="text-center">No data to display</td>
                </tr>
            </template>
        </TableSection>

        <TableSection v-if="selectedTab == 1">
            <template #header>
                <th>ID</th>
                <th>Nombre</th>
                <th>Settings</th>
                <th>Acciones</th>
            </template>

            <template #body>
                <tr v-for="(raffle, index) in raffles" class="hover:bg-gray-50">
                    <td>
                        {{ index + 1 }}
                    </td>
                    <td>
                        <span class="font-bold">{{ raffle.name }}</span>
                    </td>
                    <td>
                        <pre>{{ JSON.parse(raffle.pivot.settings) }}</pre>
                    </td>
                    <td>
                        <IconTrash role="button" @click="destroy(raffle.id)" />
                    </td>
                </tr>
                <tr v-if="raffles.length == 0">
                    <td colspan="5" class="text-center">No data to display</td>
                </tr>
            </template>
        </TableSection>

        <FormModal :show="openModal" title="Raffles" @onCancel="resetValues" @onSubmit="onSubmit">
            <SelectForm text="Raffle" v-model="raffle" required>
                <option selected disabled value="">Select Raffle</option>
                <option v-for="raffle in all_raffles" :value="raffle.id">{{ raffle.name }}</option>
            </SelectForm>
        </FormModal>
    </AppLayout>
</template>

<script setup>
import TableSection from '@/Components/TableSection.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { confirmAlert } from '@/Use/helpers';
import { toast } from '@/Use/toast';
import { router } from '@inertiajs/vue3';
import { IconTrash } from '@tabler/icons-vue';
import { ref } from 'vue';
import AddButton from '@/Components/Buttons/AddButton.vue';
import FormModal from '@/Components/Modal/FormModal.vue';
import SelectForm from '@/Components/Form/SelectForm.vue';

const props = defineProps({
    user: {
        type: Object,
        required: true,
    },
    sellers: {
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
        name: 'Users',
        route: route('dashboard.users.index'),
    },
    {
        name: props.user.name,
        route: route('dashboard.users.show', props.user.id),
    }
];

const selectedTab = ref(0);
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

<style>
pre {
    background-color: rgb(241, 241, 241);
    padding: 1rem;
    border-radius: 1rem;
}
</style>