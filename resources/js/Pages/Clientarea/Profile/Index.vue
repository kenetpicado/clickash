<template>
    <ClientareaLayout title="Perfil">
        <template #header>
            <span class="title">
                Perfil
            </span>
        </template>

        <div class="bg-gray-100 p-4 rounded-xl flex flex-col items-center gap-2 mb-4" v-if="profile">
            <img :src="AvatarUrl(profile.name)" class="w-20 h-20 object-cover rounded-full" alt="">
            <span class="font-bold text-xl">{{ profile.name }}</span>
            <span class="text-sm text-gray-400">{{ profile.role == 'owner' ? 'Administrador' : 'Vendedor' }}</span>
        </div>
        <div class="flex justify-between items-center mb-4">
            <span>Información</span>
            <button v-if="!isEdit" @click="isEdit = true" type="button" class="primary-button">Editar</button>
        </div>
        <template v-if="!isEdit">
            <div class="mb-4" v-if="profile">
                <div class="flex items-center gap-4 mb-4">
                    <span class="text-gray-400">
                        <IconList class="text-primary" />
                    </span>
                    <div class="flex flex-col">
                        <span>Compañia</span>
                        <span class="text-gray-400">{{ profile.company_name ?? 'N/A' }}</span>
                    </div>
                </div>
                <div class="flex items-center gap-4 mb-4">
                    <span class="text-gray-400">
                        <IconRecordMail class="text-primary" />
                    </span>
                    <div class="flex flex-col">
                        <span>Correo</span>
                        <span class="text-gray-400">{{ profile.email }}</span>
                    </div>
                </div>
                <div class="flex items-center gap-4 mb-4">
                    <span class="text-gray-400">
                        <IconUsers class="text-primary" />
                    </span>
                    <div class="flex flex-col">
                        <span>Vendedores</span>
                        <span class="text-gray-400">{{ profile.sellers_count ?? 0 }} / {{ profile.sellers_limit }}</span>
                    </div>
                </div>
            </div>
        </template>
        <div v-else>
            <form @submit.prevent="updateProfile(() => isEdit = false)" class="mb-8">
                <InputForm text="Nombre" v-model="form.name" required />
                <InputForm text="Compañia" v-model="form.company_name" required />
                <InputForm text="Correo" v-model="form.email" type="email" required />
                <div class="flex items-center gap-4 justify-end">
                    <button type="button" @click="isEdit = false" class="secondary-button">Cancelar</button>
                    <button class="primary-button">
                        Guardar
                    </button>
                </div>
            </form>
        </div>
    </ClientareaLayout>
</template>

<script setup>
import ClientareaLayout from '@/Layouts/ClientareaLayout.vue';
import { IconUsers } from '@tabler/icons-vue';
import { IconRecordMail } from '@tabler/icons-vue';
import { IconList } from '@tabler/icons-vue';
import { onMounted, ref } from 'vue';
import InputForm from '@/Components/Form/InputForm.vue';
import AvatarUrl from '@/Use/profile.js';
import { useAuth } from '@/Composables/useAuth.js';

const isEdit = ref(false);
const { getProfile, profile, updateProfile, form } = useAuth();

onMounted(() => {
    getProfile();
});

</script>
