export const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.onmouseenter = Swal.stopTimer
        toast.onmouseleave = Swal.resumeTimer
    }
})

export const Confirm = Swal.mixin({
    showConfirmButton: true,
    showCancelButton: true,
    confirmButtonColor: "oklch(0.637 0.237 25.331)",
    text: "Anda yakin?",
    icon: "warning"
})
