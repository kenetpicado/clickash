<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { IconCurrencyDollar, IconGift, IconHome, IconLogout, IconUser, IconUsersGroup } from '@tabler/icons-vue';
import NavItem from './Partials/NavItem.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownItem from '@/Components/DropdownItem.vue';
import { useAuth } from '@/Composables/useAuth.js';
import AvatarUrl from '@/Use/profile.js';

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

const { logout } = useAuth();

const items = [
    {
        icon: IconUsersGroup,
        route: route('clientarea.sellers.index'),
        title: "Vendedores"
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

            <Dropdown :showIcon="false">
                <template #item>
                    <img :src="AvatarUrl($page.props?.auth?.name)" class="w-10 h-10 object-cover rounded-full"
                        alt="">
                </template>
                <div class="px-1 py-1">
                    <DropdownItem v-for="r in items" :href="r.route" :title="r.title" :icon="r.icon" />
                </div>
                <div class="px-1 py-1">
                    <DropdownItem @click="logout" title="Cerrar sesión" :icon="IconLogout" />
                </div>
            </Dropdown>
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

    <!-- <div class="fixed z-50 w-full h-16 max-w-lg -translate-x-1/2 bg-gray-100 border-2 rounded-lg bottom-2 left-1/2">
        <div class="grid h-full max-w-lg grid-cols-5 mx-auto">
            <NavItem v-for="item in items" :key="item.route" :item="item" :active="isActive(item.route)" />
        </div>
    </div> -->
</template>
