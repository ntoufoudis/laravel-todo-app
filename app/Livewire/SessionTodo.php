<?php

namespace App\Livewire;

use App\Models\Todo;
use Livewire\Attributes\Validate;
use Livewire\Component;

class SessionTodo extends Component
{
    #[Validate('required')]
    public $newTodo;

    public $todo = '';

    public function sessionDelete($todo): void
    {
        $todos = session()->pull('todos');

        if(($key = array_search($todo, $todos)) !== false) {
            unset($todos[$key]);
        }

        session()->put('todos', $todos);

        session()->forget($todo);

        $this->redirectIntended('/', true);
    }

    public function sessionCompletedTodo($todo): void
    {
        $completed = session()->pull($todo);

        if ($completed === 0) {
            session()->forget($todo);

            session()->put($todo, 1);
        }
        elseif ($completed === 1) {
            session()->forget($todo);

            session()->put($todo, 0);
        }
    }

    public function sessionEditTodo($todo): void
    {
        $this->sessionDeleteTodo($todo);
        $this->sessionAddTodo($this->newTodo);
        $this->redirectIntended('/', true);

    }

    private function sessionAddTodo($todo): void
    {
        $this->validateOnly($todo);

        session()->push('todos', $todo);
        session()->put($todo, 0);

        $this->reset();
    }

    private function sessionDeleteTodo($todo): void
    {
        $todos = session()->pull('todos');

        if(($key = array_search($todo, $todos)) !== false) {
            unset($todos[$key]);
        }

        session()->put('todos', $todos);

        session()->forget($todo);
    }

    public function render()
    {
        return view('livewire.session-todo');
    }
}
