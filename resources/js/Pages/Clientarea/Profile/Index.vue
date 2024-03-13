<template>
    <ClientareaLayout title="Perfil">
        <template #header>
            <span class="title">
                Perfil
            </span>
        </template>
        <div class="bg-gray-100 p-4 rounded-xl flex flex-col items-center gap-2 mb-4">
            <img :src="AvatarUrl($page.props.auth.name)" class="w-20 h-20 object-cover rounded-full" alt="">
            <span class="font-bold text-xl">{{ user.name }}</span>
            <span class="text-sm text-gray-400">{{ user.role == 'owner' ? 'Administrador' : 'Vendedor' }}</span>
        </div>
        <div class="flex justify-between items-center mb-4">
            <span>Información</span>
            <button v-if="!isEdit" @click="isEdit = true" type="button" class="primary-button">Editar</button>
        </div>
        <template v-if="!isEdit">
            <div class="mb-4">
                <div class="flex items-center gap-4 mb-4">
                    <span class="text-gray-400">
                        <IconList class="text-primary" />
                    </span>
                    <div class="flex flex-col">
                        <span>Compañia</span>
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
        </template>
        <div v-else>
            <form @submit.prevent="onSubmit" class="mb-8">
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
import { ref } from 'vue';
import { defineProps } from 'vue';
import { useForm } from '@inertiajs/vue3';
import InputForm from '@/Components/Form/InputForm.vue';
import { toast } from '@/Use/toast';
import AvatarUrl from '@/Use/profile.js';

const props = defineProps({
    user: {
        type: Object,
        required: true,
    },
});

const isEdit = ref(false);

const form = useForm({
    id: props.user.id,
    name: props.user.name,
    email: props.user.email,
    company_name: props.user.company_name,
});

function onSubmit() {
    form.put(route('clientarea.profile.update', form.id), {
        preserveScroll: true,
        preserveState: true,
        onSuccess: () => {
            toast.success('Perfil actualizado correctamente');
        },
    });
}

</script>
