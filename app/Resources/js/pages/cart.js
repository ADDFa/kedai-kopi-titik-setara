import { Confirm } from "../functions/sweet-alert"

const deleteCartProductsBtn = document.querySelectorAll(
    `[data-name="delete-product-in-cart"]`
)
const addProductsBtn = document.querySelectorAll(`[data-name="add-product"]`)
const reduceProductsBtn = document.querySelectorAll(
    `[data-name="reduce-product"]`
)

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
            if (!response.ok) return

            const { qty } = await response.json()
            productCase.textContent = qty

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
            if (!response.ok) return

            const { qty } = await response.json()
            productCase.textContent = qty

            let cartTotal = parseInt(container.textContent)
            container.textContent = --cartTotal
        } catch (e) {
            console.warn(e)
        }
    }

    btn.addEventListener("click", handleReduceProduct)
})
