<?php

namespace App\Filament\Auth;

use App\Models\User;
use Filament\Auth\Pages\Login as BaseLoginPage;

class Login extends BaseLoginPage
{
    public function mount(): void
    {
        parent::mount();

        if (app()->isProduction()) {
            return;
        }

        $user = User::where('email', 'admin@admin.com')->first();

        if (! $user) {
            $user = User::factory()->admin()->create();
        }

        $this->form->fill([
            'email' => $user->email,
            'password' => 'password',
            'remember' => true,
        ]);
    }
}
