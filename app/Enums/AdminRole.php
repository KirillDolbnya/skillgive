<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum AdminRole: string implements HasColor, HasLabel
{
    case SuperAdmin = 'super_admin';
    case Manager = 'manager';
    case Moderator = 'moderator';

    public function getColor(): string
    {
        return match ($this) {
            self::SuperAdmin => 'danger',
            self::Manager => 'warning',
            self::Moderator => 'success',
        };
    }

    public function getLabel(): string
    {
        return match ($this) {
            self::SuperAdmin => 'Админ',
            self::Manager => 'Менеджер',
            self::Moderator => 'Модератор',
        };
    }
}
