<template>
    <ClientareaLayout title="Perfil">
        <template #header>
            <span class="title">
                Mi Perfil
            </span>
        </template>
        <div class="bg-card p-4 rounded-xl flex flex-col items-center gap-2 mb-4">
            <img src="/profile.png" class="w-20 h-20 object-cover rounded-full" alt="">
            <span class="font-bold text-xl">{{ user.name }}</span>
            <span class="text-sm text-gray-400">{{ user.role == 'owner' ? 'Administrador' : 'Vendedor' }}</span>
        </div>
        <div class="flex justify-between items-center mb-4">
            <span>Información de la cuenta</span>
            <button type="button" class="simple-button">Editar</button>
        </div>
        <div class="mb-4">
            <div class="flex items-center gap-4 mb-4">
                <span class="text-gray-400">
                    <IconList class="text-primary" />
                </span>
                <div class="flex flex-col">
                    <span>Nombre de la compañía</span>
                    <span class="text-gray-400">{{ user.company_name ?? 'N/A' }}</span>
                </div>
            </div>
            <div class="flex items-center gap-4 mb-4">
                <span class="text-gray-400">
                    <IconRecordMail class="text-primary" />
                </span>
                <div class="flex flex-col">
                    <span>Correo</span>
                    <span class="text-gray-400">{{ user.email }}</span>
                </div>
            </div>
            <div class="flex items-center gap-4 mb-4">
                <span class="text-gray-400">
                    <IconUsers class="text-primary" />
                </span>
                <div class="flex flex-col">
                    <span>Vendedores</span>
                    <span class="text-gray-400">{{ user.sellers_count ?? 0 }} / {{ user.sellers_limit }}</span>
                </div>
            </div>
        </div>
        <button @click="logout" type="button" class="bg-primary rounded-xl px-4 py-2 w-full text-gray-600">
            Cerrar sesión
        </button>
    </ClientareaLayout>
</template>

<script setup>
import ClientareaLayout from '@/Layouts/ClientareaLayout.vue';
import { IconUsers } from '@tabler/icons-vue';
import { IconRecordMail } from '@tabler/icons-vue';
import { IconList } from '@tabler/icons-vue';
import { useAuth } from '@/Composables/useAuth.js';

const props = defineProps({
    user: {
        type: Object,
        required: true,
    },
});

const { logout } = useAuth();

</script>