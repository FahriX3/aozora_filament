<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                \Filament\Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                \Filament\Forms\Components\TextInput::make('password')
                    ->password()
                    ->dehydrated(fn ($state) => filled($state))
                    ->required(fn (string $context): bool => $context === 'create'),
                \Filament\Forms\Components\Select::make('role')
                    ->options([
                        'admin' => 'Admin',
                        'member' => 'Member',
                    ])
                    ->required()
                    ->default('member'),
            ]);
    }
}
