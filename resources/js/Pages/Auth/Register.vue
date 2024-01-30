<script setup>
import { Head, useForm, Link } from '@inertiajs/vue3';
import InputForm from '@/Components/Form/InputForm.vue';

const form = useForm({
    name: '',
    email: '',
    company_name: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    if (form.password !== form.password_confirmation) {
        alert('Las contraseñas no coinciden');
        return;
    }

    form.post(route('register.store'));
};

</script>

<template>
    <Head title="Crear cuenta" />

    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-white px-4 lg:px-0">

        <img class="mx-auto h-16 w-auto" src="/logo1x1.png" alt="Workflow" />

        <div class="w-full sm:max-w-md mt-6 px-6 py-8 bg-card shadow-md overflow-hidden rounded-xl">
            <h2 class="mt-4 text-center text-lg font-extrabold text-basic">
                Crear cuenta
            </h2>

            <form @submit.prevent="submit" class="mb-6">
                <InputForm text="Nombre" v-model="form.name" required autofocus />
                <InputForm text="Correo" v-model="form.email" type="email" required />
                <InputForm text="Nombre de la compañia" v-model="form.company_name" required />
                <InputForm text="Contraseña" v-model="form.password" type="password" required />
                <InputForm text="Confirmar contraseña" v-model="form.password_confirmation" type="password" required />

                <button type="submit" class="w-full primary-button">
                    Crear cuenta
                </button>
            </form>

            ¿Ya tienes cuenta?
            <Link :href="route('login')" class="text-primary font-medium">
            Inicia sesión
            </Link>
        </div>
    </div>
</template>
