<template>
    <AppLayout title="Inicio" :breads="breads">
        <template #header>
            <span class="title">
                Inicio
            </span>
        </template>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-4">
            <StatCard v-for="stat in stats" :stat="stat" :key="stat.name" />
        </div>
    </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { IconUsers } from '@tabler/icons-vue';
import StatCard from '@/Components/StatCard.vue';

const props = defineProps({
    users: {
        type: Object,
        required: true,
    },
});

const breads = [
    {
        name: 'Inicio',
        route: route('dashboard.index'),
    },
];

const stats = [
    {
        value: props.users.owners,
        title: 'Propietarios',
        icon: IconUsers,
    },
    {
        value: props.users.sellers,
        title: 'Vendedores',
        icon: IconUsers,
    },
]

</script>