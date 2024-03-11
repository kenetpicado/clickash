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
                <template v-for="i in weeks_resume.data">
                    <Link class="bg-card p-3 rounded-xl" :href="route('clientarea.sellers.archings.show', [seller.id, i.week])">
                    <div class="flex items-center justify-between text-sm mb-2">
                        <span class="text-gray-400">{{ i.week_label }}</span>
                    </div>
                    <div class="text-gray-600 grid grid-cols-2 gap-1 text-sm">
                        <span v-for="value in i.resume">{{ value }}</span>
                    </div>
                    </Link>
                </template>
            </div>
            <ThePaginator :links="weeks_resume.meta.links" />
        </template>
    </ClientareaLayout>
</template>

<script setup>
import ThePaginator from '@/Components/ThePaginator.vue';
import ClientareaLayout from '@/Layouts/ClientareaLayout.vue';
import { Link } from '@inertiajs/vue3';

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
