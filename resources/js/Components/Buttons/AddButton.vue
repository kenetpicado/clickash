<template>
    <Link v-if="href" :href="href">
        <button class="primary-button" type="button">
            Add
        </button>
    </Link>
    <button class="primary-button" type="button" v-else>
        Add
    </button>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    href: {
        type: String,
        required: false,
    },
});

</script>