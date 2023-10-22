<template>
    <div class="w-full mb-4">
        <label class="block font-medium text-sm text-basic">
            {{ text }}
        </label>

        <input :type="type" :placeholder="placeholder" :disabled="disabled" :autofocus="autofocus" :required="required"
            :autocomplete="autocomple"
            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm mt-1 block w-full transition duration-300 ease-in-out"
            :class="[disabled ? 'bg-gray-100' : '']" :value="modelValue"
            @input="$emit('update:modelValue', $event.target.value)">

        <p class="text-sm text-red-600 mt-1" v-if="$page.props.errors[keyValue]">
            {{ $page.props.errors[keyValue] }}
        </p>
    </div>
</template>

<script setup>
import { computed } from "vue";

const props = defineProps({
    text: {
        type: String, required: true
    },
    modelValue: {
        type: [String, Number], required: false
    },
    type: {
        type: String, default: 'text'
    },
    name: {
        type: String, required: false
    },
    placeholder: {
        type: String, default: ''
    },
    disabled: {
        type: Boolean, default: false
    },
    required: {
        type: Boolean, default: false
    },
    autofocus: {
        type: Boolean, default: false
    },
    autocomple: {
        type: String, default: 'off'
    }
})

const keyValue = computed(() => {
    return props.name ?? format_key(props.text)
})

function format_key(string) {
    return string.toLowerCase().replace(/ /g, '_')
}

</script>

