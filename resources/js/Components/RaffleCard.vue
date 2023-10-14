<template>
    <div class="w-full bg-white border border-gray-200 rounded-lg">
        <div class="">
            <img class="object-contain h-48 w-48 rounded-t-lg mx-auto" :src="getImageSrc(raffle.image)" alt="" />
        </div>
        <div class="p-5">
            <div class="flex items-center mb-4 gap-2">
                <h5 class="text-2xl font-bold tracking-tight text-gray-900">
                    {{ raffle.name }}
                </h5>
                <IconEdit v-if="canEdit" @click="$emit('onEdit', raffle)" role="button" />
            </div>
            <div class="flex items-center justify-between">
                <div>
                    <span v-if="raffle.fields.date" class="badge-primary me-2">
                        Date
                    </span>
                    <span v-if="raffle.fields.number" class="badge-primary me-2">
                        {{ raffle.fields.number }} numbers
                    </span>
                    <span v-if="raffle.fields.super_x" class="badge-primary me-2">
                        Super X
                    </span>
                </div>
                <div v-if="canDestroy">
                    <IconTrash @click="$emit('onRemove', raffle.id)" role="button"/>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { IconEdit, IconTrash } from '@tabler/icons-vue';

const props = defineProps({
    raffle: {
        type: Object,
        required: true,
    },
    canEdit: {
        type: Boolean,
        default: true,
    },
    canDestroy: {
        type: Boolean,
        default: true,
    }
});

function getImageSrc(value) {
    if (value) {
        return value;
    }

    return "https://media.istockphoto.com/id/1211282980/es/vector/ganadores-afortunados-girando-tambor-de-la-rifa.jpg?s=612x612&w=0&k=20&c=1jJPxjaVHqPFA_DQGDV3QEBQ6_C3pbhjs8Ies2kR-44="
}

</script>