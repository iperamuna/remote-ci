<?php

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Url;
use Livewire\Attributes\{ Layout, Title, Validate };
use Livewire\Volt\Component;
use App\Models\User;

new class extends Component {

    #[Validate('required|email')]
    public string $email = '';

    #[Validate('required')]
    public string $password = '';

    #[Layout('components.layouts.guest')]
    #[Title('Login')]
    #[Url]
    public string $redirect_url = '/dashboard';

    public function login()
    {
        $credentials = $this->validate();

        if (Auth::attempt($credentials)) {

            request()->session()->regenerate();
            return redirect()->intended($this->redirect_url);
        }

        session()->flash('error-msg', 'Invalid Credentials.');
    }

}; ?>

<div>
    <div class="max-w-sm lg:mx-40 lg:ml-40">
        <img src="/login.png" width="200" class="mx-auto" />

        <div>
            @if (session()->has('error-msg'))
            <x-alert icon="o-exclamation-triangle" class="alert-danger">
                {{ session('error-msg') }}
            </x-alert>
            @endif
        </div>
        <x-form wire:submit="login">
            <x-input label="E-mail" wire:model="email" value="random@random.com" icon="o-envelope" inline />
            <x-input label="Password" wire:model="password" value="random" type="password" icon="o-key" inline />

            <x-slot:actions>
                <x-button label="Login" type="submit" icon="o-paper-airplane" class="btn-primary" spinner="login" />
            </x-slot:actions>
        </x-form>
    </div>
</div>