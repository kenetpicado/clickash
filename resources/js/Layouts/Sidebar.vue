<template>
    <aside class="w-72 p-3 bg-white flex flex-col hidden lg:block min-h-screen">
        <div class="flex flex-col items-center my-4">
            <div class="h-14 w-14">
                <img class="h-full w-full"
                    src="https://static.vecteezy.com/system/resources/previews/015/394/284/non_2x/medical-pharmacy-logo-design-vector.jpg"
                    alt="" />
            </div>
            <h2 class="text-2xl font-extrabold text-gray-600">
                {{ $page.props.app_name }}
            </h2>
        </div>
        <ul class="space-y-2 text-gray-600">
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
                <span @click="logout" class="flex items-center px-2 py-3 rounded-lg gap-4 hover:bg-gray-100" role="button">
                    <IconLogout></IconLogout>
                    <span>Logout</span>
                </span>
            </li>
        </ul>
    </aside>
</template>

<script setup>
import { Link, router } from '@inertiajs/vue3';
import { IconHome, IconLogout, IconUsers, IconUser, IconGift } from '@tabler/icons-vue';

const DEFAULT_ICON = IconUsers;

const logout = () => {
    router.post(route('logout'));
};

const items = [
    {
        header: 'Home'
    },
    {
        name: 'Dashboard',
        route: route('dashboard.index'),
        icon: IconHome
    },
    {
        header: 'Administration'
    },
    {
        name: 'Users',
        route: route('dashboard.users.index'),
        icon: IconUsers
    },
    {
        name: 'Raffles',
        route: route('dashboard.raffles.index'),
        icon: IconGift
    },
    {
        header: 'System'
    },
    {
        name: 'Profile',
        route: route('dashboard.profile.index'),
        icon: IconUser
    },
]

function getClass(fullRoute) {
    return window.location.href == fullRoute
        ? 'bg-gray-100 font-bold'
        : 'hover:bg-gray-100';
}

</script>