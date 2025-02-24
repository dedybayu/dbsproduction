<x-user.user-layout>
    <x-slot:title>
        <div
            class="flex flex-col sm:flex-row items-center justify-between space-y-4 sm:space-y-0 sm:space-x-4 mb-4 sm:mb-0 mt-4">
            <div class="mb-0 sm:mb-0">
                {{ $title }}
            </div>
        </div>
    </x-slot:title>

    <main class="pt-4 pb-8 lg:pt-8 lg:pb-8 rounded-xl bg-gray-50 dark:bg-gray-900 antialiased">
        <div class="flex justify-between px-4 mx-auto max-w-screen-xl ">
            <article
                class="mx-auto w-full max-w-5xl format format-sm sm:format-base lg:format-lg format-blue dark:format-invert">
                <header class="mb-4 lg:mb-6 not-format">
                    <a href="{{url()->previous()}}" class="font-medium text-sm text-blue-600 hover:underline">&laquo;
                        Back</a>
                    <h1
                        class="mb-4 text-3xl font-extrabold leading-tight text-gray-900 lg:mb-6 lg:text-4xl dark:text-white mt-6">
                        {{$post['title']}}</h1>
                </header>

                <p>{{$post['body']}}</p>

                <div class="mb-4 lg:mb-6 not-format mt-10">
                    <h3 class="mb-4 text-2xl font-bold leading-tight text-gray-800 lg:mb-6 lg:text-2xl dark:text-white">
                        Author:</h3>
                    <address class="flex items-center mb-6 not-italic">
                        <div class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white">
                            <img class="mr-4 w-16 h-16 rounded-full"
                                src="/../img/user.png" alt="Jese Leos">
                            <div>
                                <a href="/posts?author={{$post->author->username}}" rel="author"
                                    class="text-xl font-bold text-gray-900 dark:text-white">{{$post->author->name}}</a>
                                <p class="text-base text-gray-500 dark:text-gray-400"><time pubdate
                                        datetime="2022-02-08"
                                        title="February 8th, 2022">{{$post->created_at->format('j F Y')}}</time></p>
                                <a href="/posts?category={{$post->category->slug}}">
                                    <span
                                        class="bg-{{$post->category->color}}-100 text-primary-800 text-x font-medium inline-flex items-center px-2.5 py-0.5 rounded dark:bg-primary-200 dark:text-primary-800">
                                        <svg class="mr-1 w-3 h-3" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M2 5a2 2 0 012-2h8a2 2 0 012 2v10a2 2 0 002 2H4a2 2 0 01-2-2V5zm3 1h6v4H5V6zm6 6H5v2h6v-2z"
                                                clip-rule="evenodd"></path>
                                            <path d="M15 7h1a2 2 0 012 2v5.5a1.5 1.5 0 01-3 0V7z"></path>
                                        </svg>
                                        {{$post->category->name}}
                                    </span>
                                </a>
                            </div>
                        </div>
                    </address>
                </div>
            </article>
        </div>
    </main>




</x-user.user-layout>