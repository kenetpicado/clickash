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
        title: "Usuarios"
    },
    {
        icon: IconCurrencyDollar,
        route: route('clientarea.invoices.index'),
        title: "Recibos"
    },
    {
        icon: IconHome,
        route: route('clientarea.raffles.index'),
        title: "Rifas"
    },
    {
        icon: IconGift,
        route: route('clientarea.results.index'),
        title: "Resultados"
    },
    {
        icon: IconUser,
        route: route('clientarea.profile.index'),
        title: "Perfil"
    },
];

const isActive = (r) => {
    return window.location.href.includes(r);
};

</script>

<template>
    <Head :title="title" />
    <nav class="bg-card">
        <div class="flex items-center justify-between px-4 py-2 mx-auto max-w-screen-lg">
            <Link :href="route('clientarea.raffles.index')" class="font-bold text-lg text-gray-600">{{ $page.props.app_name }}
            </Link>
            <Link :href="route('clientarea.profile.index')" class="font-bold text-lg text-gray-600">
            <img src="/profile.png" class="w-10 h-10 object-cover rounded-full" alt="">
            </Link>
        </div>
    </nav>
    <main class="p-4 mx-auto max-w-screen-lg mb-12">
        <div class="flex items-center overflow-x-auto hide-scrollbar">
            <slot name="options" />
        </div>
        <div class="flex items-center justify-between mb-4 text-gray-600">
            <slot name="header" />
        </div>
        <slot />
    </main>

    <div class="fixed z-50 w-full h-16 max-w-lg -translate-x-1/2 border-2 border-gray-100 bg-card rounded-xl bottom-2 left-1/2">
        <div class="grid h-full max-w-lg grid-cols-5 mx-auto">
            <NavItem v-for="item in items" :key="item.route" :item="item" :active="isActive(item.route)" />
        </div>
    </div>
</template>
