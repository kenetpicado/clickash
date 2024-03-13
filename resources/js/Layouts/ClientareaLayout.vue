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


function getAvatarUrl(name) {
    let back = '2A6049'
    let color = 'fff'

    return `https://ui-avatars.com/api/?name=${name}&size=256&background=${back}&color=${color}`
}


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
    <nav class="bg-white mb-3 shadow">
        <div class="flex items-center justify-between px-4 py-2 mx-auto max-w-screen-lg">
            <Link :href="route('clientarea.raffles.index')" class="font-bold text-lg">{{ $page.props.app_name }}
            </Link>
            <Link :href="route('clientarea.profile.index')" class="font-bold text-lg">
            <img :src="getAvatarUrl($page.props?.auth?.name)" class="w-10 h-10 object-cover rounded-full" alt="">
            </Link>
        </div>
    </nav>
    <main class="p-4 mx-auto max-w-screen-lg mb-12">
        <div class="flex items-center overflow-x-auto hide-scrollbar">
            <slot name="options" />
        </div>
        <div class="flex items-center justify-between mb-4">
            <slot name="header" />
        </div>
        <slot />
    </main>

    <div class="fixed z-50 w-full h-16 max-w-lg -translate-x-1/2 bg-gray-100 border-2 rounded-lg bottom-2 left-1/2">
        <div class="grid h-full max-w-lg grid-cols-5 mx-auto">
            <NavItem v-for="item in items" :key="item.route" :item="item" :active="isActive(item.route)" />
        </div>
    </div>
</template>
