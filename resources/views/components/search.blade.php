<form action="/posts" method="GET"
    class="flex items-center space-x-2 sm:space-x-4 w-full sm:w-auto text-base font-normal text-gray-600 py-0">
    @if (request('category'))
        <input type="hidden" name="category" value="{{ request('category')}}">
    @endif
    @if (request('author'))
        <input type="hidden" name="author" value="{{ request('author')}}">
    @endif
    <div class="relative w-full sm:w-64">
        <label for="search" class="hidden">Email address</label>
        <!-- SVG Icon -->
        <div class="absolute left-3 top-1/2 transform -translate-y-1/2">
            <svg class="w-5 h-5 text-gray-500 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                    d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
            </svg>
        </div>
        <!-- Input Field -->
        <input
            class="pl-10 text-gray-500 p-2 w-full text-sm bg-gray-50 border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
            placeholder="Find" type="search" id="search" name="search" autocomplete="off">
    </div>
    <button type="submit"
        class="py-2 px-5 text-sm font-medium text-white bg-primary-700 border border-primary-600 rounded-lg hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
        Search
    </button>
</form>