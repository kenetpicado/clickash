<template>
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <template v-for="i in results">
            <Link :href="route('clientarea.results.show', i.id)" class="bg-card rounded-xl p-2 w-full text-gray-600">
            <div class="mb-1 font-medium">
                {{ i.name }}
            </div>

            <div class="text-xs flex flex-col gap-1">
                <span v-if="i.results.length == 0" class="text-gray-400">
                    No hay resultados
                </span>
                <div v-else v-for="r in i.results">
                    {{ r }}
                </div>
            </div>
            </Link>
        </template>
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

</script>