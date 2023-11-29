<template>
    <div class="bg-card h-20 rounded-xl">
        <div class="flex h-full items-center justify-between p-4">
            <div class="text-gray-600">
                <div class="font-bold text-lg">
                    {{ stat.value }}
                </div>
                <div class="text-sm">
                    {{ stat.title }}
                </div>
            </div>
            <div>
                <slot />
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