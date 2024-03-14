<template>
    <div class="bg-gray-100 p-3 rounded-xl text-gray-600">
        <div class="flex justify-between items-center mb-2">
            <span class="text-xl font-bold">{{ digit.number }}</span>
            <IconTrash size="20" @click="$emit('destroy', digit.id)" role="button" />
        </div>
        <div class="grid grid-cols-1 gap-2">
            <div v-if="digit.settings.general_limit">
                <small>Limite general de ventas:</small>
                <br>
                C$ {{ digit.settings.general_limit }}
            </div>
            <div v-if="digit.settings.individual_limit">
                <small>Limite individual de ventas:</small>
                <br>
                C$ {{ digit.settings.individual_limit }}
            </div>
        </div>
    </div>
</template>

<script setup>
import { IconTrash } from '@tabler/icons-vue';

defineProps({
    digit: {
        type: Object,
        required: true,
    },
})

defineEmits(['destroy'])

</script>