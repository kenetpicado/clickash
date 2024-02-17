<script setup>
import { Head, useForm, Link } from '@inertiajs/vue3';
import Checkbox from '@/Components/Form/Checkbox.vue';
import InputForm from '@/Components/Form/InputForm.vue';

defineProps({
    status: String,
    app_name: String,
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.transform(data => ({
        ...data,
        remember: form.remember ? 'on' : '',
    })).post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};

</script>

<template>
    <Head title="Inicia sesión" />
    <loading :active="form.processing" :is-full-page="true" />

    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-3 sm:pt-0 bg-white px-4 lg:px-0">

        <img class="mx-auto h-16 w-auto" src="/logo1x1.png" alt="Workflow" />

        <div class="w-full sm:max-w-md mt-6 px-6 py-8 bg-card shadow-md overflow-hidden rounded-xl">
            <h2 class="mt-4 text-center text-lg font-extrabold text-basic">
                Inicia sesión
            </h2>
            <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
                {{ status }}
            </div>

            <form @submit.prevent="submit" class="mb-6">
                <InputForm text="Correo" name="email" v-model="form.email" type="email" required autofocus />

                <InputForm text="Contraseña" name="password" v-model="form.password" type="password" required />

                <Checkbox v-model:checked="form.remember" text="Recordarme" />

                <button type="submit" class="w-full primary-button py-3">
                    Entrar
                </button>
            </form>

            <Link :href="route('register.create')" class="text-primary font-medium">
            Crear cuenta
            </Link>
        </div>

        <a href="https://play.google.com/store/apps/details?id=com.strainteam.clickashadmin" target="_blank">
            <img src="/images/gp.svg" alt="" style="width: 15rem;">
        </a>
    </div>
</template>
