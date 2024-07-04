<?php

namespace App\Livewire;

use App\Models\Todo;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Home extends Component
{
    #[Validate('required')]
    public $todo = '';

    #[Url]
    public $search = '';

    #[Url]
    public $filter = 'all';

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

    #[Computed]
    public function todos()
    {
        if(auth()->user()){
            if ($this->filter === 'all') {
                $todos = Todo::where([
                    ['user_id', auth()->user()->id],
                    ['text', 'like', '%' . $this->search . '%'],
                ])
                    ->get();
            } elseif ($this->filter === 'active') {
                $todos = Todo::where([
                    ['user_id', auth()->user()->id],
                    ['text', 'like', '%' . $this->search . '%'],
                    ['completed', '=', false],
                ])
                    ->get();
            } elseif ($this->filter === 'completed') {
                $todos = Todo::where([
                    ['user_id', auth()->user()->id],
                    ['text', 'like', '%' . $this->search . '%'],
                    ['completed', '=', true],
                ])
                    ->get();
            }
        }
        else {
            $todos = [];
        }
        return $todos;

    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.home');
    }
}
