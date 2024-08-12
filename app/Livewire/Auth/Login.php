<?php

namespace App\Livewire\Auth;

use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Login | RuxenShop')]

class Login extends Component
{
    public $email;
    public $password;

    public function login()
    {
        $this->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8',
        ]);

        if (!auth()->attempt(['email' => $this->email, 'password' => $this->password])) {
            throw ValidationException::withMessages([
                'password' => trans('auth.failed'),
            ]);
        }

        return redirect()->intended();
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
