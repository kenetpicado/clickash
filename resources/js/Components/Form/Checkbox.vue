<script setup>
import { computed } from 'vue';

const emit = defineEmits(['update:checked']);

const props = defineProps({
    checked: {
        type: [Array, Boolean],
        default: false,
    },
    value: {
        type: String,
        default: null,
    },
    text: {
        type: String,
        default: '',
    },
});

const proxyChecked = computed({
    get() {
        return props.checked;
    },

    set(val) {
        emit('update:checked', val);
    },
});
</script>


<template>
    <div class="block mb-4">
        <label>
            <input v-model="proxyChecked" type="checkbox" :value="value"
                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">

            <span class="ml-2 text-sm text-gray-600">{{ text }}</span>
        </label>
    </div>
</template>
