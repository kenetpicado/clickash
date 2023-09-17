<template>
    <AppLayout title="Users" :breads="breads">

        <template #header>
            <span class="title">
                {{ user.name }}
            </span>
        </template>

        <div class="mb-6 bg-white rounded-lg">
            <ul class="-mb-px flex items-center gap-4 text-sm font-medium">
                <li class="flex-1">
                    <span role="button" @click="selectedTab = 'sellers'" :class="getClass('sellers')">
                        Sellers</span>
                </li>
                <li class="flex-1">
                    <span role="button" @click="selectedTab = 'raffles'" :class="getClass('raffles')">
                        Raffles</span>
                </li>
            </ul>
        </div>

        <TableSection v-if="selectedTab == 'sellers'">
            <template #header>
                <th>ID</th>
                <th>Nombre</th>
                <th>Active</th>
                <th>Status</th>
            </template>

            <template #body>
                <tr v-for="(user, index) in sellers" class="hover:bg-gray-50">
                    <td>
                        {{ index + 1 }}
                    </td>
                    <td>
                        {{ user.name }}
                        <div class="text-indigo-500 mt-2">
                            {{ user.email }}
                        </div>
                    </td>
                    <td>
                        <span v-if="user.online == 'Now'" class="badge-green">
                            {{ user.online }}
                        </span>

                        <span v-else>
                            {{ user.online }}
                        </span>
                    </td>
                    <td>
                        <span class="uppercase">{{ user.status }}</span>
                    </td>
                </tr>
                <tr v-if="sellers.length == 0">
                    <td colspan="4" class="text-center">No data to display</td>
                </tr>
            </template>
        </TableSection>

        <TableSection v-if="selectedTab == 'raffles'">
            <template #header>
                <th>ID</th>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Settings</th>
                <th>Acciones</th>
            </template>

            <template #body>
                <tr v-for="(raffle, index) in raffles" class="hover:bg-gray-50">
                    <td>
                        {{ index + 1 }}
                    </td>
                    <td>
                        <img :src="getImageSrc(raffle.image)" alt="" class="w-20 h-20 object-cover rounded-lg">
                    </td>
                    <td>
                        <span class="font-bold">{{ raffle.name }}</span>
                    </td>
                    <td>
                        <pre>{{ JSON.parse(raffle.pivot.settings) }}</pre>
                    </td>
                    <td>
                        Actions
                    </td>
                </tr>
                <tr v-if="raffles.length == 0">
                    <td colspan="3" class="text-center">No data to display</td>
                </tr>
            </template>
        </TableSection>
    </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import TableSection from '@/Components/TableSection.vue';
import { ref } from 'vue';

const props = defineProps({
    user: {
        type: Object,
        required: true,
    },
    sellers: {
        type: Object,
        required: true,
    },
    raffles: {
        type: Object,
        required: true,
    }
});

const breads = [
    {
        name: 'Home',
        route: route('dashboard.users.index'),
    },
    {
        name: 'Users',
        route: route('dashboard.users.index'),
    },
    {
        name: props.user.name,
        route: route('dashboard.users.show', props.user.id),
    }
];

const selectedTab = ref('sellers');

function getClass(tab) {
    return selectedTab.value == tab
        ? 'relative flex items-center justify-center gap-2 px-1 py-3 text-indigo-600 after:absolute after:left-0 after:bottom-0 after:h-0.5 after:w-full after:bg-indigo-600 hover:text-indigo-600 rounded-lg'
        : 'flex items-center justify-center gap-2 px-1 py-3 text-gray-500 hover:text-indigo-600';
}

function getImageSrc(value) {
    if (value) {
        return value;
    }

    return "https://media.istockphoto.com/id/1211282980/es/vector/ganadores-afortunados-girando-tambor-de-la-rifa.jpg?s=612x612&w=0&k=20&c=1jJPxjaVHqPFA_DQGDV3QEBQ6_C3pbhjs8Ies2kR-44="
}

</script>

<style>
pre {
    background-color: rgb(241, 241, 241);
    padding: 1rem;
    border-radius: 1rem;
}
</style>