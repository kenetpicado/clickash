import { router } from "@inertiajs/vue3";
import axios from "axios";
import { ref, reactive, watch } from "vue";
import { toast } from "@/Use/toast";

export function useAuth() {
    const profile = ref(null);

    const form = reactive({
        id: null,
        name: null,
        email: null,
        company_name: null,
    });

    function logout() {
        router.post(route("logout"));
    }

    function getProfile() {
        axios
            .get(route("api.profile.index"))
            .then((response) => {
                profile.value = response.data.data;
            })
            .catch((err) => {
                console.log(err);
            });
    }

    function updateProfile(onDone = null) {
        axios
            .put(route("api.profile.update", form.id), form)
            .then((response) => {
                profile.value = response.data.data;
                toast.success("Actualizado");
                if (onDone) onDone();
            })
            .catch((err) => {
                toast.error(getErrorMessage(err));
            });
    }

    function getErrorMessage(err) {
        return err.response?.data?.message ?? err.message;
    }

    watch(profile, (value) => {
        if (value) {
            form.id = value.id;
            form.name = value.name;
            form.email = value.email;
            form.company_name = value.company_name;
        }
    });

    return { logout, getProfile, updateProfile, profile, form };
}
