<template>
    <ClientareaLayout title="Perfil">
        <template #header>
            <span class="title">
                Mi perfil
            </span>
        </template>
        <div class="bg-card p-4 rounded-xl flex flex-col items-center gap-2 mb-4">
            <img src="/profile.png" class="w-20 h-20 object-cover rounded-full" alt="">
            <span class="font-bold text-xl">{{ user.name }}</span>
            <span class="text-sm text-gray-400">{{ user.role == 'owner' ? 'Administrador' : 'Vendedor' }}</span>
        </div>
        <div class="flex justify-between items-center mb-4">
            <span>Información de la cuenta</span>
            <button v-if="!isEdit" @click="isEdit = true" type="button" class="simple-button">Editar</button>
            <button v-else @click="isEdit = false" type="button" class="simple-button">Cancelar</button>
        </div>
        <template v-if="!isEdit">
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
            <button @click="logout" type="button" class="secondary-button w-full">
                Cerrar sesión
            </button>
        </template>
        <div v-else>
            <form @submit.prevent="onSubmit">
                <InputForm text="Nombre" v-model="form.name" required />
                <InputForm text="Correo" v-model="form.email" type="email" required />
                <InputForm text="Nombre de la empresa" v-model="form.company_name" required />
                <button class="primary-button w-full">
                    Guardar
                </button>
            </form>
        </div>
    </ClientareaLayout>
</template>

<script setup>
import ClientareaLayout from '@/Layouts/ClientareaLayout.vue';
import { IconUsers } from '@tabler/icons-vue';
import { IconRecordMail } from '@tabler/icons-vue';
import { IconList } from '@tabler/icons-vue';
import { useAuth } from '@/Composables/useAuth.js';
import { ref } from 'vue';
import { defineProps } from 'vue';
import { useForm } from '@inertiajs/vue3';
import InputForm from '@/Components/Form/InputForm.vue';
import { toast } from '@/Use/toast';

const props = defineProps({
    user: {
        type: Object,
        required: true,
    },
});

const { logout } = useAuth();
const isEdit = ref(false);

const form = useForm({
    id: props.user.id,
    name: props.user.name,
    email: props.user.email,
    company_name: props.user.company_name,
});

function onSubmit() {
    form.put(route('profile.update', form.id), {
        preserveScroll: true,
        preserveState: true,
        onSuccess: () => {
            toast.success('Perfil actualizado correctamente');
        },
    });
}

</script>