<script setup>
import { Head, useForm } from '@inertiajs/vue3';
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
    <Head title="Entrar" />

    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-white px-4 lg:px-0">

        <img class="mx-auto h-28 w-auto" src="logo-simple.png" alt="Workflow" />

        <div class="w-full sm:max-w-md mt-6 px-6 py-8 bg-card shadow-md overflow-hidden rounded-xl">
            <h2 class="mt-4 text-center text-lg font-extrabold text-basic">
                Inicia sesión
            </h2>
            <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
                {{ status }}
            </div>

            <form @submit.prevent="submit">
                <InputForm text="Correo" name="email" v-model="form.email" type="email" required autofocus />

                <InputForm text="Contraseña" name="password" v-model="form.password" type="password" required />

                <Checkbox v-model:checked="form.remember" text="Recordarme" />

                <button type="submit" class="bg-primary inline-flex justify-center items-center p-2 rounded-xl w-full mt-4 text-gray-600 transition select-none duration-300 transform active:scale-110">
                    Entrar
                </button>
            </form>
        </div>
    </div>
</template>
