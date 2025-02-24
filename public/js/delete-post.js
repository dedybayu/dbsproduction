document.addEventListener("DOMContentLoaded", function () {
    const deleteButton = document.getElementById("deleteButton");
    const deleteForm = document.getElementById("deleteForm");

    deleteButton.addEventListener("click", function () {
        let id = this.getAttribute("data-id");
        deleteForm.setAttribute("action", `/data/${id}`);
    });
});