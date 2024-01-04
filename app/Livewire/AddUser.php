<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Models\AuditLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AddUser extends Component
{
    public $name, $username, $email, $role, $password;
    public function addUser()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|email|unique:users',
            'role' => 'required|in:1,0,2',
            'password' => 'required|string|min:8',
        ]);
        User::create([
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'role' => $this->role, 
            'password' => Hash::make($this->password),
        ]);

        session()->flash('success', 'User created successfully!');
        $user = Auth::user();
        AuditLog::create([
            'user_id' => $user->id,
            'action' => 'Added: '. $this->name,
            'data' => json_encode('Added by '. $user->name),
        ]);

        $this->reset();
    }

    public function render()
    {
        return view('livewire.add-user')
        ->extends('layouts.includes.index')
        ->section('content');
    }
}
