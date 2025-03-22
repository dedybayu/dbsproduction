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





    @if (session()->has('success-category'))
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
                {{session('success-category')}}
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
                <tbody>
                    @foreach ($users as $user)
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
                    @endforeach





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
            <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                <!-- Modal header -->
                <div
                    class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Edit User
                    </h3>
                    <button type="button"
                        class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="edit-user-modal">
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
                    <form class="space-y-4" action="" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Name</label>
                            <input type="text" name="name" id="name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                placeholder="Name" required />
                        </div>
                        <div>
                            <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Username</label>
                            <input type="username" name="username" id="username"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                placeholder="username" required />
                        </div>
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Email</label>
                            <input type="email" name="email" id="email"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                placeholder="name@company.com" required />
                        </div>
                        <div>
                            <label for="occupancy" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Occupancy</label>
                            <input type="text" name="occupancy" id="occupancy"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                placeholder="occupancy" required />
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
                        <br>
                        <div class="flex justify-end"> 
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

            editButtons.forEach(button => {
                button.addEventListener("click", function () {
                    const userId = this.closest("tr").querySelector(".delete-user-btn").getAttribute("data-user-id");

                    fetch(`/users/${userId}/edit`)
                        .then(response => response.json())
                        .then(data => {
                            document.querySelector("#edit-user-modal form").action = `/users/update/${userId}`;

                            document.querySelector("#edit-user-modal input[name='name']").value = data.name;
                            document.querySelector("#edit-user-modal input[name='username']").value = data.username;
                            document.querySelector("#edit-user-modal input[name='email']").value = data.email;
                            document.querySelector("#edit-user-modal input[name='occupancy']").value = data.occupancy;
                            document.querySelector("#edit-user-modal input[name='bio']").value = data.bio;

                            if (data.image) {
                                document.getElementById('profileImage').src = `/storage/${data.image}`;
                            } else {
                                document.getElementById('profileImage').src = "{{ asset('img/user.png') }}";
                            }

                            document.querySelector("#edit-user-modal").classList.remove("hidden");
                        })
                        .catch(error => console.error("Error fetching user data:", error));
                });
            });

            document.querySelector("[data-modal-hide='edit-user-modal']").addEventListener("click", function () {
                document.querySelector("#edit-user-modal").classList.add("hidden");
            });
        });

        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function () {
                document.getElementById('profileImage').src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);

            document.getElementById('remove_picture').value = "0";
        }

        function removeImage() {
            document.getElementById('profileImage').src = "{{ asset('img/user.png') }}";
            document.getElementById('profile_picture').value = '';
            document.getElementById('remove_picture').value = "1";
        }
    </script>

</x-user.user-layout>