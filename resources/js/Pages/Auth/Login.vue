<script setup>
import { Head, useForm, Link } from '@inertiajs/vue3';
import Checkbox from '@/Components/Form/Checkbox.vue';
import InputForm from '@/Components/Form/InputForm.vue';
import Modal from "@/Components/Modal/Modal.vue";
import { ref } from "vue";

defineProps({
    status: String,
    app_name: String,
    terms_and_conditions: Object
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const show = ref(false)

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

    <div class="min-h-screen flex justify-center items-center bg-white px-4 lg:px-0">
        <div class="w-full sm:max-w-md px-6 py-8 bg-gray-100 shadow-md overflow-hidden rounded-xl">
            <img class="mx-auto h-16 w-auto" src="/logo1x1.png" alt="Workflow" />
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

                <button type="submit" class="w-full primary-button">
                    Entrar
                </button>
            </form>

            <div class="flex justify-between text-sm">
                <Link :href="route('register.create')" class="text-green-pea-500 font-medium">
                Crear cuenta
                </Link>
                <div class="text-green-pea-500 font-medium" role="button" @click="show = true">
                    {{ terms_and_conditions.title }}
                </div>
            </div>
        </div>

        <Modal :show="show" @close="show = false">
            <div class="p-4 sm:p-6">
                <div class="text-lg font-bold">
                    {{ terms_and_conditions.title }}
                </div>

                <div class="mt-4 text-gray-600 max-h-96 overflow-y-auto">
                    <span v-html="terms_and_conditions.content" style="white-space: pre-line;"></span>
                </div>
            </div>

            <div class="flex flex-row justify-end px-6 py-4 bg-gray-100 text-right gap-4">
                <button type="submit" class="primary-button" @click="show = false">
                    Aceptar
                </button>
            </div>
        </Modal>
    </div>
</template>
