<?php

namespace App\Livewire;

use Livewire\Attributes\Validate;
use Livewire\Component;

class AddTodo extends Component
{
    #[Validate('required')]
    public $todo = '';

    public function sessionAddNew(): void
    {
        $this->validate();

        session()->push('todos', $this->todo);
        session()->put($this->todo, 0);

        $this->reset();

        $this->redirectIntended('/', true);
    }

    public function render()
    {
        return view('livewire.add-todo');
    }
}
