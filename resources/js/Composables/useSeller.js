import { useForm } from "@inertiajs/vue3";
import { toast } from "@/Use/toast";
import { confirmAlert } from "@/Use/helpers";

export function useSeller() {
    const form = useForm({
        id: "",
        name: "",
        email: " ",
        password: "",
        password_confirmation: "",
    });

    function store(onDone = null) {
        if (form.password !== form.password_confirmation) {
            toast.error("Las contraseñas no coinciden");
            return;
        }

        form.post(route("clientarea.sellers.store"), {
            preserveScroll: true,
            preserveState: true,
            onSuccess: () => {
                toast.success("Guardado correctamente");
                if (onDone) onDone();
            },
            onError: (err) => {
                toast.error(err.message);
                if (onDone) onDone();
            },
        });
    }

    function update(onDone = null) {
        form.put(route("clientarea.sellers.update", form.id), {
            preserveScroll: true,
            preserveState: true,
            onSuccess: () => {
                toast.success("Actualizado correctamente");
                if (onDone) onDone();
            }
        });
    }

    function toggleStatus(onDone = null) {
        form.put(route("clientarea.toggle-status", form.id), {
            preserveScroll: true,
            preserveState: true,
            onSuccess: () => {
                toast.success("Actualizado correctamente");
                if (onDone) onDone();
            }
        });
    }

    function destroy(id) {
        confirmAlert({
            message: "¿Está seguro de eliminar este registro?",
            onConfirm: () => {
                form.delete(route("clientarea.sellers.destroy", id), {
                    preserveScroll: true,
                    preserveState: true,
                    onSuccess: () => {
                        toast.success("Eliminado correctamente");
                    },
                });
            },
        });
    }

    return { form, store, update, destroy, toggleStatus };
}
