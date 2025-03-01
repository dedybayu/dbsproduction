<x-user.user-layout>
    <x-slot:title>
        <div
            class="flex flex-col sm:flex-row items-center justify-between space-y-4 sm:space-y-0 sm:space-x-4 mb-4 sm:mb-0 mt-4">
            <div class="mb-0 sm:mb-0">
                {{ $title }}
            </div>
        </div>

    </x-slot:title>

    <div class="p-2 md:p-4 flex justify-center items-center">
        <div class="w-full px-6 pb-8 sm:max-w-xl sm:rounded-lg">
            <div class="grid max-w-2xl mx-auto mt-8">
                <div class="flex flex-col justify-center items-center space-y-5 sm:flex-row sm:space-y-0">
                    @if (auth()->user()->image)
                        <img class="object-cover w-40 h-40 p-1 rounded-full ring-2 ring-indigo-300 dark:ring-indigo-500"
                            src="{{asset('storage/' . $post->image)}}" alt="Bordered avatar">
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
                            placeholder="Your first name" value="{{auth()->user()->name}}" required>
                    </div>

                    <div class="mb-2 sm:mb-6">
                        <label for="email" class="block mb-2 text-sm font-medium text-indigo-900 dark:text-white">Your
                            email</label>
                        <input type="email" id="email"
                            class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 "
                            placeholder="your.email@mail.com" required value="{{auth()->user()->email}}">
                    </div>

                    <div class="mb-6">
                        <label for="message"
                            class="block mb-2 text-sm font-medium text-indigo-900 dark:text-white">Bio</label>
                        <textarea id="message" rows="4"
                            class="block p-2.5 w-full text-sm text-indigo-900 bg-indigo-50 rounded-lg border border-indigo-300 focus:ring-indigo-500 focus:border-indigo-500 "
                            placeholder="Write your bio here..."></textarea>
                    </div>

                    <div class="flex justify-end">
                        <a href="/profile/edit"
                            class="text-white bg-green-700  hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800">Edit</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-user.user-layout>