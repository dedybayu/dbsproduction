<x-user.user-layout>
    <x-slot:title>
        <div
            class="flex flex-col sm:flex-row items-center justify-between space-y-4 sm:space-y-0 sm:space-x-4 mb-4 sm:mb-0 mt-4">
            <div class="mb-0 sm:mb-0">
                {{ $title }}
            </div>
        </div>

    </x-slot:title>

    <form action="{{ route('profile.update', auth()->user()->id) }}" method="POST" enctype="multipart/form-data"
        class="p-2 md:p-4 flex justify-center items-center">
        @method('PUT')
        @csrf
        <input type="hidden" id="remove_picture" name="remove_picture" value="0">
        <div class="w-full px-6 pb-8 sm:max-w-xl sm:rounded-lg">
            <div class="grid max-w-2xl mx-auto mt-8">
                <div class="flex flex-col justify-center items-center space-y-5 sm:flex-row sm:space-y-0">
                    <img id="profileImage"
                        class="object-cover w-40 h-40 p-1 rounded-full ring-2 ring-indigo-300 dark:ring-indigo-500"
                        src="{{ auth()->user()->image ? asset('storage/' . auth()->user()->image) : asset('img/user.png') }}"
                        alt="Profile picture">

                    <div class="flex flex-col space-y-5 sm:ml-8">
                        <input type="file" id="profile_picture" name="profile_picture" class="hidden" accept="image/*"
                            onchange="previewImage(event)">
                        <button type="button" onclick="document.getElementById('profile_picture').click()"
                            class="py-3.5 px-7 text-base font-medium text-indigo-100 bg-blue-500 rounded-lg border border-indigo-200 hover:bg-indigo-900">
                            Change picture
                        </button>
                        <button type="button" onclick="removeImage()"
                            class="py-3.5 px-7 text-base font-medium text-indigo-900 bg-white rounded-lg border border-indigo-200 hover:bg-indigo-100">
                            Delete picture
                        </button>
                    </div>
                </div>

                <div class="items-center mt-8 sm:mt-14 text-[#202142]">
                    <div class="mb-2 sm:mb-6">
                        <label for="name" class="block mb-2 text-sm font-medium text-indigo-900 dark:text-white">Your
                            Name</label>
                        <input type="text" id="name" name="name" value="{{ auth()->user()->name }}"
                            class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 "
                            required>
                    </div>
                    <div class="mb-2 sm:mb-6">
                        <label for="username" class="block mb-2 text-sm font-medium text-indigo-900 dark:text-white">Your
                            Username</label>
                        <input type="text" id="username" name="username" value="{{ auth()->user()->username }}"
                            class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 "
                            required>
                    </div>
                    <div class="mb-2 sm:mb-6">
                        <label for="occupancy" class="block mb-2 text-sm font-medium text-indigo-900 dark:text-white">Your
                            Occupancy</label>
                        <input type="text" id="occupancy" name="occupancy" value="{{ auth()->user()->occupancy }}"
                            class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 "
                            required>
                    </div>

                    <div class="mb-2 sm:mb-6">
                        <label for="email" class="block mb-2 text-sm font-medium text-indigo-900 dark:text-white">Your
                            email</label>
                        <input type="email" id="email" name="email" value="{{ auth()->user()->email }}"
                            class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 "
                            required>
                    </div>

                    <div class="mb-6">
                        <label for="bio"
                            class="block mb-2 text-sm font-medium text-indigo-900 dark:text-white">Bio</label>
                        <textarea id="bio" name="bio" rows="4"
                            class="block p-2.5 w-full text-sm text-indigo-900 bg-indigo-50 rounded-lg border border-indigo-300 focus:ring-indigo-500 focus:border-indigo-500 "
                            placeholder="Write your bio here...">{{ auth()->user()->bio }}</textarea>
                    </div>

                    <div class="flex justify-between">
                        <a href="/profile"
                            class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">
                            Cancel
                        </a>
                        <button type="submit"
                            class="text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">
                            Save
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function () {
                var output = document.getElementById('profileImage');
                output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
            // Reset hidden input jika gambar baru dipilih
            document.getElementById('remove_picture').value = "0";
        }

        function removeImage() {
            document.getElementById('profileImage').src = '/../img/user.png';
            document.getElementById('profile_picture').value = '';

            // Tandai gambar untuk dihapus
            document.getElementById('remove_picture').value = "1";
        }
    </script>


</x-user.user-layout>