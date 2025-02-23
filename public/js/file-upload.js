
document.addEventListener("DOMContentLoaded", function() {
    const dropZone = document.getElementById("drop-zone");
    const fileInput = document.getElementById("file-upload");
    const previewImage = document.getElementById("preview-image");
    const uploadIcon = document.getElementById("upload-icon");

    if (!dropZone || !fileInput || !previewImage || !uploadIcon) {
        return;
    }

    // Klik pada SVG atau area upload membuka file picker
    dropZone.addEventListener("click", () => fileInput.click());

    // Menampilkan gambar setelah file dipilih
    fileInput.addEventListener("change", function(event) {
        if (event.target.files.length > 0) {
            let file = event.target.files[0];
            let reader = new FileReader();
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                previewImage.classList.remove("hidden");
                uploadIcon.classList.add("hidden");
            };
            reader.readAsDataURL(file);
        }
    });

    // Drag and Drop
    dropZone.addEventListener("dragover", (event) => {
        event.preventDefault();
        dropZone.classList.add("border-indigo-600");
        dropZone.classList.add("bg-indigo-50");
    });
    

    dropZone.addEventListener("dragleave", () => {
        dropZone.classList.remove("border-indigo-600");
    });

    dropZone.addEventListener("drop", (event) => {
        event.preventDefault();
        dropZone.classList.remove("border-indigo-600");
        if (event.dataTransfer.files.length > 0) {
            fileInput.files = event.dataTransfer.files;
            fileInput.dispatchEvent(new Event("change")); // Memicu event change
        }
    });
});
