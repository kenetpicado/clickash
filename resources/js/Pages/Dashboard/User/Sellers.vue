<template>
    <AppLayout title="Vendedores" :breads="breads">

        <template #header>
            <span class="title">
                Vendedores de: {{ user.name }}
            </span>
        </template>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
            <JsonContent v-for="i in sellers" :title="i.name" :content="cleanValues(i)"/>
        </div>

    </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import JsonContent from '@/Components/JsonContent.vue';

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
        name: 'Inicio',
        route: route('dashboard.index'),
    },
    {
        name: 'Usuarios',
        route: route('dashboard.users.index'),
    },
    {
        name: 'Vendedores',
        route: route('dashboard.users.sellers', props.user.id),
    },
];

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