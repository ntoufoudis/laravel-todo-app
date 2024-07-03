<?php

namespace App\Livewire;

use App\Models\Todo;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Home extends Component
{
    #[Validate('required')]
    public $todo = '';

    public $search = '';
    public $filter = 'all';

    public function sessionAddNew(): void
    {
        $this->validate();

        session()->push('todos', $this->todo);
        session()->put($this->todo, 0);

        $this->reset();

        $this->redirectRoute('home', navigate: true);
    }

    public function addNew(): void
    {
        $this->validate();

        Todo::create([
            'text' => $this->todo,
            'user_id' => auth()->user()->id,
            'completed' => false,
        ]);

        $this->reset();

        $this->redirectRoute('home', navigate: true);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        if ($this->filter === 'all') {
            $todos = Todo::where('text', 'like', '%' . $this->search . '%')
                ->get();
        } elseif ($this->filter === 'active') {
            $todos = Todo::where([
                ['text', 'like', '%' . $this->search . '%'],
                ['completed', '=', false],
            ])
                ->get();
        } elseif ($this->filter === 'completed') {
            $todos = Todo::where([
                ['text', 'like', '%' . $this->search . '%'],
                ['completed', '=', true],
            ])
                ->get();
        }

        return view('livewire.home', [
            'todos' => $todos,
        ]);
    }
}
