<div>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-2xl pt-8 text-gray-800 dark:text-gray-200 leading-tight text-center">
            {{ $taskList->title }}

            </h2>
        </x-slot>

        <div class="py-12 mt-20">
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-between">
                    <div class="sub-header">

                    </div>
                    <div>

                    </div>
                </div>
                <div class="flex justify-center">
                    <div class="w-full max-w-xl">
                        <div>
                            <div class="mt-1 flex rounded-md shadow-sm">
                                <div class="relative flex flex-grow items-stretch focus-within:z-10">
                                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                                        </svg>
                                    </div>
                                    <input type="email" name="email" id="email" class="block w-full rounded-none rounded-l-md border-gray-300 pl-10 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Nova tarefa">
                                </div>
                                <button type="button" class="relative -ml-px inline-flex items-center space-x-2 rounded-r-md border border-gray-300 bg-gray-50 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-3 md:p-4 lg:p-5 mt-5 ">
                    @if ($taskList->tasks->count() > 0)

                    @else
                        <div class="flex justify-center">
                            <span class="text-gray-900 dark:text-gray-100">Crie uma tarefa para começar </span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </x-app-layout>

</div>
