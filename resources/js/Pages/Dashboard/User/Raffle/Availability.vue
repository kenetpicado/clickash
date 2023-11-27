<template>
    <AppLayout title="Horario" :breads="breads">

        <template #header>
            <span class="title">
                Horario de: "{{ raffle.name }}" del usuario {{ user.name }}
            </span>
        </template>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-4">
            <div v-for="i in availability" class="bg-card rounded-xl p-2 w-full">
                <div class="flex justify-between">
                    <span class="mb-2">{{ i.day }}</span>
                </div>

                <div class="text-xs text-gray-600">
                    <pre class="bg-white w-full p-3">{{ i}}</pre>
                </div>
            </div>
        </div>

    </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';

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
        name: 'Home',
        route: route('dashboard.users.index'),
    },
    {
        name: 'Usuarios',
        route: route('dashboard.users.index'),
    },
    {
        name: 'Rifas',
        route: route('dashboard.users.show', props.user.id),
    },
];

</script>