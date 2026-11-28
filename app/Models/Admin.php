<?php

namespace App\Models;

use App\Enums\AdminRole;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property AdminRole $role
 */
class Admin extends Authenticatable implements FilamentUser
{
    use CanResetPassword, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'role' => AdminRole::class,
        ];
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }
}
