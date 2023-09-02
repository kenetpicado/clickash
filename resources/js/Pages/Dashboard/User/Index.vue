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
                <th>Email</th>
                <th>Sellers</th>
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
                    </td>
                    <td>
                        {{ user.email }}
                    </td>
                    <td>
                        {{ user.sellers_count }} / {{ user.sellers }}
                    </td>
                    <td>
                        <span v-if="user.status == 'Online'" class="badge-green">
                            {{ user.status }}
                        </span>

                        <span v-else>
                            {{ user.status }}
                        </span>
                    </td>
                    <td>
                        <div class="flex gap-2">
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
            <template v-if="isNew">
                <InputForm text="Password" v-model="form.password" type="password" required />
                <InputForm text="Password confirmation" v-model="form.password_confirmation" type="password" required />
            </template>
            <InputForm text="Sellers" v-model="form.sellers" type="number" />
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
import { useForm, Link } from '@inertiajs/vue3';
import { toast } from '@/Use/toast';
import { confirmAlert } from '@/Use/helpers';

defineProps({
    users: {
        type: Object,
        required: true,
    }
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
];

const isNew = ref(true);

const form = useForm({
    id: '',
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    sellers: 5,
});

const openModal = ref(false);

function edit(user) {
    form.id = user.id;
    form.name = user.name;
    form.email = user.email;
    form.sellers = user.sellers;
    isNew.value = false;
    openModal.value = true;
}

function onSubmit() {
    if (isNew.value) {
        form.post(route('dashboard.users.store'), {
            preserveScroll: true,
            preserveState: true,
            onSuccess: () => {
                toast.success('User created successfully');
                openModal.value = false;
            },
        });
    } else {
        form.put(route('dashboard.users.update', form.id), {
            preserveScroll: true,
            preserveState: true,
            onSuccess: () => {
                toast.success('User updated successfully');
                openModal.value = false;
            },
        });
    }
}

function destroy(id) {
    confirmAlert({
        message: 'Are you sure you want to delete this user?',
        onConfirm: () => {
            form.delete(route('dashboard.users.destroy', id), {
                preserveScroll: true,
                preserveState: true,
                onSuccess: () => {
                    toast.success('User deleted successfully');
                },
            });
        },
    })
}

function resetValues() {
    form.id = '';
    form.name = '';
    form.email = '';
    form.password = '';
    form.password_confirmation = '';
    form.sellers = 5;
    openModal.value = false;
    isNew.value = true;
}

</script>