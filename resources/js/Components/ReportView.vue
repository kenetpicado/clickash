<template>
    <template v-if="sales.length > 0">
        <div class="text-lg font-bold mb-2">
            Total: C$ {{ sales.reduce((acc, item) => acc + item.total, 0).toLocaleString() }}
        </div>

        <div class="grid grid-cols-4 lg:grid-cols-8 gap-4 text-gray-600">
            <div v-for="item in sales" class="rounded-xl bg-card p-2 flex flex-col items-center justify-center">
                <div class="font-bold">
                    {{ item.digit }}
                </div>
                <small>
                    C$ {{ item.total.toLocaleString() }}
                </small>
            </div>
        </div>
    </template>
    <div v-else class="text-center text-gray-400 mt-4">
        No hay registros 😥️
    </div>
</template>

<script setup>

defineProps({
    sales: {
        type: Object,
        required: false
    }
})

</script>