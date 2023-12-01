<template>
    <div class="w-full py-2 px-4 mb-4" v-if="links && pageList.length > 1">
        <div class="flex justify-center items-center gap-2">
            <span v-for="item in pageList" @click="getThisPage(item.url)" class="px-3 rounded-md border-2 border-primary"
                :class="{ 'bg-primary text-white': item.active, 'hover:bg-card': !item.active }" role="button">
                {{ item.label }}
            </span>
        </div>
    </div>
</template>

<script setup>
import { router } from "@inertiajs/vue3";
import { computed } from "vue";

const props = defineProps({
    links: {
        type: Object,
        required: false
    }
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
