import Swal from "sweetalert2";

export function getAvatarUrl(name) {
    return `https://ui-avatars.com/api/?name=${encodeURIComponent(name)}&rounded=true&size=256&background=eef2ff&color=4f46e5`;
}

export function confirmAlert({ message, onConfirm, title = "Confirmar" }) {
    Swal.fire({
        icon: "info",
        iconColor: "#FFC6C5",
        title: title,
        text: message,
        showCancelButton: true,
        confirmButtonText: "Si, estoy seguro",
        confirmButtonColor: "#FFAFAE",
        cancelButtonText: "Cancelar",
    }).then((result) => {
        if (result.isConfirmed) {
            onConfirm();
        }
    });
}