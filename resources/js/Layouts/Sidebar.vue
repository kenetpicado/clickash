<template>
    <aside class="w-72 p-3 flex flex-col hidden lg:block min-h-screen">
        <div class="flex flex-col items-center my-1">
            <Link :href="route('home')">
            <div class="h-14 my-6">
                <img class="h-full w-full object-contain" src="/logo1x1.png" alt="" />
            </div>
            </Link>
        </div>
        <ul class="space-y-2 text-basic">
            <li v-for="item in items">
                <span v-if="item.header" class="block text-xs text-gray-400 uppercase tracking-wider mt-2 px-2">
                    {{ item.header }}
                </span>
                <Link v-else :href="item.route">
                <span class="flex items-center px-2 py-3 rounded-lg gap-4" :class="getClass(item.route)">
                    <component :is="item.icon ?? DEFAULT_ICON"></component>
                    <span>{{ item.name }}</span>
                </span>
                </Link>
            </li>
            <li>
                <Link :href="route('profile.index')">
                <span class="flex items-center px-2 py-3 rounded-lg gap-4" :class="getClass(route('profile.index'))">
                    <IconUser />
                    <span>Perfil</span>
                </span>
                </Link>
            </li>
            <li>
                <span @click="logout" class="flex items-center px-2 py-3 rounded-lg gap-4 hover:bg-gray-100" role="button">
                    <IconLogout></IconLogout>
                    <span>Salir</span>
                </span>
            </li>
        </ul>
    </aside>
</template>

<script setup>
import { Link, router, usePage } from '@inertiajs/vue3';
import { IconMoneybag } from '@tabler/icons-vue';
import { IconUserCog } from '@tabler/icons-vue';
import { IconHome, IconLogout, IconUsers, IconUser, IconGift } from '@tabler/icons-vue';

const DEFAULT_ICON = IconUsers;

const logout = () => {
    router.post(route('logout'));
};

const items = [
    {
        header: 'Administración'
    },
    {
        name: 'Usuarios',
        route: route('dashboard.users.index'),
        icon: IconUsers
    },
    {
        name: 'Rifas',
        route: route('dashboard.raffles.index'),
        icon: IconGift
    },
    {
        header: 'Sistema'
    },
]

function getClass(fullRoute) {
    return window.location.href == fullRoute
        ? 'bg-card'
        : 'hover:bg-card';
}

</script>