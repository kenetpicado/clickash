<template>
    <ClientareaLayout title="Caja">
        <template #header>
            <span class="title">
                {{ seller.name }}: Caja
            </span>
        </template>

        <div v-if="weeks_resume.data.length == 0">
            <div class="w-full text-center text-gray-400">
                No hay datos que mostrar
            </div>
        </div>
        <template v-else>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 text-gray-600">
                <WeekResume v-for="week in weeks_resume.data" :week="week"
                    :href="route('clientarea.sellers.archings.show', [seller.id, week.week])" />
            </div>
            <ThePaginator :links="weeks_resume.meta.links" />
        </template>
    </ClientareaLayout>
</template>

<script setup>
import ThePaginator from '@/Components/ThePaginator.vue';
import ClientareaLayout from '@/Layouts/ClientareaLayout.vue';
import WeekResume from '@/Components/WeekResume.vue';

const props = defineProps({
    seller: {
        type: Object,
        required: true,
    },
    weeks_resume: {
        type: Object,
        required: true,
    },
})

</script>
