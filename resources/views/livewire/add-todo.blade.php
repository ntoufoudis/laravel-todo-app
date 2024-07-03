@guest
    <div class="flex">
        <form wire:submit="sessionAddNew" class="flex space-x-2 items-center">
            <input
                required
                class="w-96 rounded"
                type="text"
                wire:model="todo"
                placeholder="Add new item..."
            >
            <button type="submit">Add</button>
        </form>
    </div>
@endguest
