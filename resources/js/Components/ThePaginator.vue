<template>
    <div class="w-full py-2 px-4 mb-4" v-if="links && pageList.length > 1">
        <div class="flex justify-end items-center gap-2">
            <span v-if="prevUrl" @click="getThisPage(prevUrl)" class="px-3 hover:bg-gray-100 rounded-md" role="button">
                <IconChevronLeft />
            </span>
            <span v-for="item in pageList" @click="getThisPage(item.url)" class="px-3 rounded-md"
                :class="{ 'bg-primary text-basic': item.active, 'hover:bg-indigo-50': !item.active }" role="button">
                {{ item.label }}
            </span>
            <button v-if="nextUrl" @click="getThisPage(nextUrl)" class="px-3 hover:bg-gray-100 rounded-md" type="button">
                <IconChevronRight />
            </button>
        </div>
    </div>
</template>

<script setup>
import { router } from "@inertiajs/vue3";
import { computed } from "vue";
import { IconChevronLeft, IconChevronRight } from "@tabler/icons-vue";

const props = defineProps({
    links: {
        type: Object,
        required: false
    }
});

const prevUrl = computed(() => {
    return props.links[0].url;
});

const nextUrl = computed(() => {
    return props.links[props.links.length - 1].url;
});

const pageList = computed(() => {
    return props.links.slice(1, props.links.length - 1);
});

function getThisPage(url) {
    router.get(url, {}, {
        preserveState: true,
        preserveScroll: true
    });
}

</script>
