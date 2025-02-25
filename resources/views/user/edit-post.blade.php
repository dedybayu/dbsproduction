<x-user.user-layout>
    <x-slot:title>
        <div
            class="flex flex-col sm:flex-row items-center justify-between space-y-4 sm:space-y-0 sm:space-x-4 mb-4 sm:mb-0 mt-4">
            <div class="mb-0 sm:mb-0">
                {{ $title }}
            </div>
        </div>

    </x-slot:title>
    {{-- {{ $posts->links() }} --}}

    <form action="{{ route('posts.update', $post->slug) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <input type="hidden" name="author" id="author" value="{{auth()->user()->id}}">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-5">
            <div class="grid lg:grid-cols-2 md:grid-cols-1 gap-4 mb-4">
                <div class="p-4 items-center justify-center rounded-sm bg-gray-50 dark:bg-gray-800">
                    <div class="sm:col-span-3">
                        <label for="title" class="block text-sm/6 font-medium text-gray-900">Title</label>
                        <div class="mt-2">
                            <input type="text" name="title" id="title" autocomplete="given-name" required
                                value="{{$post->title}}"
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 border-gray-400 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-400 sm:text-sm/6">
                        </div>
                    </div>
                </div>
                <div class="p-4 items-center justify-center rounded-sm bg-gray-50 dark:bg-gray-800">
                    <div class="sm:col-span-3">
                        <label for="category" class="block text-sm/6 font-medium text-gray-900">Category</label>
                        <div class="mt-2">
                            <select name="category" id="category" required
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 border-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-400 sm:text-sm/6">
                                <option value="" disabled>Select a category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $category->id == $post->category_id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>

                        </div>
                    </div>

                </div>
            </div>

            <div class="items-center justify-center p-4 mb-4 rounded-sm bg-gray-50 dark:bg-gray-800">
                <div class="col-span-full">
                    <label for="body" class="block text-sm/6 font-medium text-gray-900">Article</label>
                    <p class="mt-3 text-sm/6 text-gray-600">Write a article</p>
                    <div class="mt-2">
                        <textarea name="body" id="body" rows="3"
                            class="block w-full  min-h-[500px] h-auto rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 border-gray-400 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-400 sm:text-sm/6"
                            required>{{$post->body}}
                        </textarea>
                    </div>
                </div>
            </div>

            <div class="items-center justify-center mb-4 rounded-sm bg-gray-50 dark:bg-gray-800">
                <div class="col-span-full p-4">
                    <label for="file-upload" class="block text-sm/6 font-medium text-gray-900">Cover photo</label>
                    <div id="drop-zone"
                        class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-400 px-6 py-10 cursor-pointer">
                        <input id="file-upload" name="file-upload" type="file" class="sr-only" accept="image/*">
                        <div class="text-center">

                            <svg id="upload-icon" class="mx-auto size-12 text-gray-300 @if($post->image) hidden @endif"
                                viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z"
                                    clip-rule="evenodd" />
                            </svg>
                            
                            @if ($post->image)
                                <img id="preview-image" src="{{ asset('storage/' . $post->image) }}"
                                    class="mx-auto max-h-40 rounded-lg" alt="Preview">
                            @endif
                            
                            <img id="preview-image" class="hidden mx-auto max-h-40 rounded-lg" alt="Preview">
                            


                            <div class="mt-4 text-sm text-gray-600">
                                <label for="file-upload" class="relative cursor-pointer rounded-md">
                                    <span
                                        class="font-bold text-indigo-600 focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">Upload
                                        a file </span>
                                    <span>or drag and drop</span>
                                </label>
                                {{-- <p class="pl-1">or drag and drop</p> --}}
                            </div>
                            <p class="text-xs text-gray-600">PNG, JPG, GIF up to 10MB</p>
                        </div>
                    </div>
                </div>
            </div>


            <div class="mt-6 flex items-center justify-end gap-x-6">
                <button data-modal-target="cancel-edit-modal" data-modal-toggle="cancel-edit-modal" type="button"
                    class="text-sm/6 font-semibold text-gray-900 hover:text-gray-500">Cancel</button>
                <button type="submit"
                    class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
            </div>
        </div>
    </form>






</x-user.user-layout>