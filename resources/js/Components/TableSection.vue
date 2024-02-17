<template>
    <div class="mt-2 mb-3 text-basic">
        <slot name="description" />
    </div>
    <div class="bg-white rounded-lg m-0">
        <table class="w-full bg-white text-left text-sm text-gray-600">
            <thead class="bg-gray-50">
                <tr>
                    <slot name="header" />
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 border-t border-gray-100">
                <slot name="body" />
            </tbody>
            <slot name="footer" />
        </table>
        <slot name="paginator" />
    </div>
</template>

<script setup>

</script>