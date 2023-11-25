<script setup>
import { Head } from '@inertiajs/vue3';
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
    <nav class="bg-white border gray-200 shadow">
        <div class="flex items-center justify-between px-4 py-2 mx-auto max-w-screen-lg">
            <Link :href="route('clientarea.index')" class="font-bold text-lg text-gray-600">{{ $page.props.app_name }}</Link>
            <Link :href="route('clientarea.profile.index')" class="font-bold text-lg text-gray-600">
                <img src="/profile.png" class="w-10 h-10 object-cover rounded-full border-2 border-white" alt="">
            </Link>
        </div>
    </nav>
    <main class="p-4 mx-auto max-w-screen-lg">
        <div class="flex items-center gap-3 overflow-x-auto hide-scrollbar text-xs text-gray-600 mb-4">
            <slot name="options" />
        </div>
        <div class="flex items-center justify-between mb-4 text-gray-600">
            <slot name="header" />
        </div>
        <slot />
    </main>
</template>
