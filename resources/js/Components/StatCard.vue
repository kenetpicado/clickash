<template>
    <div class="bg-gray-100 h-20 rounded-xl">
        <div class="flex items-center h-full p-4 gap-3">
            <span class="bg-green-pea-700 rounded-full p-2">
                <component :is="stat.icon ?? DEFAULT_ICON" size="30" class="text-white" />
            </span>
            <div class="">
                <div class="font-bold text-lg">
                    {{ stat.value }}
                </div>
                <div class="text-sm">
                    {{ stat.title }}
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { IconInfoCircle } from '@tabler/icons-vue';

const DEFAULT_ICON = IconInfoCircle;

const props = defineProps({
    stat: {
        type: Object,
        required: true,
    },
})

</script>