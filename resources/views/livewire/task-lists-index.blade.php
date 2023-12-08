<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl pt-8 text-gray-800 dark:text-gray-200 leading-tight text-center">
            {{ __('Minhas Listas') }}
        </h2>
    </x-slot>

    <div class="py-12 mt-20">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between">
                <div class="sub-header">
                    @if ($total == 0)
                        <span class="text-gray-900 dark:text-gray-100">Crie uma lista para começar</span>
                    @else
                        <span class="text-gray-900 dark:text-gray-100">Você tem {{ $total }} listas</span>
                    @endif
                </div>
                <div>
                    <span class="isolate inline-flex rounded-md shadow-sm">
                        <button type="button"
                            class="rounded-l-md btn-dafault">
                            <span class="sr-only">Previous</span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                            </svg>
                        </button>
                        <button type="button"
                            class="-ml-px rounded-r-md btn-dafault">
                            <span class="sr-only">Next</span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                            </svg>
                        </button>
                    </span>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-3 md:p-4 lg:p-5 mt-5 gap-3 grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6">
                @foreach ($lists as $list)
                <div>
                    <a href="/listas/edit/{{ $list->id }}" wire:navigate>
                        <div class="h-40 w-full  dark:bg-slate-400 dark:border-gray-200 rounded">
                            <div class="w-full h-full flex items-center justify-center">
                                {{ $list->title }}
                            </div>
                        </div>
                    </a>
                </div>

                @endforeach
                <div >
                    <a href="/listas/create" wire:navigate>
                        <div class="h-40 w-full  dark:bg-slate-400 dark:border-gray-200 rounded">
                            <div class="w-full h-full flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
