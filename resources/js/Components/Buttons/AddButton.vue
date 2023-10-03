<template>
    <Link v-if="href" :href="href">
        <button class="primary-button" type="button">
            Agregar
        </button>
    </Link>
    <button class="primary-button" type="button" v-else>
        Agregar
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