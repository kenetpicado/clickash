<template>
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <template v-for="i in results">
            <Link :href="getRoute(i.id)" class="bg-gray-100 rounded-xl p-3 w-full text-gray-600">
            <div class="mb-1 font-medium">
                {{ i.name }}
            </div>

            <div v-if="i.results.length == 0" class="text-gray-400 text-sm mt-1">
                No hay resultados
            </div>

            <div class="grid grid-cols-1 gap-2">
                <div v-for="hour in i.results" class="text-sm text-white text-center rounded-xl py-1 px-0.5" :class="bgClassColor[i.id] ?? 'bg-gray-500'">
                    {{ hour }}
                </div>
            </div>
            </Link>
        </template>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import { bgClassColor } from '@/Use/hours.js';

const props = defineProps({
    results: {
        type: Object,
        required: true,
    },
});

function getRoute(id) {
    const urlsearchParams = new URLSearchParams(window.location.search);

    if (urlsearchParams.get('date')) {
        return route('clientarea.results.show', [id, { date: urlsearchParams.get('date') }]);
    }

    return route('clientarea.results.show', id);
}

</script>