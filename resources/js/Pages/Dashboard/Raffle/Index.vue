<template>
    <AppLayout title="Raffles" :breads="breads">

        <template #header>
            <span class="title">
                Raffles
            </span>
            <AddButton @click="openModal = true" />
        </template>

        <div class="grid grid-cols-4 gap-4">
            <div class="w-full bg-white border border-gray-200 rounded-lg" v-for="(raffle, index) in raffles">
                <div class="">
                    <img class="object-contain h-48 w-48 rounded-t-lg mx-auto" :src="getImageSrc(raffle.image)" alt="" />
                </div>
                <div class="p-5">
                    <div class="flex items-center mb-4 gap-2">
                        <h5 class="text-2xl font-bold tracking-tight text-gray-900">
                            {{ raffle.name }}
                        </h5>
                        <IconEdit @click="edit(raffle)" role="button" />
                    </div>
                    <span v-if="raffle.fields.date" class="badge-blue me-2">
                        Date
                    </span>
                    <span v-if="raffle.fields.number" class="badge-blue me-2">
                        {{ raffle.fields.number }} numbers
                    </span>
                    <span v-if="raffle.fields.super_x" class="badge-blue me-2">
                        Super X
                    </span>
                </div>
            </div>
        </div>

        <FormModal :show="openModal" title="Add" @onCancel="resetValues" @onSubmit="onSubmit">
            <InputForm text="Name" v-model="form.name" />
            <InputForm text="Image" v-model="form.image" type="url" />
            <Checkbox v-model:checked="form.fields.super_x" text="Super X" />
            <Checkbox v-model:checked="form.fields.date" text="Date" />
            <InputForm text="Digits" v-model="form.fields.number" type="number" :disabled="disabled" />

            <p class="text-sm text-red-600 mt-1" v-if="$page.props.errors['fields']">
                {{ $page.props.errors['fields'] }}
            </p>

        </FormModal>

    </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { IconEdit, IconTrash } from '@tabler/icons-vue';
import AddButton from '@/Components/Buttons/AddButton.vue';
import FormModal from '@/Components/Modal/FormModal.vue';
import InputForm from '@/Components/Form/InputForm.vue';
import { ref, reactive, watch } from 'vue';
import { useForm } from '@inertiajs/vue3';
import { toast } from '@/Use/toast';
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

const disabled = ref(false);

const form = useForm({
    id: '',
    name: '',
    image: '',
    fields: reactive({
        date: false,
        number: 2,
        super_x: false,
    }),
});

watch(() => form.fields.date, (value) => {
    if (value) {
        form.fields.number = 4;
        disabled.value = true;
    } else {
        disabled.value = false;
    }
});

const openModal = ref(false);
const isNew = ref(true);

function edit(raffle) {
    form.id = raffle.id;
    form.name = raffle.name;
    form.image = raffle.image;
    form.fields = raffle.fields;
    openModal.value = true;
    isNew.value = false;
}

function onSubmit() {
    if (isNew.value) {
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
    } else {
        form
            .transform(data => ({
                ...data,
                fields: JSON.stringify(data.fields),
            }))
            .put(route('dashboard.raffles.update', form.id), {
                preserveScroll: true,
                preserveState: true,
                onSuccess: () => {
                    toast.success('Raffle updated successfully');
                    openModal.value = false;
                },
            });
    }

}

function getImageSrc(value) {
    if (value) {
        return value;
    }

    return "https://media.istockphoto.com/id/1211282980/es/vector/ganadores-afortunados-girando-tambor-de-la-rifa.jpg?s=612x612&w=0&k=20&c=1jJPxjaVHqPFA_DQGDV3QEBQ6_C3pbhjs8Ies2kR-44="
}

function resetValues() {
    form.name = '';
    form.fields.date = false;
    form.fields.number = 2;
    form.fields.super_x = false;
    openModal.value = false;
    isNew.value = true;
}

</script>