// document.addEventListener("DOMContentLoaded", function () {
//     const deleteCategoryButtons = document.querySelectorAll(".delete-category-btn");
//     const deleteCategoryForm = document.getElementById("deleteCategoryForm");
//     const modal = document.getElementById("deleteCategoryModal");
//     const backdrop = document.getElementById("deleteCategoryBackdrop");
//     const closeModalButtons = document.querySelectorAll(".close-modal");

//     function closeModal() {
//         modal.classList.add("hidden");
//         modal.classList.remove("flex");
//         backdrop.classList.add("hidden");  // Menyembunyikan backdrop
//     }

//     deleteCategoryButtons.forEach(button => {
//         button.addEventListener("click", function () {
//             let id = this.getAttribute("data-id");
//             deleteCategoryForm.setAttribute("action", `/categories/${id}`);
//             modal.classList.remove("hidden");
//             modal.classList.add("flex");
//             backdrop.classList.remove("hidden");  // Menampilkan backdrop
//         });
//     });

//     closeModalButtons.forEach(button => {
//         button.addEventListener("click", closeModal);
//     });

//     // Tutup modal saat backdrop diklik
//     backdrop.addEventListener("click", closeModal);

//     // Tutup modal jika klik di luar modal (tidak di dalam div modal)
//     window.addEventListener("click", function (event) {
//         if (event.target === modal) {
//             closeModal();
//         }
//     });
// });
