<template>
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4" v-if="results.some(r => r.results.length > 0)">
        <template v-for="i in results">
            <Link v-if="i.results.length > 0" :href="route('clientarea.results.show', i.id)" class="bg-card rounded-xl p-3 w-full text-gray-600">
            <div class="mb-1 font-medium">
                {{ i.name }}
            </div>

            <div class="grid grid-cols-1 gap-2">
                <div v-for="hour in i.results" class="text-sm text-white text-center rounded-xl py-1 px-0.5" :class="getBgColor(hour)">
                    {{ hour }}
                </div>
            </div>
            </Link>
        </template>
    </div>
    <div v-else>
        <div class="w-full text-center text-gray-400">
            No hay resultados
        </div>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    results: {
        type: Object,
        required: true,
    },
});

function getBgColor(hour) {
    if (hour.includes("11:")) return "bg-cyan-600";
    if (hour.includes("9:")) return "bg-indigo-600";
    if (hour.includes("6:")) return "bg-emerald-600";
    if (hour.includes("3:")) return "bg-amber-600";
    return "bg-rose-600";
}

</script>