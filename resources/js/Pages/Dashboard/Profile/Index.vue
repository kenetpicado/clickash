<template>
    <AppLayout title="Profile" :breads="breads">
        <template #header>
            <span class="title mt-1">
                Profile
            </span>
        </template>

        <FormSection title="Create" @onSubmit="onSubmit" @onCancel="onCancel" :isNew="false">
            <InputForm text="Name" v-model="form.name" required />
            <InputForm text="Email" v-model="form.email" type="email" required />
            <InputForm text="Password" v-model="form.password" type="password" />
            <InputForm text="Password confirmation" v-model="form.password_confirmation" type="password" />
            <div class="col-span-2 mb-2 text-end">
                <span class="text-sm text-gray-600">Leave password blank if you don't want to change it</span>
            </div>
        </FormSection>
    </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import FormSection from '@/Components/Form/FormSection.vue';
import InputForm from '@/Components/Form/InputForm.vue';
import { router, useForm } from '@inertiajs/vue3';
import { toast } from '@/Use/toast';

const breads = [
    {
        name: 'Home',
        route: route('dashboard.users.index'),
    },
    {
        name: 'Profile',
        route: route('dashboard.profile.index'),
    },
];

const props = defineProps({
    profile: {
        type: Object,
        required: true,
    },
});

const form = useForm({
    id: props.profile.id,
    name: props.profile.name,
    email: props.profile.email,
    password: '',
    password_confirmation: '',
});

function onSubmit() {
    if (form.password === '') {
        delete form.password;
        delete form.password_confirmation;
    }

    form.put(route('dashboard.profile.update', form.id), {
        preserveScroll: true,
        preserveState: true,
        onSuccess: () => {
            toast.success('Profile updated successfully');
        },
    });
}

function onCancel() {
    router.visit(route('dashboard.dashboard.index'));
}

</script>