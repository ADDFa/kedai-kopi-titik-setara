document.getElementById("product-table")?.addEventListener("click", (event) => {
    const clickedTbody = event.target.closest("tbody")
    const clickedRow = event.target.closest("tr")
    const clickedBtn = event.target.closest("button")

    if (!clickedTbody || !clickedRow || clickedBtn) return

    const { id } = clickedRow.dataset
    if (id) location.href = `/product/${id}`
})
