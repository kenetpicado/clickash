import { useForm } from "@inertiajs/vue3";
import { toast } from "@/Use/toast";
import { confirmAlert } from "@/Use/helpers";

export function useUser() {
    const form = useForm({
        id: "",
        name: "",
        email: "",
        password: "",
        password_confirmation: "",
        sellers_limit: 5,
        company_name: "",
        role: "owner",
        status: "enabled",
    });

    function store(onDone = null) {
        form.post(route("dashboard.users.store"), {
            preserveScroll: true,
            preserveState: true,
            onSuccess: () => {
                toast.success("User created successfully");
                if (onDone) onDone();
            },
        });
    }

    function update(onDone = null) {
        form.put(route("dashboard.users.update", form.id), {
            preserveScroll: true,
            preserveState: true,
            onSuccess: () => {
                toast.success("User updated successfully");
                if (onDone) onDone();
            }
        });
    }

    function destroy(id) {
        confirmAlert({
            message: "Are you sure you want to delete this user?",
            onConfirm: () => {
                form.delete(route("dashboard.users.destroy", id), {
                    preserveScroll: true,
                    preserveState: true,
                    onSuccess: () => {
                        toast.success("User deleted successfully");
                    },
                });
            },
        });
    }

    return { form, store, update, destroy };
}
