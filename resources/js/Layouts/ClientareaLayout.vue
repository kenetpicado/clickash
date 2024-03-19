<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { IconCurrencyDollar, IconGift, IconHome, IconLogout, IconUser, IconUsersGroup } from '@tabler/icons-vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownItem from '@/Components/DropdownItem.vue';
import { useAuth } from '@/Composables/useAuth.js';
import AvatarUrl from '@/Use/profile.js';
import { MenuItem } from '@headlessui/vue';

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
        header: "Inicio"
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
        icon: IconCurrencyDollar,
        route: route('clientarea.invoices.index'),
        title: "Recibos"
    },
    {
        header: "Administración"
    },
    {
        icon: IconUsersGroup,
        route: route('clientarea.sellers.index'),
        title: "Vendedores"
    },
    {
        header: "Cuenta"
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

function getClass(fullRoute) {
    return isActive(fullRoute)
        ? 'bg-green-pea-700 text-white'
        : 'hover:bg-gray-100';
}

</script>

<template>

    <Head :title="title" />

    <div class="flex">
        <aside class="w-72 min-h-screen p-0 m-0 bg-white flex flex-col border hidden lg:block">
            <div class="h-full px-3 py-4 overflow-y-auto">
                <div class="flex flex-col items-center my-6">
                    <Link :href="route('clientarea.raffles.index')" class="h-20 w-20">
                        <img class="h-full w-full rounded-xl" src="/CA-LogoText.jpg" alt="" />
                    </Link>
                </div>
                <ul class="space-y-1">
                    <li v-for="item in items">
                        <span v-if="item.header"
                            class="block text-xs text-gray-500 uppercase tracking-wider font-semibold mt-6 px-2">
                            {{ item.header }}
                        </span>
                        <Link v-else :href="item.route">
                        <span class="flex items-center px-2 py-3 rounded-xl gap-4" :class="getClass(item.route)">
                            <component :is="item.icon" :class="isActive(item.route) ? 'text-white' : ''"></component>
                            <span>{{ item.title }}</span>
                        </span>
                        </Link>
                    </li>
                    <li>
                        <span @click="logout" class="flex items-center px-2 py-3 rounded-lg gap-4 hover:bg-gray-100"
                            role="button">
                            <IconLogout></IconLogout>
                            <span>Salir</span>
                        </span>
                    </li>
                </ul>
            </div>
        </aside>

        <div class="w-full">
            <nav class="bg-white mb-3 shadow">
                <div class="flex items-center justify-between px-4 py-2 mx-auto max-w-screen-lg">
                    <Link :href="route('clientarea.raffles.index')" class="font-bold text-lg text-gray-600">
                    {{ $page.props.auth.company_name }}
                    </Link>

                    <Dropdown :showIcon="false">
                        <template #item>
                            <img :src="AvatarUrl($page.props?.auth?.name)" class="w-10 h-10 object-cover rounded-full"
                                alt="">
                        </template>
                        <div class="px-1 py-1">
                            <template v-for="r in items">
                                <MenuItem v-slot="{ active }" v-if="r.header">
                                <span class="block text-xs text-gray-400 font-semibold mt-2 px-2">
                                    {{ r.header }}
                                </span>
                                </MenuItem>
                                <DropdownItem v-else :href="r.route" :title="r.title" :icon="r.icon" />
                            </template>
                        </div>
                        <div class="px-1 py-1">
                            <DropdownItem @click="logout" title="Cerrar sesión" :icon="IconLogout" />
                        </div>
                    </Dropdown>
                </div>
            </nav>
            <main class="p-4 mx-auto max-w-screen-lg mb-4">
                <div class="flex items-center overflow-x-auto hide-scrollbar">
                    <slot name="options" />
                </div>
                <div class="flex items-center justify-between mb-4">
                    <slot name="header" />
                </div>
                <slot />
            </main>
        </div>
    </div>
</template>
