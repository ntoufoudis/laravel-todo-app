<div
    x-data="
        {
            isEditing: false,
            isName: 'Name',
            focus: function() {
                const textInput = this.$refs.textInput;
                textInput.focus();
                textInput.select();
            }
        }
    "
    x-cloak
>
    <div
        x-show=!isEditing
        class="bg-white/40 h-10 w-full flex items-center px-4 justify-between"
    >

            <span
                x-on:click="isEditing = true; $nextTick(() => focus())"
                class="{{ ($todo->completed === 1) ? 'line-through' : '' }}"
            >
            {{ $todo->text }}
        </span>

        <div class="flex space-x-2">
            <x-heroicon-s-pencil class="w-4 h-4 text-blue-600"/>
            <x-heroicon-s-trash
                wire:click="delete('{{$todo->id}}')"
                class="w-4 h-4 text-red-600"
            />

                @if($todo->completed === 1)
                    <x-heroicon-o-x-circle
                        wire:click="completed('{{$todo->id}}')"
                        class="w-4 h-4 text-red-600"
                    />
                @else
                    <x-heroicon-o-check
                        wire:click="completed('{{$todo->id}}')"
                        class="w-4 h-4 text-green-600"
                    />
                @endif

        </div>
    </div>
    <div x-show=isEditing class="flex flex-col">
        @php $this->newTodo = $todo->text @endphp
        <form class="flex" wire:submit="editTodo('{{$todo->id}}')">
            <input
                shadowless
                type="text"
                class="border-0 truncate focus:border-lh-yellow focus:ring
                                                focus:ring-lh-yellow focus:ring-opacity-50 h-7 rounded text-sm"
                x-ref="textInput"
                wire:model="newTodo"
                x-on:keydown.enter="isEditing = false"
                x-on:keydown.escape="isEditing = false"
                x-on:click.away="isEditing = false"
            />
            <button
                type="button"
                class=""
                title="Cancel"
                x-on:click="isEditing = false"
            >
                <x-heroicon-o-x-mark class="w-8 h-8 text-red-500"/>
            </button>
            <button
                type="submit"
                class=""
                title="Save"
                x-on:click="isEditing = false"
            >
                <x-heroicon-o-check class="w-8 h-8 text-green-500"/>
            </button>
        </form>
        <small class="text-xs">Enter to save, Esc to cancel</small>
    </div>
</div>
