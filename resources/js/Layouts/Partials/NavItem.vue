<template>
    <div class="flex items-center justify-center flex-col">
        <Link :href="item.route" class="inline-flex items-center justify-center w-10 h-10 font-medium rounded-full group"
            :class="active ? 'bg-primary' : 'bg-transparent'">
        <component :is="item.icon" :class="active ? 'w-4 h-4 text-white' : 'w-5 h-5 text-gray-600'" />
        </Link>
        <span class="text-xs text-gray-600" v-if="item.title">
            {{ item.title }}
        </span>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    item: {
        type: Object,
        required: true,
    },
    active: {
        type: Boolean,
        default: false,
    },
});

</script>