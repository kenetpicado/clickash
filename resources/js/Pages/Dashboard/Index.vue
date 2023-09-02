<template>
    <AppLayout title="Users" :breads="breads">
        <template #header>
            <span class="title">
                Overview
            </span>
        </template>

        <div class="grid grid-cols-4 gap-4">
            <StatCard v-for="stat in stats" :stat="stat" :key="stat.name" />
        </div>
    </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { IconUsers } from '@tabler/icons-vue';
import StatCard from '@/Components/StatCard.vue';

const props = defineProps({
    users_count: {
        type: Number,
        default: 0,
    },
    sellers_count: {
        type: Number,
        default: 0,
    },
});

const breads = [
    {
        name: 'Home',
        route: route('dashboard.users.index'),
    },
];

const stats = [
    {
        value: props.users_count,
        title: 'Users',
        icon: IconUsers,
    },
    {
        value: props.sellers_count,
        title: 'Sellers',
        icon: IconUsers,
    },
]

</script>