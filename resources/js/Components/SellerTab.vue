<template>
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div v-for="i in sellers" class="bg-card rounded-xl p-2 w-full">
            <div class="flex gap-2 w-full">
                <div class="bg-white rounded-xl w-1/3 px-1">
                    <img src="/images/vendedor.png" alt="" class="w-20 h-20 object-contain">
                </div>
                <div class="text-xs text-gray-600 w-full h-full">
                    <div class="flex justify-between w-full">
                        <span class="">
                            {{ i.status == 'enabled' ? 'Activo' : 'Inactivo' }}
                        </span>

                        <Dropdown>
                            <div class="px-1 py-1">
                                <DropdownItem :href="route('clientarea.sellers.show', i.id)" title="Ventas"
                                    :icon="IconEyeDollar" />
                                <DropdownItem :href="route('clientarea.sellers.archings.index', i.id)" title="Caja"
                                    :icon="IconBox" />
                                <DropdownItem :href="route('clientarea.sellers.reports.index', i.id)" title="Reportes"
                                    :icon="IconReportAnalytics" />
                            </div>
                            <div class="px-1 py-1">
                                <DropdownItem @click="edit(i)" title="Editar" :icon="IconEdit" />
                                <DropdownItem @click="blockSeller(i.id)" :title="status[i.status]" :icon="IconLock" />
                                <DropdownItem @click="destroy(i.id)" title="Eliminar" :icon="IconTrash" />
                            </div>
                        </Dropdown>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-base">{{ i.name }}</span>
                        <span>{{ i.email }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <FormModal :show="openModal" title="Vendedor" @onCancel="resetValues" @onSubmit="onSubmit">
        <InputForm text="Nombre" v-model="form.name" required />
        <InputForm text="Correo" v-model="form.email" type="email" required autocomple="nope" />
        <template v-if="isNew">
            <InputForm text="Contraseña" v-model="form.password" type="password" required />
            <InputForm text="Confirmar contraseña" v-model="form.password_confirmation" type="password" required />
        </template>
    </FormModal>
</template>

<script setup>
import { useSeller } from '@/Composables/useSeller';
import { IconEdit, IconEyeDollar, IconLock, IconReportAnalytics, IconTrash, IconBox } from '@tabler/icons-vue';
import FormModal from './Modal/FormModal.vue';
import InputForm from './Form/InputForm.vue';
import { ref, watch } from 'vue';
import DropdownItem from './DropdownItem.vue';
import Dropdown from './Dropdown.vue';

const props = defineProps({
    sellers: {
        type: Object,
        required: true
    },
    triggerNew: {
        type: Boolean,
        required: true
    }
})

const openModal = ref(false)
const isNew = ref(true)
const { store, update, form, toggleStatus, destroy } = useSeller();

const blockSeller = (id) => {
    form.id = id
    toggleStatus()
}

const onSubmit = () => {
    if (isNew.value) {
        store(resetValues);
    } else {
        update(resetValues);
    }
}

const resetValues = () => {
    form.reset()
    isNew.value = true
    openModal.value = false
}

const edit = (data) => {
    isNew.value = false
    form.id = data.id,
        form.name = data.name,
        form.email = data.email,
        openModal.value = true
}

watch(() => props.triggerNew, (value) => {
    isNew.value = true
    openModal.value = true
})

const status = {
    enabled: 'Bloquear',
    disabled: 'Desbloquear'
}

</script>