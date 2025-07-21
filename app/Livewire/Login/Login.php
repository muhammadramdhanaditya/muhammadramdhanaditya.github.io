<?php

namespace App\Livewire\Login;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{
    public $email, $password;


    public function render()
    {
        return view('livewire.login.login');
    }

    public function storeLogin()
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            session()->regenerate();
            return redirect()->intended('admin');
        }

        $this->addError('email', 'Email atau password salah');
    }
}
