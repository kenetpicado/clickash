<template>
    <AppLayout title="Horario" :breads="breads">

        <template #header>
            <span class="title">
                Horario de: "{{ raffle.name }}" del usuario {{ user.name }}
            </span>
        </template>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-4">
            <JsonContent v-for="i in availability" :title="i.day" :content="i"/>
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
    raffle: {
        type: Object,
        required: true,
    },
    availability: {
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
        name: 'Rifas',
        route: route('dashboard.users.show', props.user.id),
    },
    {
        name: 'Horario',
        route: window.location.href,
    },
];

</script>