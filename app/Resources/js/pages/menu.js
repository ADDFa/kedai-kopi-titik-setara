const cartButtons = document.querySelectorAll("#add-to-cart")
cartButtons.forEach((cartButton) => {
    const handleAddToCart = async (ev) => {
        const { userId, productId } = ev.currentTarget.dataset
        if (!userId || !productId) return (location.href = "/sign-in")

        const container = document.querySelector(
            `[data-name="user-total-product"]`
        )

        const body = new FormData()
        body.append("user_id", userId)
        body.append("product_id", productId)
        const response = await fetch("/cart", {
            method: "POST",
            body
        })

        if (response.headers.get("Content-Type").includes("application/json")) {
            const { total_product } = await response.json()
            if (container) container.innerText = total_product
        }
    }

    cartButton.addEventListener("click", handleAddToCart)
})
