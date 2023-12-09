<div class="relative"  x-data="{open: false, modal:false}"
@mouseover="bottom = (window.innerHeight - $el.getBoundingClientRect().bottom) < 200"
>
    <div>

        @teleport('body')
        <div x-show="modal" class="absolute z-30 top-0 left-0 w-screen h-screen bg-opacity-20 bg-black flex items-center justify-center"  >
                <div class="bg-white divide-y dark:bg-slate-950 dark:text-gray-100 w-full mx-auto max-w-md shadow-xl">
                    <div class="p-5 w-full">
                        Compartilhar
                    </div>
                    <div class=" w-full">

                        {{-- create --}}
                        <div class="">
                            <x-validation-errors class="mb-4" />
                        </div>

                        <div class="flex justify-center">
                            <div class="w-full max-w-xl">
                                        <div class="flex flex-wrap justify-center">

                                    <div class="mt-1 flex flex-wrap rounded-md shadow-sm w-full">
                                        <div class="relative flex flex-grow items-stretch focus-within:z-10">
                                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-gray-900 dark:text-white">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                                                  </svg>
                                            </div>
                                            <input type="text"  wire:model.live.debounce.500ms="userSearch" name="taskTitle" id="taskTitle" class="block w-full h-14 text-lg bg-white dark:bg-slate-900 text-gray-900  dark:text-gray-100  rounded-t-md border-gray-300 pl-10 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="E-mail do usuário">
                                        </div>
                                    </div>

                                    @if ($this->searchResults)
                                    <ul class="w-full">
                                    @if ($this->searchResults->count() > 0)
                                    @foreach ($this->searchResults as $user )
                                        <li class="dark:text-gray-100 w-full  text-lg p-2 text-left flex flex-nowrap justify-between">
                                            <div class="divide-y">
                                                {{ $user->email }}
                                                <br>
                                                <div class="text-sm ">
                                                    {{ $user->name }}
                                                </div>
                                            </div>
                                            <div class="text-sm ">
                                                <button class="btn-dafault" wire:click="addUserToTask('{{ $task->id }}', '{{ $user->id }}')" >
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                                      </svg>

                                                </button>
                                            </div>

                                        </li>
                                        @endforeach
                                        <div >

                                        </div>

                                        @else
                                        <li class="text-lg p-4">
                                            sem resultados
                                        </li>
                                    @endif
                                    </ul>

                                    @endif
                                </div>
                            </div>
                        </div>

                {{-- end create --}}
                    </div>
                    <div class="p-5 w-full">
                        Usuários:
                        <ul>
                            @foreach ($users as $user)
                        <li class="my-2 dark:text-gray-100 divide-y">
                            {{ $user->name }}
                        </li>
                        @endforeach
                    </ul>
                    </div>
            </div>
            </div>
        @endteleport
    </div>

    <li class="py-2" :key="$task->id">
        <div class="flex flex-nowrap justify-between">
            <div class="max-w-full truncate ">
                <button wire:click="toggleTask('{{ $task->id }}')" @class(['line-through decoration-2'=> $task->status,
                    'font-bold overflow-hidden max-w-full text-lg truncate ...']) >
                    @if ($task->status == true)
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="mr-1 inline w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>

                    @else
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class=" mr-1 inline w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                            fill="" /> </svg>
                    @endif
                    {{ $task->title  }}
                </button>
                @if ($task->description)
                <div class="relative mt-1.5  inset-0 flex flex-wrap items-center" aria-hidden="true">
                    <div class="w-full border-t dark:border-gray-500"></div>
                    <div class="w-full " @class(['line-through decoration-2'=> $task->status])>
                        {{ $task->description  }}
                    </div>
                </div>
                @endif
            </div>

            <div class="relative">
                <button id="dropdownMenuIconButton" x-on:click="open = !open"
                    class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-900 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                    type="button">
                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 4 15">
                        <path
                            d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
                    </svg>
                </button>

                <!-- Dropdown menu -->
                <div id="dropdownDots"

                    class="z-10 absolute transform -translate-y-8  -translate-x-full bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600"
                    x-show="open" x-cloak @click.away="open = false" x-transition:enter="transition ease-out duration-100"
                    >

                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownMenuIconButton">
                        <li>
                            <button class="btn-dropdown" @click="modal = ! modal">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 inline mr-2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7.217 10.907a2.25 2.25 0 100 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186l9.566-5.314m-9.566 7.5l9.566 5.314m0 0a2.25 2.25 0 103.935 2.186 2.25 2.25 0 00-3.935-2.186zm0-12.814a2.25 2.25 0 103.933-2.185 2.25 2.25 0 00-3.933 2.185z" />
                                  </svg>
                                   Compartilhar
                            </button>

                        </li>
                    </ul>
                    <div class="py-2 w-full">
                        <button class="btn-dropdown "
                            wire:click="deleteTask('{{ $task->id }}')"
                            wire:confirm="Are you sure you want to delete this post?">
                            Deletar
                        </button>
                    </div>
                </div>
            </div>


        </div>
    </li>
</div>
