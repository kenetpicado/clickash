import Swal from "sweetalert2";

export function getAvatarUrl(name) {
    return `https://ui-avatars.com/api/?name=${encodeURIComponent(name)}&rounded=true&size=256&background=eef2ff&color=4f46e5`;
}

export function confirmAlert({ message, onConfirm, title = "Confirm" }) {
    Swal.fire({
        icon: "info",
        iconColor: "#4f46e5",
        title: title,
        text: message,
        showCancelButton: true,
        confirmButtonText: "Ok",
        confirmButtonColor: "#4f46e5",
    }).then((result) => {
        if (result.isConfirmed) {
            onConfirm();
        }
    });
}