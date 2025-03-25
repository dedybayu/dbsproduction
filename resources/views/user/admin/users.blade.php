<x-user.user-layout>
    <x-slot:title>
        <div
            class="flex flex-col sm:flex-row items-center justify-between space-y-4 sm:space-y-0 sm:space-x-4 mb-4 sm:mb-0 mt-4">
            <div class="mb-0 sm:mb-0">
                {{ $title }}
            </div>

            {{-- <x-search /> --}}
        </div>

    </x-slot:title>
    {{-- {{ $posts->links() }} --}}

    <div id="popup-success"
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



    @if (session()->has('success-user'))
        <div id="alert-3"
            class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 max-w-md mx-auto"
            role="alert">
            <svg class="shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">Info</span>
            <div class="ms-3 text-xm font-medium">
                {{session('success-user')}}
            </div>
            <button type="button"
                class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700"
                data-dismiss-target="#alert-3" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
            </button>
        </div>
    @endif




    <div class="relative mx-auto max-w-screen-xl">
        <div
            class="flex items-center justify-end flex-column flex-wrap mt-5 md:flex-row space-y-4 md:space-y-0 pb-4 bg-white dark:bg-gray-900">

            <label for="table-search" class="sr-only">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input type="text" id="table-search-users"
                    class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Search for users">
            </div>
        </div>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">

            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 bg-gray-100 uppercase dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            No
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Occupancy
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Bio
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody id="user-table-body">
                    {{-- @foreach ($users as $user)
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th class="px-6 py-4">
                            {{$loop->iteration}}
                        </th>
                        <th scope="row"
                            class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                            @if (auth()->user()->image)
                            <img class="w-10 h-10 rounded-full" src="{{asset('storage/' . $user->image)}}"
                                alt="User image">
                            @else
                            <img class="w-10 h-10 rounded-full" src="img/user.png" alt="User image">
                            @endif

                            <div class="ps-3">
                                <div class="text-base font-semibold">
                                    {{ $user->name }} {{ $user->id === auth()->id() ? '(You)' : '' }}
                                </div>
                                <div class="font-normal text-gray-500">{{ $user->email }}</div>
                            </div>
                        </th>
                        <td class="px-6 py-4">
                            {{ Str::words($user->occupancy, 2, '...') }}
                        </td>
                        <td class="px-6 py-4">
                            {{ Str::words($user->bio, 3, '...') }}
                        </td>
                        <td class="px-6 py-4 text-center flex items-center justify-center gap-2">
                            @if ($user->id !== auth()->id())
                            <button data-modal-target="edit-user-modal" data-modal-toggle="edit-user-modal"
                                class="edit-user-btn focus:outline-none no-underline text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                Edit
                            </button>

                            <button data-modal-target="delete-user-modal" data-modal-toggle="delete-user-modal"
                                class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-700 delete-user-btn"
                                data-user-id="{{$user->id}}">
                                Delete
                            </button>
                            @endif

                        </td>
                    </tr>
                    @endforeach --}}





                    <!-- Modal -->
                    <div id="delete-user-modal" tabindex="-1"
                        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-4 w-full max-w-md max-h-full">
                            <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                                <button type="button"
                                    class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                    data-modal-hide="delete-user-modal">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                                <div class="p-4 md:p-5 text-center">
                                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200"
                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure
                                        you want to delete this User and all its
                                        posts?</h3>
                                    <form id="deleteUserForm" method="POST" action="">
                                        @csrf
                                        @method('DELETE')
                                        <button data-modal-hide="delete-user-modal" type="submit"
                                            class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                            Yes, I'm sure
                                        </button>
                                        <button data-modal-hide="delete-user-modal" type="button"
                                            class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No,
                                            cancel</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </tbody>
            </table>

        </div>
    </div>

    <!-- Edit User modal -->
    <div id="edit-user-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-lg max-h-full">
            <!-- Modal content -->
            <div id="edit-user-content"
                class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700 opacity-0 scale-95 transition-all duration-300">
                <!-- Modal header -->
                <div
                    class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Edit User
                    </h3>
                    <button type="button"
                        class="btn-close-edit end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
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
                    <form class="space-y-4" id="editUserForm" action="" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="grid gap-4 mb-4 grid-cols-2">

                            <div>
                                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Name</label>
                                <input type="text" name="name" id="name"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                    placeholder="Name" required />
                            </div>
                            <div>
                                <label for="username"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Username</label>
                                <input type="username" name="username" id="username"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                    placeholder="username" required />
                                <p id="error-username" class="mt-2 text-sm text-red-600"></p>
                            </div>
                            <div>
                                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Email</label>
                                <input type="email" name="email" id="email"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                    placeholder="name@company.com" required />
                                <p id="error-email" class="mt-2 text-sm text-red-600"></p>
                            </div>
                            <div>
                                <label for="occupancy"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Occupancy</label>
                                <input type="text" name="occupancy" id="occupancy"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                    placeholder="occupancy" required />
                            </div>
                        </div>
                        <div>
                            <label for="bio" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Bio</label>
                            <input type="text" name="bio" id="bio"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                placeholder="bio" required />
                        </div>
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Password</label>
                            <input type="password" name="password" id="password"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                placeholder="password" />
                        </div>
                        <div>
                            <p class="pb-5">Profile Picture</p>

                            <div class="flex flex-col justify-left items-center space-y-3 sm:flex-row sm:space-y-0">
                                <img id="profileImage"
                                    class="object-cover w-28 h-28 p-1 rounded-full ring-2 ring-indigo-300 dark:ring-indigo-500"
                                    src="{{ auth()->user()->image ? asset('storage/' . auth()->user()->image) : asset('img/user.png') }}"
                                    alt="Profile picture">

                                <div class="flex flex-col space-y-3 sm:ml-4">
                                    <input type="file" id="profile_picture" name="profile_picture" class="hidden"
                                        accept="image/*" onchange="previewImage(event)">
                                    <button type="button" onclick="document.getElementById('profile_picture').click()"
                                        class="py-2.5 px-5 text-sm font-medium text-indigo-100 bg-blue-500 rounded-lg border border-indigo-200 hover:bg-blue-600">
                                        Change picture
                                    </button>
                                    <button type="button" onclick="removeImage()"
                                        class="py-2.5 px-5 text-sm font-medium text-indigo-900 bg-white rounded-lg border border-indigo-200 hover:bg-indigo-100">
                                        Delete picture
                                    </button>
                                </div>
                            </div>

                        </div>
                        <p id="response-success" class="mt-2 text-sm"></p>
                        <p id="response-message" class="mt-2 text-sm"></p>
                        <p id="error-message" class="mt-2 text-sm"></p>


                        <br>
                        <div class="flex justify-between">
                            <button type="button"
                                class="btn-close-edit text-white bg-gray-500 hover:bg-gray-600 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800">Cancel</button>
                            <button type="submit"
                                class=" text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Tambahkan input hidden -->
    <input type="hidden" id="remove_picture" name="remove_picture" value="0">

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const editButtons = document.querySelectorAll(".edit-user-btn");
            const modal = document.querySelector("#edit-user-modal");
            const form = modal.querySelector("form");
            const errorMessage = document.getElementById("error-message");
            const responseMessage = document.getElementById("response-message");
            const responseSuccess = document.getElementById("response-success");
            const popupSuccess = document.getElementById("popup-success");
            const tableBody = document.getElementById("user-table-body");


            popupSuccess.classList.add("hidden");

            // Panggil saat pertama kali halaman dimuat
            reloadUserTable();


            function reloadUserTable() {
                // const tableBody = document.getElementById("user-table-body");

                fetch("/api/users") // Ambil data user dari endpoint API
                    .then(response => response.json())
                    .then(users => {
                        tableBody.innerHTML = ""; // Kosongkan terlebih dahulu

                        users.forEach((user, index) => {
                            const isCurrentUser = user.id === {{ auth()->id() }}; // Cek apakah ini user yang login

                            let userRow = `
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                            <th class="px-6 py-4">${index + 1}</th>
                                            <td class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                                <img class="w-10 h-10 rounded-full" src="${user.image ? '/storage/' + user.image : 'img/user.png'}" alt="User image">
                                                <div class="ps-3">
                                                    <div class="text-base font-semibold">
                                                        ${user.name} ${isCurrentUser ? '(You)' : ''}
                                                    </div>
                                                    <div class="font-normal text-gray-500">${user.email}</div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">${user.occupancy ? user.occupancy : '-'}</td>
                                            <td class="px-6 py-4">${user.bio ? user.bio : '-'}</td>
                                            <td class="px-6 py-4 text-center flex items-center justify-center gap-2">
                                                ${!isCurrentUser ? `
                                                    <button class="edit-user-btn focus:outline-none no-underline text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800" data-user-id="${user.id}">
                                                        Edit
                                                    </button>
                                                    <button class="delete-user-btn text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-700" data-user-id="${user.id}">
                                                        Delete
                                                    </button>
                                                ` : ''}
                                            </td>
                                        </tr>
                                        `;

                            tableBody.innerHTML += userRow;
                        });

                        // Tambahkan event listener ke tombol edit dan delete setelah tabel diperbarui
                        attachEventListeners();
                    })
                    .catch(error => console.error("Error loading users:", error));
            }




            // Fungsi untuk menambahkan event listener ke tombol edit dan delete
            function attachEventListeners() {
                document.querySelectorAll(".edit-user-btn").forEach(button => {
                    button.addEventListener("click", function () {
                        const userId = this.getAttribute("data-user-id");
                        openEditModal(userId);
                    });
                });

                document.querySelectorAll(".delete-user-btn").forEach(button => {
                    button.addEventListener("click", function () {
                        const userId = this.getAttribute("data-user-id");
                        openDeleteModal(userId);
                    });
                });
            }

            // Fungsi untuk membuka modal edit (kamu bisa sesuaikan sesuai kebutuhan)
            // Fungsi untuk membuka modal edit
            const editModal = document.getElementById("edit-user-modal");
            const modalContent = document.getElementById("edit-user-content");
            const editUserForm = document.getElementById("editUserForm");
            async function openEditModal(userId) {
                console.log("Edit user:", userId);



                // Set action form sesuai ID user
                editUserForm.action = `/users/update/${userId}`;

                // Tampilkan modal edit dengan backdrop
                editModal.classList.remove("hidden");
                editModal.classList.add("flex", "h-screen", "bg-opacity-50", "bg-gray-800");

                setTimeout(() => {
                    modalContent.classList.remove("opacity-0", "scale-95");
                    modalContent.classList.add("opacity-100", "scale-100");
                }, 10); // Delay sedikit agar transisi bisa berjalan


                // Kosongkan pesan error
                document.getElementById("error-username").innerHTML = "";
                document.getElementById("error-email").innerHTML = "";
                responseSuccess.classList.add("hidden");


                try {
                    // Fetch data user dari server
                    const response = await fetch(`/users/${userId}/edit`);
                    if (!response.ok) {
                        throw new Error("Gagal mengambil data pengguna.");
                    }
                    const data = await response.json();
                    console.log(data);
                    // Isi form dengan data user
                    editUserForm.querySelector("input[name='name']").value = data.name || "";
                    editUserForm.querySelector("input[name='username']").value = data.username || "";
                    editUserForm.querySelector("input[name='email']").value = data.email || "";
                    editUserForm.querySelector("input[name='occupancy']").value = data.occupancy || "";
                    editUserForm.querySelector("input[name='bio']").value = data.bio || "";

                    // Atur gambar profil jika ada
                    document.getElementById("profileImage").src = data.image
                        ? `/storage/${data.image}`
                        : "{{ asset('img/user.png') }}";

                } catch (error) {
                    console.error("Error fetching user data:", error);
                    document.getElementById("error-message").innerHTML = "Gagal memuat data pengguna.";
                }


            }
            // Event listener untuk tombol close modal
            document.querySelectorAll(".btn-close-edit").forEach((button) => {
                button.addEventListener("click", function () {
                    closeEditModal();
                });
            });
            // Fungsi untuk menutup modal dengan animasi
            function closeEditModal() {
                // Tambahkan animasi keluar
                modalContent.classList.add("opacity-0", "scale-95");
                modalContent.classList.remove("opacity-100", "scale-100");

                // Tunggu animasi selesai sebelum menyembunyikan modal
                setTimeout(() => {
                    editModal.classList.add("hidden");
                }, 300); // Delay sesuai durasi transisi CSS
            }


            // Fungsi untuk membuka modal delete (kamu bisa sesuaikan sesuai kebutuhan)
            function openDeleteModal(userId) {
                const deleteModal = document.getElementById("delete-user-modal");
                const deleteUserForm = document.getElementById("deleteUserForm");

                console.log("Delete user:", userId);

                // Set action form sesuai ID user
                deleteUserForm.action = `/users/${userId}`;

                // Tampilkan modal delete
                deleteModal.classList.remove("hidden");
                deleteModal.classList.add("flex", "h-screen", "bg-gray-800", "bg-opacity-50");



                // Event listener untuk tombol close modal
                document.querySelectorAll("[data-modal-hide='delete-user-modal']").forEach((button) => {
                    button.addEventListener("click", function () {
                        deleteModal.classList.add("hidden");
                    });
                });
            }


            // Menampilkan modal edit user
            editButtons.forEach(button => {
                button.addEventListener("click", async function () {
                    document.getElementById("error-username").innerHTML = "";
                    document.getElementById("error-email").innerHTML = "";

                    const userId = this.closest("tr").querySelector(".delete-user-btn").getAttribute("data-user-id");

                    try {
                        const response = await fetch(`/users/${userId}/edit`);
                        const data = await response.json();

                        form.action = `/users/update/${userId}`;
                        form.querySelector("input[name='name']").value = data.name;
                        form.querySelector("input[name='username']").value = data.username;
                        form.querySelector("input[name='email']").value = data.email;
                        form.querySelector("input[name='occupancy']").value = data.occupancy;
                        form.querySelector("input[name='bio']").value = data.bio;

                        document.getElementById('profileImage').src = data.image ? `/storage/${data.image}` : "{{ asset('img/user.png') }}";

                        modal.classList.remove("hidden");
                        errorMessage.innerHTML = ""; // Hapus pesan error sebelumnya
                    } catch (error) {
                        console.error("Error fetching user data:", error);
                    }
                });
            });

            // Menutup modal
            document.querySelector("[data-modal-hide='edit-user-modal']").addEventListener("click", function () {
                modal.classList.add("hidden");
            });


            // Menangani submit form edit user
            form.addEventListener("submit", async function (event) {
                event.preventDefault();

                let formData = new FormData(form);
                let submitButton = form.querySelector("button[type='submit']");
                submitButton.disabled = true; // Mencegah multiple submit

                try {
                    const response = await fetch(form.action, {
                        method: "POST",
                        body: formData,
                        headers: {
                            "X-Requested-With": "XMLHttpRequest",
                            "X-CSRF-TOKEN": document.querySelector("input[name=_token]").value
                        }
                    });

                    if (!response.ok) {
                        const errorData = await response.json();
                        throw errorData;
                    }

                    const data = await response.json();

                    if (data.success) {
                        responseSuccess.textContent = data.success;
                        responseSuccess.classList.remove("hidden");
                        responseSuccess.classList.add("text-green-500");

                        toggleSuccessMessage(); // Menampilkan notifikasi sukses
                        reloadUserTable();

                        document.querySelector("[data-modal-hide='edit-user-modal']")?.click(); // Tutup modal

                    } else {
                        responseMessage.textContent = data.message || "Error updating user.";
                        responseMessage.classList.remove("hidden");
                        responseMessage.classList.add("text-red-500");
                    }
                } catch (error) {
                    if (error.error_username) {
                        document.getElementById("error-username").innerHTML = error.error_username;
                    }

                    if (error.error_email) {
                        document.getElementById("error-email").innerHTML = error.error_email;
                    }

                    console.error("Unexpected error:", error);
                } finally {
                    submitButton.disabled = false; // Aktifkan kembali tombol submit
                }
            });

        });

        // Fungsi menampilkan pesan sukses dengan efek fade-out
        function toggleSuccessMessage() {
            const popupSuccess = document.getElementById("popup-success");
            popupSuccess.classList.remove("hidden");
            popupSuccess.style.opacity = "1";

            setTimeout(() => {
                popupSuccess.style.transition = "opacity 1s ease-out";
                popupSuccess.style.opacity = "0";

                setTimeout(() => {
                    popupSuccess.classList.add("hidden");
                }, 700);
            }, 4000);
        }

        // Menampilkan preview gambar sebelum upload
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function () {
                document.getElementById('profileImage').src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);

            document.getElementById('remove_picture').value = "0";
        }

        // Menghapus gambar yang dipilih
        function removeImage() {
            document.getElementById('profileImage').src = "{{ asset('img/user.png') }}";
            document.getElementById('profile_picture').value = '';
            document.getElementById('remove_picture').value = "1";
        }
    </script>



</x-user.user-layout>