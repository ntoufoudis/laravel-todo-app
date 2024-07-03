<?php

namespace App\Livewire;

use Livewire\Component;

class InlineEdit extends Component
{
    public $todo = '';
    public $isEditing = false;

    public function render()
    {
        return view('livewire.inline-edit');
    }
}
