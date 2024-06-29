<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Clicker extends Component
{
    use WithPagination;
    public string $title = 'Clicker';
    public string $name = '';
    public string $email = '';
    public string $password = '';


    public function creatNewUser()
    {
        $validated = $this->makeValidation();
        User::create($validated);
        $this->reset(['password', 'email', 'name']);
        session()->flash('success', 'User Created Successfully!');
    }
    public function render()
    {
        return view('livewire.clicker', ['users' => User::latest()->simplePaginate(5)]);
    }

    private function makeValidation()
    {
        return $this->validate([
            'name' => 'required|min:2|max:50',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);
    }
}
