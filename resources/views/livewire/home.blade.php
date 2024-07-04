<div>
    <h1 class="text-center text-2xl text-white font-bold">Laravel ToDO App</h1>
    <div class="flex space-x-6 mt-4">
        @auth
            <form method="POST" action="{{ route('logout') }}" x-data>
                @csrf
                <a
                    href="{{ route('logout') }}"
                    @click.prevent="$root.submit()"
{{--                    wire:navigate--}}
                    class="h-10 w-24 bg-white/20 rounded p-2 text-gray-600 font-semibold flex hover:text-black hover:bg-white/50"
                >
                    <x-heroicon-o-arrow-left-end-on-rectangle class="w-6 h-6"/>
                    <span>Logout</span>
                </a>
            </form>

        @else
        <a
            href="{{ route('login') }}"
            wire:navigate
            class="h-10 w-24 bg-white/20 rounded p-2 text-gray-600 font-semibold flex hover:text-black hover:bg-white/50"
        >
            <x-heroicon-o-arrow-right-end-on-rectangle class="w-6 h-6"/>
            <span>Login</span>
        </a>
        <a
            href="{{ route('register') }}"
            wire:navigate
            class="h-10 w-24 bg-white/20 rounded p-2 flex text-gray-600 font-semibold hover:text-black hover:bg-white/50"
        >
            <x-heroicon-o-user-plus class="w-6 h-6"/>
            <span>Register</span>
        </a>
            @endauth
    </div>
    @guest
        <div class="flex items-center justify-center">
            <span class="mt-4 font-bold text-black">Please Login To Use The App</span>
        </div>
    @else
    <div class="flex mt-4 space-x-6">
        <input
            wire:model.live.debounce.300ms="search"
            type="text"
            placeholder="Search..."
            class="rounded w-64"
        >
        <select wire:model="filter" class="rounded w-30">
            <option value="all">All</option>
            <option value="active">Active</option>
            <option value="completed">Completed</option>
        </select>
    </div>
    <div class="grid mt-4 space-y-4">
        <div class="flex">
            <form wire:submit="addNew" class="flex space-x-2 items-center">
                <input
                    autofocus
                    required
                    class="w-96 rounded"
                    type="text"
                    wire:model="todo"
                    placeholder="Add new item..."
                >
                <button type="submit">Add</button>
            </form>
        </div>

            @foreach($this->todos as $todo)
                <livewire:database-todo :todo="$todo" wire:key={{$todo}}/>
            @endforeach
        @endguest
    </div>
</div>

