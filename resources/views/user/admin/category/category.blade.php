<x-user.user-layout>
    <x-slot:title>
        <div
            class="flex flex-col sm:flex-row items-center justify-between space-y-4 sm:space-y-0 sm:space-x-4 mb-4 sm:mb-0 mt-4">
            <div class="mb-0 sm:mb-0">
                {{-- {{ $title }} --}}
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

        <div id="category-container">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="w-1/12 px-6 py-3 rounded-s-lg">No</th>
                        <th scope="col" class="w-8/12 px-6 py-3">Category</th>
                        <th scope="col" class="w-3/12 px-6 py-3 rounded-e-lg text-center">Action</th>
                    </tr>
                </thead>
                <tbody id="category-list">
                    @foreach ($categories as $category)
                        <tr class="bg-white dark:bg-gray-800">
                            <td class="px-6 py-4">
                                {{ $loop->iteration + ($categories->currentPage() - 1) * $categories->perPage() }}
                            </td>
                            <td class="px-6 py-4">{{ $category->name }}</td>
                            <td class="px-6 py-4 text-center flex items-center justify-center gap-2">
                                <button data-id="{{ $category->id }}" data-name="{{ $category->name }}"
                                    data-modal-target="edit-category-modal"
                                    class="edit-category-btn focus:outline-none no-underline text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                    Update
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
            <div id="pagination-links" class="mt-5">
                {{ $categories->links() }}
            </div>
        </div>
        
        <script>
            function fetchCategories(url) {
                $.ajax({
                    url: url,
                    type: "GET",
                    success: function(response) {
                        $("#category-container").html(response);
                    },
                    error: function(xhr) {
                        console.log("Error:", xhr);
                    }
                });
            }
        
            $(document).on("click", "#pagination-links a", function(event) {
                event.preventDefault();
                let url = $(this).attr("href");
                fetchCategories(url);
            });
        </script>
    </div>



        <!-- Edit Category Modal -->
        <div id="edit-category-modal" tabindex="-1" aria-hidden="true"
            class="fixed inset-0 z-50 flex items-center justify-center w-full h-full bg-black bg-opacity-50">
            <div class="relative p-4 w-full max-w-md bg-white rounded-lg shadow-lg dark:bg-gray-700">
                <div class="flex items-center justify-between p-4 border-b dark:border-gray-600 border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Edit Category</h3>
                    <button type="button"
                        class="close-modal text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-lg p-1">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>
                <form id="edit-category-form" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="p-4">
                        <label for="category-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category
                            Name</label>
                        <input type="text" name="name" id="category-name" placeholder="Category name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 placeholder-gray-400" required>
                    </div>
                    <div class="p-4 flex justify-end">
                        <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 rounded-lg px-5 py-2.5">Save</button>
                    </div>
                </form>
            </div>
        </div>

</x-user.user-layout>