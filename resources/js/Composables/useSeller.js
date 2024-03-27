import { toast } from "@/Use/toast";
import { confirmAlert } from "@/Use/helpers";
import axios from "axios";
import { reactive, ref } from "vue";

export function useSeller() {
    const sellers = ref([]);

    const defaultValues = {
        id: "",
        name: "",
        email: " ",
        password: "",
        password_confirmation: "",
    };

    const form = reactive({ ...defaultValues });

    async function getSellers() {
        axios
            .get(route("api.sellers.index"))
            .then((response) => {
                sellers.value = response.data.data;
            })
            .catch((err) => {
                toast.error(getErrorMessage(err));
            });
    }

    function store(onDone = null) {
        if (form.password !== form.password_confirmation) {
            toast.error("Las contraseñas no coinciden");
            return;
        }

        axios
            .post(route("api.sellers.store"), form)
            .then(() => {
                getSellers();
                toast.success("Guardado correctamente");
                if (onDone) onDone();
            })
            .catch((err) => {
                toast.error(getErrorMessage(err));
            });
    }

    function update(onDone = null) {
        axios
            .put(route("api.sellers.update", form.id), form)
            .then(() => {
                getSellers();
                toast.success("Actualizado correctamente");
                if (onDone) onDone();
            })
            .catch((err) => {
                toast.error(getErrorMessage(err));
            });
    }

    function toggleStatus(id) {
        axios
            .put(route("api.toggle-status", id))
            .then(() => {
                getSellers();
                toast.success("Actualizado correctamente");
            })
            .catch((err) => {
                toast.error(getErrorMessage(err));
            });
    }

    function destroy(id) {
        confirmAlert({
            message: "¿Está seguro de eliminar este registro?",
            onConfirm: () => {
                axios
                    .delete(route("api.sellers.destroy", id))
                    .then(() => {
                        sellers.value = sellers.value.filter(
                            (seller) => seller.id !== id
                        );
                        toast.success("Eliminado correctamente");
                    })
                    .catch((err) => {
                        toast.error(getErrorMessage(err));
                    });
            },
        });
    }

    function getErrorMessage(err) {
        return err.response?.data?.message ?? err.message;
    }

    function resetForm() {
        Object.assign(form, defaultValues);
    }

    return {
        form,
        store,
        update,
        destroy,
        toggleStatus,
        sellers,
        getSellers,
        resetForm,
    };
}
