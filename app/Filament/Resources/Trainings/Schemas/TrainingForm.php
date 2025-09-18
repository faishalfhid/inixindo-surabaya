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
                Select::make('materials')
                    ->label('Materi')
                    ->multiple()
                    ->preload()
                    ->relationship('materials', 'nama')
                    ->required(),
                DatePicker::make('tanggal_mulai')
                    ->required()
                    ->afterOrEqual('today'),
                DatePicker::make('tanggal_selesai')
                    ->required()
                    ->afterOrEqual('tanggal_mulai'),
                TextInput::make('ruangan')
                    ->default(null),
            ]);
    }
}
