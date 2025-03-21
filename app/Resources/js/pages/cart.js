import { Confirm } from "../functions/sweet-alert"

const deleteCartProductsBtn = document.querySelectorAll(
    `[data-name="delete-product-in-cart"]`
)
const addProductsBtn = document.querySelectorAll(`[data-name="add-product"]`)
const reduceProductsBtn = document.querySelectorAll(
    `[data-name="reduce-product"]`
)
const paymentMethod = document.getElementById("payment-method")

if (paymentMethod) {
    const saveHistory = (data) => {
        localStorage.setItem("_history", JSON.stringify(data))
    }

    const history = JSON.parse(localStorage.getItem("_history") || "{}")
    if (!history.hasOwnProperty("payment-method")) {
        history["payment-method"] = "cash"
    }

    paymentMethod.value = history["payment-method"]
    saveHistory(history)

    paymentMethod.addEventListener("input", (ev) => {
        history["payment-method"] = ev.currentTarget.value
        saveHistory(history)
    })
}

deleteCartProductsBtn.forEach((btn) => {
    const handleDelete = (ev) => {
        const { target } = ev.currentTarget.dataset

        Confirm.fire({
            text: "Yakin untuk menghapus data produk?"
        }).then((result) => {
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

    btn.addEventListener("click", handleDelete)
})

const updateTotal = (total) => {
    const containers = document.querySelectorAll(`[data-name="total"]`)

    containers.forEach((container) => {
        container.textContent = `Rp. ${total}`
    })
}

addProductsBtn.forEach((btn) => {
    const handleAddProduct = async (ev) => {
        const { id } = ev.currentTarget.dataset

        const productCase = document.querySelector(
            `[data-name="product-total-value-${id}"]`
        )
        if (!productCase) return

        const container = document.querySelector(
            `[data-name="user-total-product"]`
        )

        try {
            const response = await fetch(`/cart/add-product/${id}`, {
                method: "POST"
            })
            if (!response.ok) throw new Error(await response.text())

            const { qty, total } = await response.json()
            productCase.textContent = qty
            updateTotal(total)

            let cartTotal = parseInt(container.textContent)
            container.textContent = ++cartTotal
        } catch (e) {
            console.warn(e)
        }
    }

    btn.addEventListener("click", handleAddProduct)
})

reduceProductsBtn.forEach((btn) => {
    const handleReduceProduct = async (ev) => {
        const { id } = ev.currentTarget.dataset

        const productCase = document.querySelector(
            `[data-name="product-total-value-${id}"]`
        )
        if (!productCase) return

        const container = document.querySelector(
            `[data-name="user-total-product"]`
        )

        try {
            const response = await fetch(`/cart/reduce-product/${id}`, {
                method: "POST"
            })
            if (!response.ok) throw new Error(await response.text())

            const { qty, total } = await response.json()
            productCase.textContent = qty
            updateTotal(total)

            let cartTotal = parseInt(container.textContent)
            container.textContent = --cartTotal
        } catch (e) {
            console.warn(e)
        }
    }

    btn.addEventListener("click", handleReduceProduct)
})
