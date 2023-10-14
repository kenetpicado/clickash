<template>
    <AppLayout title="Users" :breads="breads">

        <template #header>
            <span class="title">
                {{ user.name }}
            </span>
            <AddButton v-if="selectedTab == 'raffles'" @click="openModal = true" />
        </template>

        <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 mb-4">
            <li class="mr-2">
                <span role="button" @click="selectedTab = 'sellers'" :class="getClass('sellers')">
                    Sellers
                </span>
            </li>
            <li class="mr-2">
                <span role="button" @click="selectedTab = 'raffles'" :class="getClass('raffles')">
                    Raffles
                </span>
            </li>
        </ul>

        <TableSection v-if="selectedTab == 'sellers'">
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

        <TableSection v-if="selectedTab == 'raffles'">
            <template #header>
                <th>ID</th>
                <th>Imagen</th>
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
                        <img :src="getImageSrc(raffle.image)" alt="" class="w-20 h-20 object-cover rounded-lg">
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

const selectedTab = ref('sellers');
const openModal = ref(false);
const raffle = ref(null);

function getClass(tab) {
    return selectedTab.value == tab
        ? 'inline-block px-4 py-2 text-white bg-gray-800 rounded-lg'
        : 'inline-block px-4 py-2 rounded-lg hover:text-gray-900 hover:bg-gray-100';
}

function getImageSrc(value) {
    if (value) {
        return value;
    }

    return "https://media.istockphoto.com/id/1211282980/es/vector/ganadores-afortunados-girando-tambor-de-la-rifa.jpg?s=612x612&w=0&k=20&c=1jJPxjaVHqPFA_DQGDV3QEBQ6_C3pbhjs8Ies2kR-44="
}

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
}</style>