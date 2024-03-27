import { toast } from "@/Use/toast";
import axios from "axios";
import { ref } from "vue";

export function useInvoice() {
    const invoices = ref({});
    const isLoading = ref(false);

    async function getInvoices(params = {}, push = false) {
        isLoading.value = true;

        axios
            .get(route("api.invoices.index"), {
                params,
            })
            .then((response) => {
                if (push) {
                    invoices.value.data = invoices.value.data.concat(
                        response.data.data
                    );
                    invoices.value.links = response.data.links;
                } else {
                    invoices.value = response.data;
                }
            })
            .catch((err) => {
                toast.error(getErrorMessage(err));
            })
            .finally(() => {
                isLoading.value = false;
            })
    }

    function getErrorMessage(err) {
        return err.response?.data?.message ?? err.message;
    }

    return {
        invoices,
        isLoading,
        getInvoices,
    };
}
