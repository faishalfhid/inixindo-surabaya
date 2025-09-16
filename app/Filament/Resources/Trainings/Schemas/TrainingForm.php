<?php

namespace App\Filament\Resources\Trainings\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;


class TrainingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('instructors')
                    ->relationship('instructors', 'nama')
                    ->multiple()
                    ->preload()
                    ->required()
                    ->label('Pilih Instruktur'),
                TextInput::make('nama_training')
                    ->required(),
                DatePicker::make('tanggal_mulai')
                    ->required(),
                DatePicker::make('tanggal_selesai')
                    ->required(),
                TextInput::make('ruangan')
                    ->default(null),
            ]);
    }
}
