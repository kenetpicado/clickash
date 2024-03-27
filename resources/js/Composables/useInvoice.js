import { toast } from "@/Use/toast";
import axios from "axios";
import { ref } from "vue";

export function useInvoice() {
    const invoices = ref({});

    async function getInvoices(params = {}) {
        axios
            .get(route("api.invoices.index"), {
                params,
            })
            .then((response) => {
                invoices.value = response.data;
            })
            .catch((err) => {
                toast.error(getErrorMessage(err));
            });
    }

    function getErrorMessage(err) {
        return err.response?.data?.message ?? err.message;
    }

    return {
        invoices,
        getInvoices,
    };
}
