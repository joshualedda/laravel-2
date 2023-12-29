<?php

namespace App\Livewire;

use Livewire\Component;

class StudentAdd extends Component
{
    public function render()
    {
        return view('livewire.student-add')->extends('layouts.includes.index')->section('content');
    }
}
