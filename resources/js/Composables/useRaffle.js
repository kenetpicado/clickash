import { useForm } from "@inertiajs/vue3";
import { toast } from "@/Use/toast";

export function useRaffle() {
    const form = useForm({
        id: "",
        name: "",
        image: "",
        settings: {
            min: null,
            max: null,
            date: false,
            super_x: false,
            general_limit: null,
            individual_limit: null,
        },
    });

    function store(onDone = null) {
        form.post(route("dashboard.raffles.store"), {
            preserveScroll: true,
            preserveState: true,
            onSuccess: () => {
                toast.success("Raffle created successfully");
                if (onDone) onDone();
            },
        });
    }

    function update(onDone = null) {
        form.put(route("dashboard.raffles.update", form.id), {
            preserveScroll: true,
            preserveState: true,
            onSuccess: () => {
                toast.success("Raffle updated successfully");
                if (onDone) onDone();
            },
        });
    }

    return { form, store, update };
}
