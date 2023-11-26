<template>
    <div class="bg-white text-gray-600 rounded-lg border-2 border-card">
        <form @submit.prevent="$emit('onSubmit')">
            <div class="grid grid-cols-2 gap-4 p-8">
                <slot></slot>
            </div>

            <div class="flex items-center justify-end px-4 py-3 bg-card text-right rounded-b-lg gap-4">
                <button class="secondary-button" type="button" @click="$emit('onCancel')">
                    Cancelar
                </button>
                <button type="submit" class="primary-button">
                    Guardar
                </button>
            </div>
        </form>
    </div>
</template>

<script setup>

defineProps({
    title: {
        type: String,
        default: 'Form'
    }
})

</script>