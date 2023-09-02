<template>
    <div class="bg-white h-20 rounded-xl">
        <div class="flex items-center h-full p-4 gap-3">
            <span class="bg-indigo-50 rounded-full p-2">
                <component :is="stat.icon ?? DEFAULT_ICON" size="30" class="text-indigo-600"/>
            </span>
            <div>
                <div class="font-bold text-lg">
                    {{ stat.value }}
                </div>
                <div class="text-sm text-gray-600">
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