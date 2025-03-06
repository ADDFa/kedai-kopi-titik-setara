document.getElementById("product-table")?.addEventListener("click", (ev) => {
    const clickedTbody = ev.target.closest("tbody")
    const clickedRow = ev.target.closest("tr")

    if (!clickedTbody || !clickedRow) return

    const { id } = clickedRow.dataset
    location.href = `/product/${id}`
})
