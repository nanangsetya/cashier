<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth as FacadesAuth;
use Livewire\Component;

class Auth extends Component
{
    public $username, $password;

    public function render()
    {
        return view('livewire.auth');
    }

    public function login()
    {
        $this->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (FacadesAuth::attempt(['username' => $this->username, 'password' => $this->password])) {
            return redirect('cart');
        }
        session()->flash('failed', 'Login failed.');
    }
}
