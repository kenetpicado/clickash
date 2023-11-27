<template>
    <AppLayout title="Vendedores" :breads="breads">

        <template #header>
            <span class="title">
                Vendedores de: {{ user.name }}
            </span>
        </template>

        <TableSection>
            <template #header>
                <th>ID</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Actividad</th>
                <th>Estado</th>
            </template>

            <template #body>
                <tr v-for="(user, index) in sellers" class="hover:bg-gray-50">
                    <td>
                        {{ index + 1 }}
                    </td>
                    <td>
                        {{ user.name }}
                    </td>
                    <td>
                        {{ user.email }}
                    </td>
                    <td>
                        <span v-if="user.online == 'Now'" class="badge-primary">
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
    </AppLayout>
</template>

<script setup>
import TableSection from '@/Components/TableSection.vue';
import AppLayout from '@/Layouts/AppLayout.vue';

const props = defineProps({
    user: {
        type: Object,
        required: true,
    },
    sellers: {
        type: Object,
        required: true,
    },
});

const breads = [
    {
        name: 'Home',
        route: route('dashboard.users.index'),
    },
    {
        name: 'Usuarios',
        route: route('dashboard.users.index'),
    },
];

</script>