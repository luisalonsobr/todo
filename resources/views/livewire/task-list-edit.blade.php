<div x-data="{styles: {width: $wire.percentageDone + '%'}, editingTitle:true }"
    x-init="@this.$watch('percentageDone', value => styles.width = value + '%')">

    <div class="font-semibold text-2xl  text-white leading-tight text-center">
        <input class="text-2xl text-white bg-transparent border-0 text-center mt-10 ring-0 [text-shadow:_0_2px_10px_rgb(0_0_0_/_40%)] border-solid focus:border-b-2 border-b-white focus:ring-white focus:ring-0" type="text" wire:model.live.debounce.500ms="listTitle"  >

    </div>
        <x-slot name="header">



        </x-slot>

        <div class="py-12 mt-0">
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-between">
                    <div class="sub-header">

                    </div>
                    <div>

                    </div>
                </div>

                {{-- create --}}
                <div class="flex justify-center">
                    <div class="w-full max-w-xl">
                        <form wire:submit="addTask" action="">
                                <div class="flex flex-wrap justify-center">
                            <div class="mt-1 flex flex-wrap rounded-md shadow-sm w-full">
                                <div class="relative flex flex-grow items-stretch focus-within:z-10">
                                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-gray-900 dark:text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                          </svg>

                                    </div>
                                    <input type="text"  wire:model="taskTitle" name="taskTitle" id="taskTitle" class="block w-full h-14 text-lg bg-white dark:bg-slate-900 text-gray-900  dark:text-gray-100  rounded-t-md border-gray-300 pl-10 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Nova tarefa">
                                </div>
                                <textarea wire:model="description" class="bg-white dark:bg-slate-900 text-gray-900 h-20 dark:text-gray-100 w-full rounded-b-md border-gray-300 pl-10 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" wire:model="taskDescription" name="taskDescription" id="taskDescription" cols="30" rows="10" placeholder="Descrição"></textarea>
                            </div>
                            <button type="submit" class="relative -ml-px inline-flex items-center space-x-2 w-full text-center justify-center mt-5 rounded-md border border-gray-300 bg-gray-50 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                            </button>
                        </div>
                        </form>
                    </div>
                </div>
                <div class="my-5">
                    <x-validation-errors class="mb-4" />
                </div>
                {{-- end create --}}

                <div class="relative bg-white dark:bg-gray-800 overflow-visible shadow-xl sm:rounded-b-lg p-3 md:p-4 lg:p-5  " >
                    <div class="absolute w-full dark:bg-slate-950 h-1 z-20t top-0 left-0" >

                        <div class="absolute bg-green-500 h-1 z-20t top-0 left-0" :style="styles">
                        </div>
                    </div>
                    @if ($taskList)
                    @if ($taskList->tasks->count() > 0)
                    {{-- sort --}}
                    <div class="w-full  h-10 bg-white dark:bg-gray-800  md:rounded-t flex justify-between overflow-visible" >
                        <div class="text-white">
                            {{-- {{ $percentageDone  }} --}}
                        </div>
                        <div>
                            <span class="isolate inline-flex rounded-md shadow-sm">
                                <button type="button" wire:click="changeOrder('status')"
                                        @class(['bg-white text-gray-900 dark:text-gray-200 dark:bg-slate-600' => $orderBy == 'status', 'rounded-l-md btn-dafault']) >
                                    <span class="sr-only">Ordenar por Status</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class=" inline w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                      </svg>
                                </button>
                                @if (in_array($orderBy, ['titleZa', 'status', 'priority']))
                                    <button type="button" wire:click="changeOrder('titleAz')"
                                            @class(['bg-white text-gray-900 dark:text-gray-200 dark:bg-slate-600' => $orderBy == 'titleZa', ' btn-dafault']) >
                                        <span class="sr-only">Ordenar Alfabeticamente descendente</span>
                                        @if ($orderBy == 'titleZa')
                                        <div class="mx-1.5">Za</div>
                                        @else
                                        <div class="mx-1.5">Az</div>

                                        @endif
                                    </button>
                                @else

                                <button type="button" wire:click="changeOrder('titleZa')"
                                        @class(['bg-white text-gray-900 dark:text-gray-200 dark:bg-slate-600' => $orderBy == 'titleAz', ' btn-dafault']) >
                                    <span class="sr-only">Ordenar alfabéticamente ascendente</span>
                                    @if ($orderBy == 'titleZa')
                                    <div class="mx-1.5">Az</div>
                                    @else
                                    <div class="mx-1.5">Az</div>

                                    @endif
                                </button>
                                @endif

                                <button type="button" wire:click="changeOrder('priority')"
                                        @class(['bg-white text-gray-900 dark:text-gray-200 dark:bg-slate-600' => $orderBy == 'priority', 'rounded-r-md btn-dafault']) >
                                    <span class="sr-only">Orde</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                        <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zM12 8.25a.75.75 0 01.75.75v3.75a.75.75 0 01-1.5 0V9a.75.75 0 01.75-.75zm0 8.25a.75.75 0 100-1.5.75.75 0 000 1.5z" clip-rule="evenodd" />
                                      </svg>

                                </button>
                            </span>
                        </div>
                    </div>
                    {{-- end sort --}}

                    {{-- list --}}
                    <ul class="list-none mt-5 divide-y divide-solid text-slate-900 dark:text-gray-100 " wire:transition.opacity >
                        @foreach ($taskList->tasks as $task)

                        @livewire('task', ['task' => $task], , key($task->id))

                        @endforeach
                    </ul>
                    @else
                    <div class="flex justify-center">
                        <span class="text-gray-900 dark:text-gray-100">Crie uma tarefa para começar </span>
                    </div>
                    @endif
                    @endif
                    {{-- end list --}}
                </div>
            </div>
        </div>

</div>
