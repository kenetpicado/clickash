<template>
    <MenuItem v-slot="{ active }">
    <Link v-if="href" :href="href"
        :class="[active ? 'bg-primary text-white' : 'text-gray-800', 'group flex w-full items-center rounded-md px-2 py-2 text-sm']">
    <component :is="icon" :class="[active ? 'text-white' : '', 'mr-2 h-5 w-5']" />
    {{ title }}
    </Link>
    <button v-else type="button"
        :class="[active ? 'bg-primary text-white' : 'text-gray-800', 'group flex w-full items-center rounded-md px-2 py-2 text-sm']">
        <component :is="icon" :class="[active ? 'text-white' : '', 'mr-2 h-5 w-5']" />
        {{ title }}
    </button>
    </MenuItem>
</template>

<script setup>
import { MenuItem } from '@headlessui/vue';
import { Link } from '@inertiajs/vue3';
import { IconSettings } from '@tabler/icons-vue';

const props = defineProps({
    title: {
        type: String,
        required: true
    },
    href: {
        type: String,
        required: false
    },
    icon: {
        default: IconSettings
    }
});

</script>