<template>
    <ClientareaLayout>
        <template #header>
            <span class="title">
                Horario
            </span>
            <button type="button" class="simple-button" @click="openModal = true">
                Nuevo
            </button>
        </template>
        <div v-if="availability.length == 0" class="w-full text-center text-gray-400">
            No hay horario
        </div>
        <div v-else class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-4">
            <div v-for="a in availability" class="bg-card p-4 rounded-xl text-gray-600">
                <div class="flex justify-between items-center mb-2">
                    <span>{{ a.day }}</span>
                    <IconTrash class="text-primary" />
                </div>
                <div class="grid grid-cols-2 gap-2 mb-4">
                    <div>
                        <strong class="text-sm">Hora de inicio</strong>
                        <div>
                            {{ Carbon.create().setTime(a.start_time).getTimeFormat() }}
                        </div>
                    </div>
                    <div>
                        <strong class="text-sm">Hora de fin</strong>
                        <div>
                            {{ Carbon.create().setTime(a.end_time).getTimeFormat() }}
                        </div>
                    </div>
                </div>
                <h2 class="font-semibold mb-2 text-sm">Sorteos</h2>
                <div class="flex items-center gap-3 overflow-x-auto hide-scrollbar text-sm">
                    <div v-for="hour in a.blocked_hours" class="inline-flex items-center bg-white px-2 py-1 rounded-xl whitespace-nowrap">
                        {{ Carbon.create().setTime(hour).getTimeFormat() }}
                    </div>
                </div>
            </div>
        </div>
    </ClientareaLayout>
</template>

<script setup>
import ClientareaLayout from '@/Layouts/ClientareaLayout.vue';
import { Carbon } from '@/Use/Carbon';
import { IconTrash } from '@tabler/icons-vue';
import { defineProps, ref } from 'vue';

const props = defineProps({
    availability: {
        type: Object,
        required: true,
    },
})


const openModal = ref(false);

</script>