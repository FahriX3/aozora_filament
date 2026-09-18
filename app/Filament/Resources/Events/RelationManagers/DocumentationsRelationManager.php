<?php

namespace App\Filament\Resources\Events\RelationManagers;

use Filament\Actions\AssociateAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateAction;
use Filament\Actions\DissociateBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class DocumentationsRelationManager extends RelationManager
{
    protected static string $relationship = 'documentations';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Forms\Components\FileUpload::make('file_path')
                    ->directory('documentations')
                    ->required()
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'video/mp4'])
                    ->maxSize(20480), // 20MB
                \Filament\Forms\Components\Select::make('type')
                    ->options([
                        'image' => 'Image',
                        'video' => 'Video',
                    ])
                    ->required()
                    ->default('image'),
                \Filament\Forms\Components\TextInput::make('caption')
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('caption')
            ->columns([
                \Filament\Tables\Columns\ImageColumn::make('file_path')
                    ->label('Preview')
                    ->defaultImageUrl(url('/placeholder.png')),
                \Filament\Tables\Columns\TextColumn::make('type')
                    ->badge()
                    ->colors([
                        'primary' => 'image',
                        'danger' => 'video',
                    ]),
                \Filament\Tables\Columns\TextColumn::make('caption')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                \Filament\Tables\Actions\Action::make('bulk_upload')
                    ->label('Upload Media (Bulk)')
                    ->icon('heroicon-m-arrow-up-tray')
                    ->color('primary')
                    ->form([
                        \Filament\Forms\Components\FileUpload::make('files')
                            ->label('Upload Multiple Photos/Videos')
                            ->multiple()
                            ->directory('documentations')
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'video/mp4'])
                            ->maxSize(20480)
                            ->required(),
                        \Filament\Forms\Components\TextInput::make('caption')
                            ->label('Caption (Optional)')
                            ->helperText('This caption will be applied to all uploaded files in this batch.')
                            ->maxLength(255),
                    ])
                    ->action(function (array $data, RelationManager $livewire): void {
                        foreach ($data['files'] as $file) {
                            $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                            $type = in_array($ext, ['mp4', 'webm', 'ogg']) ? 'video' : 'image';
                            
                            $livewire->getOwnerRecord()->documentations()->create([
                                'file_path' => $file,
                                'type' => $type,
                                'caption' => $data['caption'] ?? null,
                            ]);
                        }
                    }),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
