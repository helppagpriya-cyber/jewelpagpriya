<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Filament\Notifications\Notification;

class Login extends Component
{
    public $email = '';
    public $password = '';
    public $remember = false;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required',
    ];

    public function mount()
    {
        Notification::make()->success()->title('Test Notification')->send();
    }



    public function login()
    {
        $this->validate();

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            session()->regenerate();

            Notification::make()->success()->title('Welcome back!')->send();

            return $this->redirect(route('home'), navigate: true);
        }

        $this->addError('password', 'The provided credentials are incorrect.');
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
