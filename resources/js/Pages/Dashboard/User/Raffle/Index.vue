<template>
    <AppLayout title="Users" :breads="breads">

        <template #header>
            <span class="title">
                Raffles
            </span>
            <AddButton @click="openModal = true" />
        </template>

        <div class="grid grid-cols-4 gap-4" v-if="user.raffles.length > 0">
            <RaffleCard v-for="(raffle, index) in user.raffles" :raffle="raffle" :canEdit="false" @onRemove="destroy" />
        </div>
        <div v-else>
            No data to display
        </div>

        <FormModal :show="openModal" title="Raffles" @onCancel="resetValues" @onSubmit="onSubmit">
            <SelectForm text="Raffle" v-model="raffle" required>
                <option selected disabled value="">Select Raffle</option>
                <option v-for="raffle in raffles" :value="raffle.id">{{ raffle.name }}</option>
            </SelectForm>
        </FormModal>

    </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import TableSection from '@/Components/TableSection.vue';
import { IconPencil, IconTrash, IconEye } from '@tabler/icons-vue';
import AddButton from '@/Components/Buttons/AddButton.vue';
import FormModal from '@/Components/Modal/FormModal.vue';
import InputForm from '@/Components/Form/InputForm.vue';
import { ref } from 'vue';
import { useForm, Link, router } from '@inertiajs/vue3';
import { toast } from '@/Use/toast';
import { confirmAlert } from '@/Use/helpers';
import RaffleCard from '@/Components/RaffleCard.vue';
import SelectForm from '@/Components/Form/SelectForm.vue';

const props = defineProps({
    user: {
        type: Object,
        required: true,
    },
    raffles: {
        type: Object,
        required: true,
    }
});

const breads = [
    {
        name: 'Home',
        route: route('dashboard.users.index'),
    },
    {
        name: 'Users',
        route: route('dashboard.users.index'),
    },
    {
        name: 'Raffles',
        route: route('dashboard.users.raffles.index', props.user.id),
    }
];

const openModal = ref(false);
const raffle = ref(null);

function resetValues() {
    raffle.value = null;
    openModal.value = false;
}

function onSubmit() {
    router.post(route('dashboard.users.raffles.store', props.user.id), { raffle_id: raffle.value }, {
        onSuccess: () => {
            toast.success('Raffle added successfully');
            resetValues();
        },
    });
}

function destroy(id) {
    confirmAlert({
        message: 'Are you sure you want to delete this raffle?',
        onConfirm: () => {
            router.delete(route('dashboard.users.raffles.destroy', [props.user.id, id]), {
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