import {  router } from "@inertiajs/vue3";

export function useAuth() {
    function logout() {
        router.post(route("logout"));
    }

    return { logout };
}
