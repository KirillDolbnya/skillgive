<?php

namespace App\Console\Commands;

use App\Enums\AdminRole;
use Filament\Commands\MakeUserCommand;
use Symfony\Component\Console\Attribute\AsCommand;

use function Laravel\Prompts\select;

#[AsCommand(name: 'make:filament-user', aliases: [
    'filament:make-user',
    'filament:user',
])]
class MakeFilamentUserCommand extends MakeUserCommand
{
    protected function getUserData(): array
    {
        return [
            ...parent::getUserData(),
            'role' => select(
                label: 'Выберите роль',
                options: [
                    AdminRole::SuperAdmin->value => 'Администратор',
                    AdminRole::Manager->value => 'Менеджер',
                    AdminRole::Moderator->value => 'Модератор',
                ],
                default: AdminRole::Moderator->value
            ),
        ];
    }
}
