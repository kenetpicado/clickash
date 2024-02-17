<template>
    <div class="bg-white rounded-xl p-2 w-full">
        <div class="flex justify-between">
            <span>{{ title }}</span>

            <slot />
        </div>

        <div class="text-xs text-gray-600">
            <pre>{{ content }}</pre>
        </div>
    </div>
</template>

<script setup>

defineProps({
    title: {
        type: String,
        required: true,
    },
    content: {
        type: Object,
        required: true,
    },
});

</script>