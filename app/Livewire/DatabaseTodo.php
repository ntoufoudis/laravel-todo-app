<?php

namespace App\Livewire;

use App\Models\Todo;
use Livewire\Attributes\Validate;
use Livewire\Component;

class DatabaseTodo extends Component
{
    #[Validate('required')]
    public $newTodo = '';

    public $todo = '';

    public function delete($todo): void
    {
        Todo::destroy($todo);

        $this->redirectIntended('/', true);
    }

    public function completed($todo): void
    {
        $todo = Todo::find($todo);

        if ($todo->completed === 1) {
            $todo->completed = 0;
        }
        else {
            $todo->completed = 1;
        }

        $todo->save();

        $this->redirectIntended('/', true);
    }


    public function editTodo($todo): void
    {
        $this->validate();

        $todo = Todo::find($todo);
        $todo->text = $this->newTodo;

        $todo->save();

        $this->redirectIntended('/', true);
    }

    public function render()
    {
        return view('livewire.database-todo');
    }
}
