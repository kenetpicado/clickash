<template>
    <div class="flex items-center justify-center flex-col">
        <Link :href="item.route" class="inline-flex items-center justify-center w-9 h-9 font-medium rounded-full group"
            :class="active ? 'bg-green-pea-700' : 'bg-transparent'">
        <component :is="item.icon" :class="active ? 'w-4 h-4 text-white' : 'w-5 h-5'" />
        </Link>
        <span class="text-xxs lg:text-sm" v-if="item.title">
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
