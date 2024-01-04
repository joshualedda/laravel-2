<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Models\AuditLog;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UpdateUser extends Component
{
    public $userId, $user_id, $confirmPass;
    public $user;
    public $name;
    public $username;
    public $email;
    public $role;
    public $password;

    public function mount($userId)
    {
        $this->user = User::find($userId);
        $this->name = $this->user->name;
        $this->username = $this->user->username;
        $this->email = $this->user->email;
        $this->role = $this->user->role;
    }

    protected $rules = [
        'name' => 'string|max:255',
        'username' => 'string|max:255|unique:users,username',
        'email' => 'string|email|max:255|unique:users,email',
        'role' => 'in:1,0,2',
        'password' => 'nullable|min:8|confirmed',
    ];

    public function updateUser()
    {

        $this->validate();

         $data = [
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'role' => $this->role,
        ];

        if (!empty($this->password)) {
            $data['password'] = Hash::make($this->password);
        }
        $this->user->update($data);
        session()->flash('success', 'User updated successfully!');
        $user = Auth::user();
        AuditLog::create([
            'user_id' => $user->id,
            'action' => 'Updated '. $data,
            'data' => json_encode('Updated by '. $user->name),
        ]);
    }

    public function render()
    {
        return view('livewire.update-user')->extends('layouts.includes.index')
        ->section('content');

    }
}
