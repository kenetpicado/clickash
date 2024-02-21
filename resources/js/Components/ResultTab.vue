<template>
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <template v-for="i in results">
            <Link :href="route('clientarea.results.show', i.id)" class="bg-card rounded-xl p-2 w-full text-gray-600">
            <div class="mb-1 font-medium">
                {{ i.name }}
            </div>

            <div v-if="i.results.length == 0" class="flex my-3 justify-center text-gray-400 text-xs">
                No hay resultados
            </div>

            <div v-else class="grid grid-cols-1 lg:grid-cols-2 gap-2">
                <div v-for="hour in i.results" :class="getHourClass(hour)">
                    {{ hour }}
                </div>
            </div>
            </Link>
        </template>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import { getHourClass } from '@/Use/hours';

const props = defineProps({
    results: {
        type: Object,
        required: true,
    },
});

</script>