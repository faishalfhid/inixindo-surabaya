<?php

namespace App\Filament\Resources\Trainings\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TrainingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_training')
                    ->searchable(),
                
                TextColumn::make('perie')
                    ->label('Periode Pelatihan')
                    ->getStateUsing(function ($record) {
                        $mulai = \Carbon\Carbon::parse($record->tanggal_mulai)->format('d/m/Y');
                        $selesai = \Carbon\Carbon::parse($record->tanggal_selesai)->format('d/m/Y');
                        $hari = \Carbon\Carbon::parse($record->tanggal_mulai)->diffInDays(\Carbon\Carbon::parse($record->tanggal_selesai)) + 1;
                        $hari_text = $hari . ' hari';
                        return "{$mulai} - {$selesai} ({$hari_text})";
                    })
                    ->sortable(),

                TextColumn::make('ruangan')
                    ->searchable(),

            ])
            ->filters([
                //
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
