// document.addEventListener("DOMContentLoaded", function () {
//     document.getElementById("edit-category-modal").classList.add("hidden");
//     document.querySelectorAll(".edit-category-btn").forEach(button => {
//         button.addEventListener("click", function () {
//             const categoryId = this.getAttribute("data-id");
//             const categoryName = this.getAttribute("data-name");

//             document.getElementById("category-name").value = categoryName;
//             document.getElementById("edit-category-form").setAttribute("action", `/categories/${categoryId}`);

//             document.getElementById("edit-category-modal").classList.remove("hidden");
//         });
//     });

//     document.querySelector(".close-modal").addEventListener("click", function () {
//         document.getElementById("edit-category-modal").classList.add("hidden");
//     });
// });