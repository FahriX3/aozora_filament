<?php

namespace App\Filament\Resources\Events\Schemas;

use Filament\Schemas\Schema;

class EventForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Forms\Components\FileUpload::make('thumbnail')
                    ->image()
                    ->disk('public')
                    ->directory('events/thumbnails')
                    ->maxSize(5120)
                    ->columnSpanFull()
                    ->label('Poster / Thumbnail Event (Foto Utama)'),
                \Filament\Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (string $operation, $state, \Filament\Forms\Set $set) => $operation === 'create' ? $set('slug', \Illuminate\Support\Str::slug($state)) : null),
                \Filament\Forms\Components\TextInput::make('slug')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),
                \Filament\Forms\Components\DateTimePicker::make('event_date')
                    ->required(),
                \Filament\Forms\Components\TextInput::make('location')
                    ->required()
                    ->maxLength(255),
                \Filament\Forms\Components\Select::make('status')
                    ->options([
                        'upcoming' => 'Upcoming',
                        'finished' => 'Finished',
                    ])
                    ->required()
                    ->default('upcoming'),
                \Filament\Forms\Components\Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
                \Filament\Forms\Components\FileUpload::make('documentations')
                    ->multiple()
                    ->disk('public')
                    ->directory('events/documentations')
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'video/mp4'])
                    ->maxSize(20480)
                    ->panelLayout('grid')
                    ->reorderable()
                    ->appendFiles()
                    ->columnSpanFull()
                    ->label('Dokumentasi Event (Drag & Drop banyak Foto / Video)'),
            ]);
    }
}
