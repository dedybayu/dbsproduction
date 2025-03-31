<nav class="fixed top-0 z-50 w-full bg-indigo-800 border-b  dark:bg-gray-800 dark:border-gray-700">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center justify-start rtl:justify-end">
                <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar"
                    type="button"
                    class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden focus:outline-none focus:ring-2  dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="w-6 h-6 text-indigo-200" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path clip-rule="evenodd" fill-rule="evenodd"
                            d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                        </path>
                    </svg>
                </button>
                <a href="/" class="flex ms-2 md:me-24">
                    <img src="/../img/logo4.png" class="h-8 me-3" alt="FlowBite Logo" />
                    <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap text-gray-100">DBS
                        Production</span>
                </a>
            </div>
            <div class="flex items-center">
                <div class="flex items-center ms-3">
                    <div>
                        <button type="button"
                            class="flex text-sm bg-indigo-800 rounded-full focus:ring-4 focus:ring-indigo-300 dark:focus:ring-gray-600 ring-2 ring-indigo-400"
                            aria-expanded="false" data-dropdown-toggle="dropdown-user">
                            <span class="sr-only">Open user menu</span>

                            @if (auth()->user()->image)
                                <img class="w-8 h-8 rounded-full object-cover"
                                    src="{{asset('storage/' . auth()->user()->image)}}" alt="user photo">
                            @else
                                <img class="w-8 h-8 rounded-full"
                                    src="img/user.png" alt="user photo">
                            @endif

                        </button>
                    </div>
                    <div class="z-40 hidden my-4 text-base list-none bg-indigo-50 divide-y divide-gray-100 rounded-xl shadow-sm dark:bg-gray-700 dark:divide-gray-600"
                        id="dropdown-user">
                        <div class="px-4 py-3" role="none">
                            <p class="text-sm text-gray-900 dark:text-white" role="none">
                                {{auth()->user()->name}}
                            </p>
                            <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">
                                {{auth()->user()->email}}
                            </p>
                            <div class="bg-blue-500 bg-opacity-30 text-primary-800 text-sm font-medium inline-flex items-center px-2.5 py-0.5 rounded dark:bg-primary-200 dark:text-primary-800">
                                <p>{{auth()->user()->occupancy}}</p>
                            </div>
                        </div>
                        <ul class="py-1" role="none">
                            <li>
                                <a href="#"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-200 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                    role="menuitem">Settings</a>
                            </li>
                            <li>
                                <a href="/profile"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-200 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                    role="menuitem">My Profile</a>
                            </li>
                            <li>
                                <button id="signout-btn" data-modal-target="logout-modal"
                                    data-modal-toggle="logout-modal"
                                    class="block px-4 py-2 w-full text-left text-sm text-gray-700 hover:bg-indigo-200 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                    role="menuitem">Sign out
                                </button>

                                <script>
                                    document.getElementById('signout-btn').addEventListener('click', function () {
                                        document.getElementById('dropdown-user').classList.add('hidden');
                                    });
                                </script>

                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>