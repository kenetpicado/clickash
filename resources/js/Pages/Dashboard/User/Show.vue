<template>
    <AppLayout title="Users" :breads="breads">

        <template #header>
            <span class="title">
                {{ user.name }}
            </span>
        </template>

        <TableSection>
            <template #header>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Status</th>
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
                        <span :class="[user.status == 'Online' ? 'badge-green' : 'badge-red']">
                            {{ user.status }}
                        </span>
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
import AppLayout from '@/Layouts/AppLayout.vue';
import TableSection from '@/Components/TableSection.vue';

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
        name: 'Users',
        route: route('dashboard.users.index'),
    },
    {
        name: props.user.name,
        route: route('dashboard.users.show', props.user.id),
    }
];

</script>