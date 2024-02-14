<template>
    <div class="bg-card p-3 rounded-xl text-gray-600">
        <div class="flex justify-between items-center mb-2">
            <span class="text-xl font-bold">{{ digit.number }}</span>
            <IconTrash class="text-primary" size="20" @click="$emit('destroy', digit.id)" role="button" />
        </div>
        <div class="grid grid-cols-2 gap-2">
            <div v-if="digit.settings.general_limit">
                <strong class="text-sm">General</strong>
                <div>
                    C$ {{ digit.settings.general_limit }}
                </div>
            </div>
            <div v-if="digit.settings.individual_limit">
                <strong class="text-sm">Individual</strong>
                <div>
                    C$ {{ digit.settings.individual_limit }}
                </div>
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