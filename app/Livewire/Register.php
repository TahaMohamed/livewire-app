<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class Register extends Component
{
    use WithFileUploads;

    public $name;

    public $email;

    public $password;

    public $image;

    public $rules = [
        'name' => 'required|string|max:50',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6',
        'image' => 'nullable|mimes:png,jpg,jpeg|max:1024'
    ];

    public function register()
    {
        sleep(2);
        User::create($this->validate());
        $this->reset('email', 'password', 'name', 'image');
        session()->flash('success', __('User Created!'));
    }

    public function render()
    {
        return view('livewire.register');
    }
}
