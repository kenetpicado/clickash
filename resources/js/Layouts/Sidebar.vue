<template>
    <aside class="w-72 p-3 flex flex-col hidden lg:block min-h-screen bg-white border m-0">
        <div class="flex flex-col items-center my-6">
            <Link :href="route('dashboard.index')">
            <h2 class="font-bold text-gray-600 text-xl">
                ClickAsh
            </h2>
            </Link>
        </div>
        <ul class="space-y-2">
            <li v-for="item in items">
                <span v-if="item.header" class="block text-xs text-gray-400 uppercase tracking-wider mt-6 px-2">
                    {{ item.header }}
                </span>
                <Link v-else :href="item.route">
                <span class="flex items-center px-2 py-3 rounded-xl gap-4" :class="getClass(item.route)">
                    <component :is="item.icon ?? DEFAULT_ICON" :class="getIconClass(item.route)"></component>
                    <span>{{ item.name }}</span>
                </span>
                </Link>
            </li>
            <li>
                <span @click="logout" class="flex items-center px-2 py-3 rounded-xl gap-4 hover:bg-gray-100" role="button">
                    <IconLogout></IconLogout>
                    <span>Salir</span>
                </span>
            </li>
        </ul>
    </aside>
</template>

<script setup>
import { Link, router } from '@inertiajs/vue3';
import { IconHome } from '@tabler/icons-vue';
import { IconGift, IconLogout, IconUser, IconUsers } from '@tabler/icons-vue';

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
    {
        name: 'Perfil',
        route: route('profile.index'),
        icon: IconUser
    },
]

function getClass(fullRoute) {
    return window.location.href.includes(fullRoute)
        ? 'bg-primary text-white'
        : 'hover:bg-gray-100';
}

function getIconClass(fullRoute) {
    return window.location.href.includes(fullRoute)
        ? 'text-white'
        : '';
}

</script>