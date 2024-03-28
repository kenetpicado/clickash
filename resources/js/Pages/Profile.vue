<template>
    <AppLayout title="Perfil" :breads="breads">
        <template #header>
            <span class="title mt-1">
                Perfil
            </span>
        </template>

        <FormSection title="Create" @onSubmit="updateProfile(goHome)" @onCancel="goHome">
            <InputForm text="Name" v-model="form.name" required />
            <InputForm text="Email" v-model="form.email" type="email" required />
            <InputForm text="Company" v-model="form.company_name" required />
        </FormSection>
    </AppLayout>
</template>

<script setup>
import FormSection from '@/Components/Form/FormSection.vue';
import InputForm from '@/Components/Form/InputForm.vue';
import { useAuth } from '@/Composables/useAuth.js';
import AppLayout from '@/Layouts/AppLayout.vue';
import { router } from '@inertiajs/vue3';
import { onMounted } from 'vue';

const { getProfile, updateProfile, form } = useAuth();

const breads = [
    {
        name: 'Inicio',
        route: route('home'),
    },
    {
        name: 'Perfil',
        route: route('profile.index'),
    },
];

onMounted(() => {
    getProfile();
});

function goHome() {
    router.visit(route('home'));
}

</script>