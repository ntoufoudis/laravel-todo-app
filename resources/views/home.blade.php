<x-app-layout>
    <div class="flex w-full min-h-screen items-center justify-center">
        <div class="bg-white/30 rounded-xl p-5">
            <h1 class="text-center text-2xl text-white font-bold">Laravel ToDO App</h1>
            <div class="flex space-x-6 mt-4">
                <a href="{{ route('login') }}" wire:navigate
                   class="h-10 w-24 bg-white/20 rounded p-2 text-white font-bold flex">
                    <x-heroicon-o-arrow-right-end-on-rectangle class="w-6 h-6"/>
                    <span>Login</span>
                </a>
                <button class="h-10 w-24 bg-white/20 rounded p-2 text-white font-bold flex">
                    <x-heroicon-o-user-plus class="w-6 h-6"/>
                    <span>Register</span>
                </button>
            </div>
            <div class="flex mt-4 space-x-6">
                <input class="rounded w-64" placeholder="Search...">
                <select class="rounded w-30">
                    <option value="all">All</option>
                    <option value="active">Active</option>
                    <option value="completed">Completed</option>
                </select>
            </div>
            <div class="grid mt-4 space-y-4">
                <livewire:add-todo/>

                @if($todos === null)
                    <h1>Empty</h1>
                @else
                    @foreach($todos as $todo)
                        <livewire:home :todo="$todo" wire:key={{$todo}}/>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

