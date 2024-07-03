<?php

namespace App\Livewire;

use App\Models\Todo;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Home extends Component
{
    #[Validate('required')]
    public $todo = '';

    #[Computed]
    public function todos()
    {
        if (auth()->guest()) {
            return session()->get('todos');
        }
        else
        {
            return Todo::all();
        }
    }

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
        return view('livewire.home');
    }
}
