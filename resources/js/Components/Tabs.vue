<template>
    <ul class="flex flex-nowrap text-sm font-medium text-center text-gray-500 border-b border-gray-200 mb-2 w-full">
        <li class="me-2" role="button" v-for="item in items">
            <Link :href="item.route" :class="getClass(item.route)">
            {{ item.name }}
            </Link>
        </li>
    </ul>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';

const items = [
    {
        name: 'Rifas',
        route: route('clientarea.index'),
    },
    {
        name: 'Resultados',
        route: route('clientarea.results.index'),
    },
    {
        name: 'Vendedores',
        route: route('clientarea.sellers.index'),
    },
    {
        name: 'Transacciones',
        route: route('clientarea.transactions.index'),
    },
];

function getClass(fullRoute) {
    return window.location.href == fullRoute
        ? 'active-tab'
        : 'inactive-tab';
}

</script>
