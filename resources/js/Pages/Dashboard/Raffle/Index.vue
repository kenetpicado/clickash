<template>
    <AppLayout title="Raffles" :breads="breads">

        <template #header>
            <span class="title">
                Raffles
            </span>
            <AddButton @click="openModal = true" />
        </template>

        <div class="grid grid-cols-4 gap-4">
            <div class="w-full bg-white border border-gray-200 rounded-lg"
                v-for="(raffle, index) in raffles">
                <div class="">
                    <img class="object-contain h-48 w-48 rounded-t-lg mx-auto"
                        src="https://media.istockphoto.com/id/1211282980/es/vector/ganadores-afortunados-girando-tambor-de-la-rifa.jpg?s=612x612&w=0&k=20&c=1jJPxjaVHqPFA_DQGDV3QEBQ6_C3pbhjs8Ies2kR-44="
                        alt="" />
                </div>
                <div class="p-5">
                    <a href="#">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">
                            {{ raffle.name }}
                        </h5>
                    </a>
                    <span v-if="raffle.fields.date" class="badge-blue me-2">
                        Date
                    </span>
                    <span v-if="raffle.fields.digits" class="badge-blue me-2">
                        {{ raffle.fields.digits }} digits
                    </span>
                    <span v-if="raffle.fields.super_x" class="badge-blue me-2">
                        Super X
                    </span>
                </div>
            </div>
        </div>

        <FormModal :show="openModal" title="Add" @onCancel="openModal = false" @onSubmit="onSubmit">
            <InputForm text="Name" v-model="form.name" />
            <Checkbox v-model:checked="form.fields.super_x" text="Super X" />
            <Checkbox v-model:checked="form.fields.date" text="Date" />
            <InputForm text="Digits" v-model="form.fields.digits" type="number" />

            <p class="text-sm text-red-600 mt-1" v-if="$page.props.errors['fields']">
                {{ $page.props.errors['fields'] }}
            </p>

        </FormModal>

    </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import TableSection from '@/Components/TableSection.vue';
import { IconPencil, IconTrash } from '@tabler/icons-vue';
import AddButton from '@/Components/Buttons/AddButton.vue';
import FormModal from '@/Components/Modal/FormModal.vue';
import InputForm from '@/Components/Form/InputForm.vue';
import { ref, reactive } from 'vue';
import { useForm } from '@inertiajs/vue3';
import { toast } from '@/Use/toast';
import { confirmAlert } from '@/Use/helpers';
import Checkbox from '@/Components/Form/Checkbox.vue';

defineProps({
    raffles: {
        type: Object,
        required: true,
    }
});

const breads = [
    {
        name: 'Home',
        route: route('dashboard.raffles.index'),
    },
    {
        name: 'Raffles',
        route: route('dashboard.raffles.index'),
    },
];

const form = useForm({
    name: '',
    fields: reactive({
        date: false,
        digits: 1,
        super_x: false,
    }),
});

const openModal = ref(false);

function edit(user) {
    form.id = user.id;
    form.name = user.name;
    form.email = user.email;
    openModal.value = true;
}

function onSubmit() {
    form
        .transform(data => ({
            ...data,
            fields: JSON.stringify(data.fields),
        }))
        .post(route('dashboard.raffles.store'), {
            preserveScroll: true,
            preserveState: true,
            onSuccess: () => {
                toast.success('Raffle created successfully');
                openModal.value = false;
            },
        });
}

function destroy(id) {
    confirmAlert({
        message: 'Are you sure you want to delete this raffle?',
        onConfirm: () => {
            form.delete(route('dashboard.raffles.destroy', id), {
                preserveScroll: true,
                preserveState: true,
                onSuccess: () => {
                    toast.success('Raffle deleted successfully');
                },
            });
        },
    })
}

</script>