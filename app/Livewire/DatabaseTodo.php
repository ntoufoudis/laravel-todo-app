<?php

namespace App\Livewire;

use App\Models\Todo;
use Livewire\Attributes\Validate;
use Livewire\Component;

class DatabaseTodo extends Component
{
    #[Validate('required')]
    public $newTodo;

    public $todo = '';

    public function delete($todo): void
    {
        Todo::destroy($todo);

        $this->redirectIntended('/', true);
    }

    public function completed($todo): void
    {
        $todo = Todo::find($todo);

        if ($todo->completed) {
            $todo->completed = false;
        }
        else {
            $todo->completed = true;
        }

        $todo->save();

        $this->redirectIntended('/', true);
    }


    public function editTodo($todo): void
    {
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
