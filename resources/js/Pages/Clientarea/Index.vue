<template>
    <AppLayout title="Users" :breads="breads">
        <template #header>
            <span class="title">
                Baby
            </span>
        </template>
    </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';

const breads = [
    {
        name: 'Home',
        route: route('dashboard.users.index'),
    },
];

</script>