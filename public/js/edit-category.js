document.addEventListener("DOMContentLoaded", function () {
    const editButtons = document.querySelectorAll(".edit-category-btn");

    editButtons.forEach(button => {
        button.addEventListener("click", function () {
            // Ambil data dari atribut tombol
            const categoryId = this.getAttribute("data-id");
            const categoryName = this.getAttribute("data-name");
            const categoryColor = this.getAttribute("data-color");

            // Isi modal dengan data
            document.getElementById("edit-category-id").value = categoryId;
            document.getElementById("edit-category-name").value = categoryName;
            document.getElementById("edit-category-color").value = categoryColor;
        });
    });
});