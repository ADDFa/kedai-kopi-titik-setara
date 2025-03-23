import { Confirm, Toast } from "./functions/sweet-alert"
import "./pages/product"
import "./pages/menu"
import "./pages/cart"
import "./pages/customer-order"

if (document.getElementById("message")) {
    const messageElement = document.getElementById("message")
    const { icon } = messageElement.dataset

    Toast.fire({
        icon: icon || "success",
        text: messageElement.textContent
    })
}

const handleConfirm = (ev) => {
    const {
        target,
        icon = "warning",
        text = "Anda yakin?"
    } = ev.currentTarget.dataset

    Confirm.fire({ icon, text }).then((result) => {
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

document.querySelectorAll(`[data-action="confirm"]`).forEach((btn) => {
    btn.addEventListener("click", handleConfirm)
})

const toggleHandlers = {
    dropdown(ev) {
        const { target } = ev.currentTarget.dataset

        const dropdownMenu = document.getElementById(target)
        dropdownMenu?.classList.toggle("show")
    }
}

const toggleButtons = document.querySelectorAll(`[data-toggle]`)

toggleButtons.forEach((btn) => {
    const handleToggleClick = (ev) => {
        const { toggle } = ev.currentTarget.dataset
        if (toggleHandlers[toggle]) toggleHandlers[toggle](ev)
    }

    btn.addEventListener("click", handleToggleClick)
})

document.addEventListener("click", (ev) => {
    toggleButtons.forEach((btn) => {
        const { toggle } = btn.dataset

        switch (toggle) {
            case "dropdown":
                const dropdownMenu = document.getElementById(btn.dataset.target)
                if (btn.contains(ev.target) || dropdownMenu.contains(ev.target))
                    return

                dropdownMenu.classList.remove("show")
                break
        }
    })
})
