<template>
    <div class="h-full w-full p-4">
        <InputForm v-model="client" text="Cliente (Opcional)" />
        <hr class="mt-4 mb-4">

        <div class="grid grid-cols-1 gap-4">
            <TransitionGroup name="list" tag="div">
                <div v-for="(digit, index) in digits" :key="index" class="bg-green-pea-50 rounded-xl px-3 pt-3 mb-3">
                    <div class="grid grid-cols-2 gap-4 items-end">
                        <div>
                            <label class="block font-medium text-sm text-basic mb-1">
                                Digito
                            </label>
                            <input
                                class="border-gray-300 focus:border-green-pea-500 focus:ring-green-pea-500 rounded-lg w-full transition duration-300 ease-in-out"
                                v-model="digit.digit" type="number" />
                        </div>
                        <div>
                            <label class="block font-medium text-sm text-basic mb-1">
                                Monto
                            </label>
                            <input placeholder="C$ 0"
                                class="border-gray-300 focus:border-green-pea-500 focus:ring-green-pea-500 rounded-lg w-full transition duration-300 ease-in-out"
                                v-model="digit.amount" type="number" />
                        </div>
                        <div>
                            <label class="block font-medium text-sm text-basic mb-1">
                                Turno
                            </label>
                            <input
                                class="border-gray-300 focus:border-green-pea-500 focus:ring-green-pea-500 rounded-lg w-full transition duration-300 ease-in-out"
                                v-model="digit.turn" type="text" />
                        </div>
                        <div>
                            <label class="block font-medium text-sm text-basic mb-1">
                                Super X
                            </label>
                            <input v-model="digit.super_x" type="checkbox"
                                class="w-5 h-5 text-green-pea-500 bg-white border-gray-300 rounded focus:ring-green-pea-500 focus:ring-2 mb-2">
                        </div>
                    </div>
                    <button type="button" class="text-red-500 w-full mt-2" @click="digits.splice(index, 1)">
                        <IconTrash class="text-green-pea-300 ml-auto" />
                    </button>
                </div>
            </TransitionGroup>
        </div>

        <button type="button" class="secondary-button w-full mb-5" @click="addElement">
            Agregar digito
        </button>

        <div class="bg-green-pea-50 mb-3 p-4 rounded-xl text-lg font-bold text-center text-gray-500">
            Total: C${{ digits.reduce((acc, digit) => acc + digit.amount, 0) }}
        </div>
        <button type="button" class="primary-button w-full">
            Guardar
        </button>
    </div>
</template>

<script setup>
import InputForm from '@/Components/Form/InputForm.vue';
import { IconTrash } from '@tabler/icons-vue';
import { ref } from 'vue';

const client = ref("Jairo");

const digits = ref([
    {
        digit: null,
        amount: null,
        super_x: false
    },
]);

function addElement() {
    digits.value.push({
        digit: null,
        amount: null,
        super_x: false
    });
}

</script>


<style>
.list-move,
/* apply transition to moving elements */
.list-enter-active,
.list-leave-active {
    transition: all 0.5s ease;
}

.list-enter-from,
.list-leave-to {
    opacity: 0;
    transform: translateX(30px);
}

/* ensure leaving items are taken out of layout flow so that moving
   animations can be calculated correctly. */
.list-leave-active {
    position: absolute;
}
</style>