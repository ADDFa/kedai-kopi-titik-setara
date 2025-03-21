const cartButtons = document.querySelectorAll(`[data-action="add-to-cart"]`)

cartButtons.forEach((cartButton) => {
    const handleAddToCart = async () => {
        const { userId, productId } = cartButton.dataset
        if (!userId || !productId) return (location.href = "/sign-in")

        const container = document.querySelector(
            `[data-name="user-total-product"]`
        )

        const body = new FormData()
        body.append("user_id", userId)
        body.append("product_id", productId)

        try {
            const response = await fetch("/cart", {
                method: "POST",
                body
            })

            if (!response.ok) {
                const message = `Status: [${response.status}] ${response.statusText}`
                console.log(await response.text())
                throw new Error(message)
            }

            const { total_product } = await response.json()
            if (container) container.innerText = total_product
        } catch (e) {
            console.warn(e)
        }
    }

    cartButton.addEventListener("click", handleAddToCart)
})
