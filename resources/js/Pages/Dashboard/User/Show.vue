<template>
    <AppLayout title="Users" :breads="breads">

        <template #header>
            <span class="title">
                {{ user.name }}
            </span>
            <AddButton :href="route('dashboard.users.create')" />
        </template>

        <TableSection>
            <template #header>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Status</th>
            </template>

            <template #body>
                <tr v-for="(user, index) in sellers" class="hover:bg-gray-50">
                    <td>
                        {{ user.id }}
                    </td>
                    <td>
                        {{ user.name }}
                    </td>
                    <td>
                        {{ user.email }}
                    </td>
                    <td>
                        <span :class="[user.status == 'Online' ? 'badge-green' : 'badge-red']">
                            {{ user.status }}
                        </span>
                    </td>
                </tr>
                <tr v-if="sellers.length == 0">
                    <td colspan="4" class="text-center">No data to display</td>
                </tr>
            </template>
        </TableSection>

        <FormModal :show="openModal" title="Edit" @onCancel="openModal = false" @onSubmit="onSubmit">
            <InputForm text="Name" v-model="form.name" />
            <InputForm text="Email" v-model="form.email" type="email" />
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

const props = defineProps({
    user: {
        type: Object,
        required: true,
    },
    sellers: {
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

const form = useForm({
    id: '',
    name: '',
    email: '',
});

const openModal = ref(false);

function onSubmit() {
    form.put(route('dashboard.users.update', form.id), {
        preserveScroll: true,
        preserveState: true,
        onSuccess: () => {
            toast.success('User updated successfully');
            openModal.value = false;
        },
    });
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

</script>