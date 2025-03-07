document.getElementById("product-table")?.addEventListener("click", (ev) => {
    const clickedTbody = ev.target.closest("tbody")
    const clickedRow = ev.target.closest("tr")
    const clickedBtn = ev.target.closest("button")

    if (!clickedTbody || !clickedRow || clickedBtn) return

    const { id } = clickedRow.dataset
    location.href = `/product/${id}`
})
