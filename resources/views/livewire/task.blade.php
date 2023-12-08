<div>
    <ul class="py-2">
        <button wire:click="toggleTask('{{ $task->id }}')" @class(['line-through' => $task->status]) >
            {{ $task->title  }}
        </button>
    </ul>
</div>
