<script setup>
import { Head } from '@inertiajs/vue3';
import Sidebar from './Sidebar.vue';
import { IconChevronRight } from '@tabler/icons-vue';
import { Link } from '@inertiajs/vue3';

defineProps({
    title: {
        type: String,
        default: '',
    },
    breads: {
        type: Array,
        default: [],
    },
});

</script>

<template>
    <Head :title="title" />
    <section class="flex w-full">
        <Sidebar />

        <main class="w-full p-4 lg:p-8">

            <ol class="flex items-center mb-4" v-if="breads.length > 0">
                <li class="flex items-center" v-for="(bread, index) in breads">
                    <IconChevronRight v-if="index != 0" class="text-gray-300" />
                    <Link :href="bread.route">
                    <span class="text-sm me-2 tracking-wider text-basic">
                        {{ bread.name }}
                    </span>
                    </Link>
                </li>
            </ol>

            <div class="w-full">
                <div class="flex items-center justify-between h-10 mb-6 text-basic">
                    <slot name="header" />
                </div>
                <slot />
            </div>
        </main>
    </section>
</template>

<style>
.swal2-popup .swal2-styled {
    border-radius: 0.375rem !important;
}

/* Hide scrollbar for Chrome, Safari and Opera */
.hide-scrollbar::-webkit-scrollbar {
    display: none;
}

/* Hide scrollbar for IE, Edge and Firefox */
.hide-scrollbar {
    -ms-overflow-style: none;
    /* IE and Edge */
    scrollbar-width: none;
    /* Firefox */
}
</style>
