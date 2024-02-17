<template>
    <div class="bg-white rounded-xl p-2 w-full">
        <div class="flex justify-between">
            <span class="pl-2">{{ title }}</span>

            <slot />
        </div>

        <div class="text-xs text-gray-600 p-2 overflow-x-auto">
            <vue-json-pretty :data="content" :showLine="false" :showDoubleQuotes="false"/>
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