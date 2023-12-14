<template>
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <div v-for="i in results" class="bg-card rounded-xl p-2 w-full text-gray-600">
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
        </div>
    </div>
</template>

<script setup>

const props = defineProps({
    results: {
        type: Object,
        required: true,
    },
});

</script>