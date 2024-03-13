<template>
    <component :is="href ? Link : 'div'" class="bg-card p-3 rounded-lg" :href="href">
        <div class="flex items-center justify-between text-sm mb-2">
            <span class="text-gray-400">{{ week.week_label }}</span>
        </div>
        <div class="text-gray-600 grid grid-cols-2 gap-1 text-sm">
            <span v-for="value in week.resume">
                {{ value }}
            </span>
        </div>
    </component>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    week: {
        type: Object,
        required: true,
    },
    href: {
        type: String,
        required: false,
    }
})

</script>