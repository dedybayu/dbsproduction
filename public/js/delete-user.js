document.addEventListener("DOMContentLoaded", function () {
    const deleteButtons = document.querySelectorAll(".delete-user-btn");
    const deleteForm = document.getElementById("deleteUserForm");
    deleteButtons.forEach(button => {
        button.addEventListener("click", function () {
            const userId = this.getAttribute("data-user-id");
            deleteForm.action = `users/${userId}`;
        });
    });
});