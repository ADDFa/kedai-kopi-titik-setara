import "./pages/product"
import "./pages/menu"
import { Confirm, Toast } from "./functions/sweet-alert"

if (document.getElementById("message")) {
    const messageElement = document.getElementById("message")
    const { icon } = messageElement.dataset

    Toast.fire({
        icon: icon || "success",
        text: messageElement.textContent
    })
}

if (document.querySelector(`[data-action="confirm"]`)) {
    const buttons = document.querySelectorAll(`[data-action="confirm"]`)

    const handler = (ev) => {
        const { target } = ev.currentTarget.dataset

        Confirm.fire().then((result) => {
            if (!result.isConfirmed) return

            // form
            const form = document.createElement("form")
            form.style.display = "none"
            form.action = target
            form.method = "POST"

            // input method
            const method = document.createElement("input")
            method.name = "_method"
            method.value = "DELETE"

            // submit button
            const submit = document.createElement("button")
            submit.type = "submit"

            // append childs
            form.append(method, submit)

            // append to page
            document.body.appendChild(form)

            // send
            form.submit()
        })
    }

    buttons.forEach((btn) => {
        btn.addEventListener("click", handler)
    })
}
