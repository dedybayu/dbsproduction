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



    <div class="relative overflow-x-auto mx-auto max-w-screen-xl">
        <div class="flex justify-end mt-4 mb-3">
            <button type="button" data-modal-target="add-category-modal" data-modal-toggle="add-category-modal"
                class="flex items-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">

                <svg class="w-5 h-5 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 12h14m-7 7V5" />
                </svg>
                Add Category
            </button>
        </div>

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
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
        @endif

        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="w-1/12 px-6 py-3 rounded-s-lg">
                        No
                    </th>
                    <th scope="col" class="w-8/12 px-6 py-3">
                        Category
                    </th>
                    <th scope="col" class="w-3/12 px-6 py-3 rounded-e-lg text-center">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr class="bg-white dark:bg-gray-800">
                        <td class="px-6 py-4">
                            {{ $loop->iteration + ($categories->currentPage() - 1) * $categories->perPage() }}
                        </td>
                        <td class="px-6 py-4">{{ $category->name }}</td>
                        <td class="px-6 py-4 text-center flex items-center justify-center gap-2">
                            <button data-id="{{ $category->id }}" data-color="{{ $category->color }}"
                                data-name="{{ $category->name }}" ata-modal-target="editCategoryModal"
                                data-modal-toggle="editCategoryModal" id=""
                                class="edit-category-btn focus:outline-none no-underline text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                Edit
                            </button>

                            <button data-id="{{ $category->id }}" data-modal-target="deleteCategoryModal"
                                class="delete-category-btn focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                                Delete
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>



        </table>
        <!-- Pagination -->
        <div class="mt-5">
            {{ $categories->onEachSide(2)->links() }}
        </div>
    </div>

    <!-- Add Category Modal -->
    <div id="add-category-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                <!-- Modal header -->
                <div
                    class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Create New Category
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="add-category-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form class="p-4 md:p-5" method="post">
                    @csrf
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2">
                            <label for="category-name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category
                                Name</label>
                            <input type="text" name="category-name" id="category-name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 placeholder-gray-400"
                                placeholder="Type category name" required="">
                        </div>
                    </div>

                    <div class="col-span-2">
                        <label for="category-color"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Category Color
                        </label>
                        <select name="category-color" id="category-color" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="" class="text-blue-600" disabled selected>Select Color</option>
                            <option value="red" class="bg-red-100 text-blue-600">Red</option>
                            <option value="blue" class="bg-blue-100 text-blue-600">Blue</option>
                            <option value="green" class="bg-green-100 text-blue-600">Green</option>
                            <option value="yellow" class="bg-yellow-100 text-blue-600">Yellow</option>
                            <option value="purple" class="bg-purple-100 text-blue-600">Purple</option>
                            <option value="pink" class="bg-pink-100 text-blue-600">Pink</option>
                            <option value="indigo" class="bg-indigo-100 text-blue-600">Indigo</option>
                            <option value="gray" class="bg-gray-100 text-blue-600">Gray</option>
                            <option value="orange" class="bg-orange-100 text-blue-600">Orange</option>
                            <option value="teal" class="bg-teal-100 text-blue-600">Teal</option>
                            <option value="lime" class="bg-lime-100 text-blue-600">Lime</option>
                            <option value="amber" class="bg-amber-100 text-blue-600">Amber</option>
                            <option value="cyan" class="bg-cyan-100 text-blue-600">Cyan</option>
                            <option value="rose" class="bg-rose-100 text-blue-600">Rose</option>
                            <option value="violet" class="bg-violet-100 text-blue-600">Violet</option>
                            <option value="fuchsia" class="bg-fuchsia-100 text-blue-600">Fuchsia</option>
                            <option value="sky" class="bg-sky-100 text-blue-600">Sky</option>
                            <option value="stone" class="bg-stone-100 text-blue-600">Stone</option>
                            <option value="neutral" class="bg-neutral-100 text-blue-600">Neutral</option>
                        </select>
                    </div>


                    <div class="flex justify-end mb-2">
                        <button type="submit"
                            class="text-white inline-flex mt-5 items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            Add
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>




    <!-- Modal toggle -->
    <button data-modal-target="editCategoryModal" data-modal-toggle="editCategoryModal"
        class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
        type="button">
        Toggle modal
    </button>

    <!-- Edit Category modal -->
    <div id="editCategoryModal" tabindex="-2" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                <!-- Modal header -->
                <div
                    class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Edit Category
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="editCategoryModal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form class="p-4 md:p-5" method="post">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="category-id" id="edit-category-id">
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2">
                            <label for="category-name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category
                                Name</label>
                            <input type="text" name="category_name" id="category-name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 placeholder-gray-400"
                                placeholder="Type category name" required="">
                        </div>
                    </div>

                    <div class="col-span-2">
                        <label for="category-color"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Category Color
                        </label>
                        <select name="category_color" id="category-color" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="" class="text-blue-600" disabled selected>Select Color</option>
                            <option value="red" class="bg-red-100 text-blue-600">Red</option>
                            <option value="blue" class="bg-blue-100 text-blue-600">Blue</option>
                            <option value="green" class="bg-green-100 text-blue-600">Green</option>
                            <option value="yellow" class="bg-yellow-100 text-blue-600">Yellow</option>
                            <option value="purple" class="bg-purple-100 text-blue-600">Purple</option>
                            <option value="pink" class="bg-pink-100 text-blue-600">Pink</option>
                            <option value="indigo" class="bg-indigo-100 text-blue-600">Indigo</option>
                            <option value="gray" class="bg-gray-100 text-blue-600">Gray</option>
                            <option value="orange" class="bg-orange-100 text-blue-600">Orange</option>
                            <option value="teal" class="bg-teal-100 text-blue-600">Teal</option>
                            <option value="lime" class="bg-lime-100 text-blue-600">Lime</option>
                            <option value="amber" class="bg-amber-100 text-blue-600">Amber</option>
                            <option value="cyan" class="bg-cyan-100 text-blue-600">Cyan</option>
                            <option value="rose" class="bg-rose-100 text-blue-600">Rose</option>
                            <option value="violet" class="bg-violet-100 text-blue-600">Violet</option>
                            <option value="fuchsia" class="bg-fuchsia-100 text-blue-600">Fuchsia</option>
                            <option value="sky" class="bg-sky-100 text-blue-600">Sky</option>
                            <option value="stone" class="bg-stone-100 text-blue-600">Stone</option>
                            <option value="neutral" class="bg-neutral-100 text-blue-600">Neutral</option>
                        </select>
                    </div>


                    <div class="flex justify-end mb-2">
                        <button type="submit"
                            class="text-white inline-flex mt-5 items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const editButtons = document.querySelectorAll(".edit-category-btn");

            editButtons.forEach(button => {
                button.addEventListener("click", function () {
                    const categoryId = this.getAttribute("data-id");

                    fetch(`/categories/${categoryId}/edit`)
                        .then(response => response.json())
                        .then(data => {
                            // Perbaiki form action agar sesuai dengan kategori, bukan user
                            document.querySelector("#editCategoryModal form").action = `/categories/update/${categoryId}`;

                            // Isi input form dengan data kategori yang diambil
                            document.querySelector("#editCategoryModal input[name='category_name']").value = data.name;
                            document.querySelector("#editCategoryModal select[name='category_color']").value = data.color;
                            // Tampilkan modal edit kategori
                            document.querySelector("#editCategoryModal").classList.remove("hidden");
                        })
                        .catch(error => console.error("Error fetching category data:", error));
                });
            });

            // Menutup modal saat tombol close diklik
            document.querySelector("[data-modal-hide='editCategoryModal']").addEventListener("click", function () {
                document.querySelector("#editCategoryModal").classList.add("hidden");
            });
        });

    </script>
</x-user.user-layout>