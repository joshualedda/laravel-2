<?php

namespace App\Livewire;

use App\Models\Student;
use Livewire\Component;
use App\Traits\Variables;

class EditGrantee extends Component
{
    use Variables;
    public $editId;
    public $editStudent;

    public function mount($editId)
    {
        $this->editStudent = Student::findOrFail($editId);
        $this->lastname = $this->editStudent->lastname;
    }
    public function render()
    {
        return view('livewire.edit-grantee')
        ->extends('layouts.includes.index')
        ->section('content');
    }
}
