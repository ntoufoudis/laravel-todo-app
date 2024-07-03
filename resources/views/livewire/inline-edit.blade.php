<div x-show=isEditing class="flex flex-col">
    @dd($todo)
    <form class="flex" wire:submit="save">
        <input
            value="{{ $todo }}"
            shadowless
            type="text"
            class="border-0 truncate focus:border-lh-yellow focus:ring
                                                focus:ring-lh-yellow focus:ring-opacity-50 h-7 rounded text-sm"
            x-ref="textInput"
            wire:model.lazy="newTodo"
            x-on:keydown.enter="isEditing = false"
            x-on:keydown.escape="isEditing = false"
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
        ><x-heroicon-o-check class="w-8 h-8 text-green-500"/></button>
    </form>
    <small class="text-xs">Enter to save, Esc to cancel</small>
</div>
