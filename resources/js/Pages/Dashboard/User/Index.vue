<template>
    <AppLayout title="Users" :breads="breads">

        <template #header>
            <span class="title">
                Users
            </span>
            <AddButton @click="openModal = true" />
        </template>

        <TableSection>
            <template #header>
                <th>ID</th>
                <th>Nombre</th>
                <th>Company</th>
                <th>Sellers</th>
                <th>Role</th>
                <th>Active</th>
                <th>Status</th>
                <th>Accciones</th>
            </template>

            <template #body>
                <tr v-for="(user, index) in users" class="hover:bg-gray-50">
                    <td>
                        {{ index + 1 }}
                    </td>
                    <td>
                        {{ user.name }}
                        <div class="text-gray-400 mt-2">
                            {{ user.email }}
                        </div>
                    </td>
                    <td>
                        {{ user.company_name }}
                    </td>
                    <td>
                        {{ user.sellers_count }} / {{ user.sellers_limit }}
                    </td>
                    <td>
                        <span class="badge-primary uppercase" v-if="user.role">
                            {{ user.role }}
                        </span>
                    </td>
                    <td>
                        {{ user.online }}
                    </td>
                    <td> <span class="uppercase">{{ user.status }}</span></td>
                    <td>
                        <div class="flex gap-2 text-gray-400">
                            <Link :href="route('dashboard.users.show', user.id)">
                            <IconEye />
                            </Link>

                            <IconPencil role="button" @click="edit(user)" />
                            <IconTrash role="button" @click="destroy(user.id)" />
                        </div>
                    </td>
                </tr>
                <tr v-if="users.length == 0">
                    <td colspan="6" class="text-center">No data to display</td>
                </tr>
            </template>
        </TableSection>

        <FormModal :show="openModal" title="User" @onCancel="resetValues" @onSubmit="onSubmit">
            <InputForm text="Name" v-model="form.name" required />
            <InputForm text="Email" v-model="form.email" type="email" required />
            <InputForm text="Company name" v-model="form.company_name" required />
            <template v-if="isNew">
                <InputForm text="Password" v-model="form.password" type="password" required />
                <InputForm text="Password confirmation" v-model="form.password_confirmation" type="password" required />
            </template>
            <InputForm text="Sellers limit" v-model="form.sellers_limit" type="number" />
            <SelectForm v-model="form.role" text="Role">
                <option v-for="role in roles" :value="role">{{ role }}</option>
            </SelectForm>
            <SelectForm v-if="!isNew" v-model="form.status" text="Status">
                <option v-for="status in statuses" :value="status">{{ status }}</option>
            </SelectForm>
        </FormModal>

    </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import TableSection from '@/Components/TableSection.vue';
import { IconPencil, IconTrash, IconEye } from '@tabler/icons-vue';
import AddButton from '@/Components/Buttons/AddButton.vue';
import FormModal from '@/Components/Modal/FormModal.vue';
import InputForm from '@/Components/Form/InputForm.vue';
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';
import SelectForm from '@/Components/Form/SelectForm.vue';
import { useUser } from '@/Composables/useUser.js';

defineProps({
    users: {
        type: Object,
        required: true,
    },
    roles: {
        type: Object,
        required: true,
    },
    statuses: {
        type: Object,
        required: true,
    },
});

const { destroy, store, update, form } = useUser();

const breads = [
    {
        name: 'Home',
        route: route('dashboard.users.index'),
    },
    {
        name: 'Users',
        route: route('dashboard.users.index'),
    },
];

const isNew = ref(true);
const openModal = ref(false);

function edit(user) {
    Object.assign(form, user);
    isNew.value = false;
    openModal.value = true;
}

function onSubmit() {
    if (isNew.value)
        store(resetValues);
    else
        update(resetValues);
}

const resetValues = () => {
    form.reset();
    openModal.value = false;
    isNew.value = true;
};

</script>