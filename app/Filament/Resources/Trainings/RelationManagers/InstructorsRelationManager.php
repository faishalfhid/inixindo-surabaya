<?php
namespace App\Filament\Resources\Trainings\RelationManagers;

use App\Filament\Resources\Instructors\InstructorResource;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\AttachAction;
use Filament\Tables\Actions\DetachAction;

class InstructorsRelationManager extends RelationManager
{
    protected static string $relationship = 'instructors';
    protected static ?string $relatedResource = InstructorResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')->label('Nama'),
                Tables\Columns\TextColumn::make('email')->label('Email'),
            ])
            ->headerActions([
                AttachAction::make()->label('Tambah Instruktur'),
            ])
            ->actions([
                DetachAction::make()->label('Hapus'),
            ])
            ->bulkActions([
                Tables\Actions\DetachBulkAction::make()->label('Hapus Terpilih'),
            ]);
    }
}
