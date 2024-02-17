<template>
    <AppLayout title="Usuarios" :breads="breads">

        <template #header>
            <span class="title">
                Usuarios
            </span>
            <AddButton @click="openModal = true" />
        </template>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
            <JsonContent v-for="user in users" :title="user.name" :content="cleanValues(user)">
                <Dropdown>
                    <div class="px-1 py-1">
                        <DropdownItem :href="route('dashboard.users.show', user.id)" title="Rifas" :icon="IconGift" />
                        <DropdownItem :href="route('dashboard.users.sellers', user.id)" title="Vendedores"
                            :icon="IconUsers" />
                    </div>
                    <div class="px-1 py-1">
                        <DropdownItem @click="edit(user)" title="Editar" :icon="IconEdit" />
                        <DropdownItem @click="destroy(user.id)" title="Eliminar" :icon="IconTrash" />
                    </div>
                </Dropdown>
            </JsonContent>
        </div>

        <FormModal :show="openModal" title="Usuario" @onCancel="resetValues" @onSubmit="onSubmit">
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
import AddButton from '@/Components/Buttons/AddButton.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownItem from '@/Components/DropdownItem.vue';
import InputForm from '@/Components/Form/InputForm.vue';
import SelectForm from '@/Components/Form/SelectForm.vue';
import FormModal from '@/Components/Modal/FormModal.vue';
import { useUser } from '@/Composables/useUser.js';
import AppLayout from '@/Layouts/AppLayout.vue';
import { IconEdit, IconGift, IconTrash, IconUsers } from '@tabler/icons-vue';
import { ref } from 'vue';
import JsonContent from '@/Components/JsonContent.vue';

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
        name: 'Inicio',
        route: route('dashboard.index'),
    },
    {
        name: 'Usuarios',
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

function cleanValues(user) {
    delete user.email_verified_at;
    delete user.user_id;
    delete user.created_at;
    delete user.updated_at;
    delete user.last_login;
    delete user.deleted_at;
    return user;
}

</script>