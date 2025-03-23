document
    .getElementById("customer-order-table")
    ?.addEventListener("click", (event) => {
        const clickedTbody = event.target.closest("tbody")
        const clickedRow = event.target.closest("tr")
        const clickedBtn = event.target.closest("button")

        if (!clickedTbody || !clickedRow || clickedBtn) return

        const { id } = clickedRow.dataset
        if (id) location.href = `/customer/order/${id}`
    })

document.getElementById("status")?.addEventListener("input", (ev) => {
    const form = ev.currentTarget.form

    form.submit()
})

if (location.search) {
    const dataSearch = new URLSearchParams(location.search)

    if (dataSearch.get("status")) {
        const el = document.querySelector(
            `[value="${dataSearch.get("status")}"]`
        )
        el.parentElement
            .querySelector(`[selected]`)
            ?.removeAttribute("selected")

        el.setAttribute("selected", "")
    }
}
