<script setup>
import Modal from './Modal.vue';

const emit = defineEmits(['close', 'onSubmit', 'onCancel']);

defineProps({
    show: {
        type: Boolean,
        default: false,
    },
    maxWidth: {
        type: String,
        default: '2xl',
    },
    closeable: {
        type: Boolean,
        default: true,
    },
    title: {
        type: String,
        default: 'Modal',
    },
});

const close = () => {
    emit('close');
};

</script>

<template>
    <Modal :show="show" :max-width="maxWidth" :closeable="closeable" @close="close">
        <form @submit.prevent="$emit('onSubmit')">
            <div class="p-4 sm:p-6">
                <div class="text-lg font-medium text-basic">
                    {{ title }}
                </div>

                <div class="mt-4 text-gray-600">
                    <slot />
                </div>
            </div>

            <div class="flex flex-row justify-end px-6 py-4 bg-card text-right gap-4">
                <button class="secondary-button" type="button" @click="$emit('onCancel')">
                    Cancelar
                </button>
                <button type="submit" class="primary-button">
                    Guardar
                </button>
            </div>
        </form>
    </Modal>
</template>
