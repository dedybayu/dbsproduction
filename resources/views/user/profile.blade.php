<x-user.user-layout>
    <x-slot:title>
        <div
            class="flex flex-col sm:flex-row items-center justify-between space-y-4 sm:space-y-0 sm:space-x-4 mb-4 sm:mb-0 mt-4">
            <div class="mb-0 sm:mb-0">
                {{ $title }}
            </div>
        </div>

    </x-slot:title>
    <div id="success-password"
        class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
        role="alert">
        <svg class="shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
            viewBox="0 0 20 20">
            <path
                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
        </svg>
        <span class="sr-only">Info</span>
        <div class="ms-3 text-xm font-medium">
            Password successfully changed
        </div>

    </div>

    <div class="p-2 md:p-4 flex justify-center items-center">
        <div class="w-full px-6 pb-8 sm:max-w-xl sm:rounded-lg">
            <div class="grid max-w-2xl mx-auto mt-8">
                <div class="flex flex-col justify-center items-center space-y-5 sm:flex-row sm:space-y-0">
                    @if (auth()->user()->image)
                        <img class="object-cover w-40 h-40 p-1 rounded-full ring-2 ring-indigo-300 dark:ring-indigo-500"
                            src="{{asset('storage/' . auth()->user()->image)}}" alt="Bordered avatar">
                    @else
                        <img class="object-cover w-40 h-40 p-1 rounded-full ring-2 ring-indigo-300 dark:ring-indigo-500"
                            src="img/user.png" alt="Bordered avatar">
                    @endif

                </div>

                <div class="items-center mt-8 sm:mt-14 text-[#202142]">

                    <div class="mb-2 sm:mb-6">
                        <label for="first_name"
                            class="block mb-2 text-sm font-medium text-indigo-900 dark:text-white">Your name</label>
                        <input type="text" id="first_name"
                            class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 "
                            placeholder="Your first name" value="{{auth()->user()->name}}" disabled>
                    </div>

                    <div class="mb-2 sm:mb-6">
                        <label for="email" class="block mb-2 text-sm font-medium text-indigo-900 dark:text-white">Your
                            email</label>
                        <input type="email" id="email"
                            class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 "
                            placeholder="your.email@mail.com" required value="{{auth()->user()->email}}" disabled>
                    </div>

                    <div class="mb-6">
                        <label for="message"
                            class="block mb-2 text-sm font-medium text-indigo-900 dark:text-white">Bio</label>
                        <textarea id="message" rows="4"
                            class="block p-2.5 w-full text-sm text-indigo-900 bg-indigo-50 rounded-lg border border-indigo-300 focus:ring-indigo-500 focus:border-indigo-500 "
                            placeholder="Write your bio here..." disabled>{{auth()->user()->bio}}</textarea>
                    </div>
                    <div class="mb-6 flex justify-center">
                        <button data-modal-target="change-password-modal" data-modal-toggle="change-password-modal"
                            class="text-white bg-yellow-700  hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800">Change
                            Password</button>
                    </div>


                    <div class="flex justify-between">
                        <a href="/"
                            class="text-white bg-gray-500   hover:bg-gray-600 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800">Back</a>
                        <a href="/profile/edit"
                            class="text-white bg-green-700  hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800">Edit</a>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Change Password modal -->
    <div id="change-password-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                <!-- Modal header -->
                <div
                    class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Change Your Password
                    </h3>
                    <button type="button"
                        class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="change-password-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5">
                    <form class="space-y-4" method="POST"
                        action="{{ route('profile.update_password', auth()->user()->id) }}">
                        @method("PUT")
                        @csrf
                        <div>
                            <label for="password"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Old
                                password</label>
                            <input type="password" name="old_password" id="password" placeholder="Old Password"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                required />
                        </div>
                        <div>
                            <label for="new-password"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">New
                                password</label>
                            <p id="password-min-5" class="mt-2 text-red-500 text-sm hidden">New password and
                                confirmation don't match.</p>

                            <input type="password" name="new_password" id="new-password" placeholder="New Password"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                required />
                        </div>
                        <div>
                            <label for="confirm-password"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">confirm
                                password</label>
                            <input type="password" name="confirm_password" id="confirm-password"
                                placeholder="confirm Password"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                required />
                            <!-- Pesan Error -->
                            <p id="password-error" class="mt-2 text-red-500 text-sm hidden">New password and
                                confirmation don't match.</p>
                        </div>

                        <p id="response-message" class="mt-2 text-sm"></p>
                        <p id="response-success" class="mt-2 text-sm"></p>

                        <div class="flex flex-col justify-end">
                            <button type="submit"
                                class="text-white mt-4 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const modal = document.getElementById("change-password-modal");
            const inputs = modal.querySelectorAll("input");
            const popupSuccess = document.getElementById("success-password");
            popupSuccess.classList.add("hidden");

            modal.addEventListener("show", function () {

                inputs.forEach(input => input.value = "");

                // Perbarui CSRF token setiap kali modal dibuka
                fetch("/csrf-token")
                    .then(response => response.json())
                    .then(data => {
                        document.querySelector("input[name=_token]").value = data.csrf_token;
                    });
            });


            // Tampilkan error Dari Controller
            const form = document.querySelector("form");
            const responseMessage = document.getElementById("response-message");
            const responseSuccess = document.getElementById("response-success");



            form.addEventListener("submit", function (event) {
                event.preventDefault(); // Mencegah pengiriman form default

                const formData = new FormData(form);

                fetch(form.action, {
                    method: "POST",
                    body: formData,
                    headers: {
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-TOKEN": document.querySelector("input[name=_token]").value,
                        "Accept": "application/json"
                    }
                })

                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Tampilkan pesan sukses
                            responseSuccess.textContent = data.success;
                            responseSuccess.classList.remove("hidden");
                            responseSuccess.classList.add("text-green-500");

                            // Tampilkan popup success
                            popupSuccess.classList.remove("hidden");
                            popupSuccess.style.opacity = "1";
                            // Tutup modal (sesuai dengan library yang digunakan)
                            document.querySelector("[data-modal-hide='change-password-modal']")?.click();

                            // Setelah 5 detik, lakukan fade out
                            setTimeout(() => {
                                popupSuccess.style.transition = "opacity 1s ease-out"; // Tambahkan efek transisi
                                popupSuccess.style.opacity = "0"; // Ubah opacity menjadi 0

                                // Setelah animasi selesai, sembunyikan elemen
                                setTimeout(() => {
                                    popupSuccess.classList.add("hidden");
                                }, 700); // Waktu sesuai dengan durasi transisi
                            }, 4000);
                        } else {
                            // Tampilkan pesan error dari server jika ada
                            responseMessage.textContent = data.message || "Error updating password.";
                            responseMessage.classList.remove("hidden");
                            responseMessage.classList.add("text-red-500");
                        }
                    })
                    .catch(error => {
                        responseMessage.textContent = "Error updating password. Please try again.";
                        responseMessage.classList.remove("hidden");
                        responseMessage.classList.add("text-red-500");
                    });
            });

            // Jika menggunakan data-modal-hide/show dari Flowbite atau library lain
            document.querySelectorAll("[data-modal-hide='change-password-modal']").forEach(button => {
                button.addEventListener("click", () => {
                    inputs.forEach(input => input.value = "");
                    responseMessage.classList.add("hidden");

                    // Reset CSRF token saat modal ditutup
                    fetch("/csrf-token")
                        .then(response => response.json())
                        .then(data => {
                            document.querySelector("input[name=_token]").value = data.csrf_token;
                        });
                });
            });

        });

    </script>


    {{--
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const modal = document.getElementById("change-password-modal");
            const inputs = modal.querySelectorAll("input");

            modal.addEventListener("show", function () {
                inputs.forEach(input => input.value = "");
            });

            const form = document.querySelector("form");
            const newPassword = document.getElementById("new-password");
            const confirmPassword = document.getElementById("confirm-password");
            const passwordError = document.getElementById("password-error");
            const passwordMinError = document.getElementById("password-min-5");
            const submitButton = form.querySelector("button[type='submit']");

            function validatePasswords() {
                let valid = true; // Flag untuk validasi

                // Periksa panjang password minimal 5 karakter
                if (newPassword.value.length < 5) {
                    passwordMinError.classList.remove("hidden");
                    valid = false;
                } else {
                    passwordMinError.classList.add("hidden");
                }

                // Periksa apakah password baru dan konfirmasi cocok
                if (newPassword.value !== confirmPassword.value) {
                    passwordError.classList.remove("hidden");
                    valid = false;
                } else {
                    passwordError.classList.add("hidden");
                }

                // Aktifkan tombol jika tidak ada error
                submitButton.disabled = !valid;
            }

            newPassword.addEventListener("input", validatePasswords);
            confirmPassword.addEventListener("input", validatePasswords);

            form.addEventListener("submit", function (event) {
                event.preventDefault(); // Mencegah reload halaman

                if (newPassword.value !== confirmPassword.value) {
                    passwordError.classList.remove("hidden");
                    return;
                }

                const formData = new FormData(form); // Ambil data dari form
                formData.append("_method", "PUT"); // Tambahkan metode PUT ke FormData


                fetch(form.action, {
                    method: "POST", // Laravel akan menangani @method("PUT")
                    body: formData,
                    headers: {
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
                    }
                })
                    .then(response => response.json()) // Parsing response ke JSON
                    .then(data => {
                        responseMessage.textContent = data.message; // Tampilkan pesan dari server
                        responseMessage.classList.remove("text-red-500");
                        responseMessage.classList.add("text-red-500"); // Tambahkan warna merah
                    })
                    .catch(error => {
                        responseMessage.textContent = "An error occurred.";
                        responseMessage.classList.remove("text-red-500");
                        responseMessage.classList.add("text-red-500"); // Tambahkan warna merah jika error
                    });
            });

            // Jika menggunakan data-modal-hide/show dari Flowbite atau library lain
            document.querySelectorAll("[data-modal-hide='change-password-modal']").forEach(button => {
                button.addEventListener("click", () => {
                    inputs.forEach(input => input.value = "");
                    responseMessage.classList.add("hidden");
                });
            });
        });
    </script> --}}



</x-user.user-layout>