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
  





    <div class="relative overflow-x-auto mx-auto max-w-screen-xl">
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
                    <td class="px-6 py-4">{{$loop->iteration}}</td>
                    <td class="px-6 py-4">{{$category->name}}</td>
                    <td class="px-6 py-4 text-center flex items-center justify-center gap-2">
                        <button class="focus:outline-none no-underline text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Update</button>
                        <button class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Delete</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    


    
  
    {{-- {{ $posts->links() }} --}}
  
  </x-user.user-layout>