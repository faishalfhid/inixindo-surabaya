<?php

namespace App\Filament\Resources\TrainingResource\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Forms;
use Filament\Tables;
use Filament\Tables\Table;

use Filament\Actions\CreateAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\Action as TableAction;
use Filament\Actions\DeleteBulkAction;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;

use Illuminate\Support\Facades\Mail;
use App\Mail\ParticipantInvitation;

class ParticipantsRelationManager extends RelationManager
{
    protected static string $relationship = 'participants';
    protected static ?string $recordTitleAttribute = 'name';

    public function form(Schema $schema): Schema
    {
        return $schema->components([
            Forms\Components\TextInput::make('name')->required()->maxLength(255),
            Forms\Components\TextInput::make('email')->email()->required()->maxLength(255),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('email')->sortable()->searchable(),
                IconColumn::make('confirmed_at')->boolean()->label('Confirmed'),
                TextColumn::make('created_at')->dateTime()->label('Didaftarkan'),
            ])
            ->headerActions([
                CreateAction::make()->label('Tambah Peserta'),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
                TableAction::make('resend')
                    ->label('Resend Invite')
                    ->requiresConfirmation()
                    ->action(function ($record) {
                        Mail::to($record->email)->queue(new ParticipantInvitation($record));
                    }),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ]);
    }
}
