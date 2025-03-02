import { Toast } from "./functions/sweet-alert"

const messageElement = document.getElementById("message")
if (messageElement) {
    const { icon } = messageElement.dataset

    Toast.fire({
        icon: icon || "success",
        text: messageElement.textContent
    })
}
