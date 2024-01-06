<?php

namespace App\Livewire;

use Livewire\Component;

class ViewGrantee extends Component
{
    // public $scholarship_type_filter = 0;

    // public function mount()
    // {
    //     $queryParameter = request()->query('scholarship_type');
    //     if (!$queryParameter && request()->get(0)) {
    //         $this->scholarship_type_filter = 0; // Set filter to Government
    //     } else {
    //         $this->scholarship_type_filter = request()->query('scholarship_type', 0);
    //     }
    // }

    public function render()
    {
        return view('livewire.view-grantee')
        ->extends('layouts.includes.index')
        ->section('content');
    }
}
