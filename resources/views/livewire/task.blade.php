<div>
    <li class="py-2" :key="$task->id">
        <button wire:click="toggleTask('{{ $task->id }}')" @class(['line-through decoration-2' => $task->status, 'font-bold text-lg']) >
            @if ($task->status ==  true)
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mr-1 inline w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>

              @else
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class=" mr-1 inline w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" fill=""/>                </svg>
            @endif
        {{ $task->title  }}

    </button>
        @if ($task->description)
            <div class="relative mt-1.5  inset-0 flex flex-wrap items-center" aria-hidden="true">
                <div class="w-full border-t dark:border-gray-500"></div>
                <div class="w-full " @class(['line-through decoration-2' => $task->status])>
                    {{ $task->description  }}
                </div>
            </div>
        @endif
    </li>
</div>
