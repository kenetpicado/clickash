<template>
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div v-for="i in sellers" class="bg-card rounded-xl p-2 w-full">
            <div class="flex gap-2 w-full">
                <div class="bg-white rounded-xl w-1/3 px-1">
                    <img src="/games.png" alt="" class="w-20 h-20">
                </div>
                <div class="text-xs text-gray-600 w-full h-full">
                    <div class="flex justify-between w-full">
                        <span class="text-primary">
                            {{ i.status == 'enabled' ? 'Activo' : 'Inactivo' }}
                        </span>
                        <Menu as="div" class="relative inline-block text-left">

                            <MenuButton>
                                <IconList class="text-primary" />
                            </MenuButton>

                            <transition enter-active-class="transition duration-100 ease-out"
                                enter-from-class="transform scale-95 opacity-0"
                                enter-to-class="transform scale-100 opacity-100"
                                leave-active-class="transition duration-75 ease-in"
                                leave-from-class="transform scale-100 opacity-100"
                                leave-to-class="transform scale-95 opacity-0">
                                <MenuItems
                                    class="absolute z-10 right-0 mt-2 w-56 origin-top-right divide-y divide-gray-100 rounded-md bg-white shadow-lg ring-1 ring-black/5 focus:outline-none">
                                    <div class="px-1 py-1">
                                        <MenuItem v-slot="{ active }">
                                        <Link  :href="route('clientarea.sellers.show', i.id)"
                                            :class="[active ? 'bg-primary text-white' : 'text-gray-800', 'group flex w-full items-center rounded-md px-2 py-2 text-sm']">
                                            <IconEyeDollar class="mr-2 h-5 w-5 text-primary" />
                                            Ventas
                                        </Link>
                                        </MenuItem>
                                        <MenuItem v-slot="{ active }">
                                        <Link :href="route('clientarea.sellers.balance', i.id)"
                                            :class="[active ? 'bg-primary text-white' : 'text-gray-800', 'group flex w-full items-center rounded-md px-2 py-2 text-sm']">
                                            <IconReportAnalytics class="mr-2 h-5 w-5 text-primary" />
                                            Caja
                                        </Link>
                                        </MenuItem>
                                    </div>
                                    <div class="px-1 py-1">
                                        <MenuItem v-slot="{ active }">
                                        <button @click="edit(i)"
                                            :class="[active ? 'bg-primary text-white' : 'text-gray-800', 'group flex w-full items-center rounded-md px-2 py-2 text-sm']">
                                            <IconEdit class="mr-2 h-5 w-5 text-primary" />
                                            Editar
                                        </button>
                                        </MenuItem>
                                        <MenuItem v-slot="{ active }">
                                        <button @click="blockSeller(i.id)"
                                            :class="[active ? 'bg-primary text-white' : 'text-gray-800', 'group flex w-full items-center rounded-md px-2 py-2 text-sm']">
                                            <IconLock class="mr-2 h-5 w-5 text-primary" />
                                            Bloquear
                                        </button>
                                        </MenuItem>
                                        <MenuItem v-slot="{ active }">
                                        <button @click="destroy(i.id)"
                                            :class="[active ? 'bg-primary text-white' : 'text-gray-800', 'group flex w-full items-center rounded-md px-2 py-2 text-sm']">
                                            <IconTrash class="mr-2 h-5 w-5 text-primary" />
                                            Eliminar
                                        </button>
                                        </MenuItem>
                                    </div>
                                </MenuItems>
                            </transition>
                        </Menu>
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
import { Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue';
import { IconEdit, IconEyeDollar, IconList, IconLock, IconReportAnalytics, IconTrash } from '@tabler/icons-vue';
import FormModal from './Modal/FormModal.vue';
import InputForm from './Form/InputForm.vue';
import { ref, watch } from 'vue';
import { Link } from '@inertiajs/vue3';

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

</script>