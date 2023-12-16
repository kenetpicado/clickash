<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { IconCurrencyDollar, IconGift, IconHome, IconUser, IconUsersGroup } from '@tabler/icons-vue';
import NavItem from './Partials/NavItem.vue';

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

const items = [
    {
        icon: IconUsersGroup,
        route: route('clientarea.sellers.index'),
    },
    {
        icon: IconCurrencyDollar,
        route: route('clientarea.transactions.index'),
    },
    {
        icon: IconHome,
        route: route('clientarea.index'),
    },
    {
        icon: IconGift,
        route: route('clientarea.results.index'),
    },
    {
        icon: IconUser,
        route: route('clientarea.profile.index'),
    },
];

</script>

<template>
    <Head :title="title" />
    <nav class="bg-white border gray-200 shadow">
        <div class="flex items-center justify-between px-4 py-2 mx-auto max-w-screen-lg">
            <Link :href="route('clientarea.index')" class="font-bold text-lg text-gray-600">{{ $page.props.app_name }}
            </Link>
            <Link :href="route('clientarea.profile.index')" class="font-bold text-lg text-gray-600">
            <img src="/profile.png" class="w-10 h-10 object-cover rounded-full border-2 border-white" alt="">
            </Link>
        </div>
    </nav>
    <main class="p-4 mx-auto max-w-screen-lg">
        <div class="flex items-center overflow-x-auto hide-scrollbar">
            <slot name="options" />
        </div>
        <div class="flex items-center justify-between mb-4 text-gray-600">
            <slot name="header" />
        </div>
        <slot />
    </main>

    <div
        class="fixed z-50 w-full h-16 max-w-lg -translate-x-1/2 bg-card rounded-full bottom-2 left-1/2">
        <div class="grid h-full max-w-lg grid-cols-5 mx-auto">
            <NavItem v-for="item in items" :key="item.route" :item="item" />
        </div>
    </div>
</template>
