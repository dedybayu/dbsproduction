document.addEventListener("DOMContentLoaded", function() {
  const form = document.querySelector("form");
  const password = document.getElementById("password");
  const confirmPassword = document.getElementById("confirm-password");
  const passNotMatch = document.getElementById("passNotMatch");

  form.addEventListener("submit", function(event) {
    if (password.value !== confirmPassword.value) {
      event.preventDefault(); // Mencegah form dikirim
      passNotMatch.textContent = "Confirm password does not match";
      confirmPassword.focus();
    } else {
      passNotMatch.textContent = "";
    }
  });

  const deleteButton = document.getElementById("deleteButton");
  const deleteForm = document.getElementById("deleteForm");

  deleteButton.addEventListener("click", function() {
    let id = this.getAttribute("data-id");
    deleteForm.setAttribute("action", `/data/${id}`);
  });
});
