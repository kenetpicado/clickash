<template>
    <div class="w-full mb-4">
        <label class="block font-medium text-sm text-gray-700">
            {{ text }}
        </label>

        <select :required="required"
            class="border-gray-300 focus:border-primary focus:ring-primary rounded-xl shadow-sm mt-1 block w-full transition duration-300 ease-in-out"
            :value="modelValue" @input="$emit('update:modelValue', $event.target.value)">
            <slot></slot>
        </select>

        <p class="text-sm text-red-600 mt-1" v-if="$page.props.errors[keyValue]">
            {{ $page.props.errors[keyValue] }}
        </p>
    </div>
</template>

<script setup>
import {computed} from "vue";

const props = defineProps({
    text: {
        type: String, required: true
    },
    modelValue: {
        type: [String, Number], required: false
    },
    name: {
        type: String, required: false
    },
    required: {
        type: Boolean, default: false
    }
})

const keyValue = computed(() => {
    return props.name ?? format_key(props.text)
})

function format_key(string) {
    return string.toLowerCase().replace(/ /g, '_')
}

</script>

