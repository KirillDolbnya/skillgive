<?php

namespace App\Filament\Resources\Admins\Schemas;

use App\Enums\AdminRole;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Имя')
                    ->required(),
                TextInput::make('email')
                    ->label('Почта')
                    ->email()
                    ->unique()
                    ->validationMessages([
                        'unique' => 'Пользователь с таким email уже существует.',
                        'email' => 'Введите корректный адрес электронной почты.',
                        'required' => 'Поле Email обязательно для заполнения.',
                    ])
                    ->required(),
                Select::make('role')
                    ->label('Роль')
                    ->options(AdminRole::class)
                    ->required(),
                TextInput::make('password')
                    ->label('Пароль')
                    ->password()
                    ->revealable()
                    ->dehydrateStateUsing(fn (string $state): string => Hash::make($state))
                    ->dehydrated(fn (?string $state): bool => filled($state))
                    ->required(fn (string $operation): bool => $operation === 'create')
                    ->suffixAction(
                        Action::make('generatePassword')
                            ->icon('heroicon-m-key')
                            ->tooltip('Сгенерировать пароль')
                            ->action(function (Set $set) {
                                $set('password', Str::password(12));
                            })
                    ),
            ]);
    }
}
