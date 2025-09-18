<?php

namespace App\Filament\Resources\Materials\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class MaterialForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('kode_materi')
                    ->required(),
                TextInput::make('nama')
                    ->required(),
                TextInput::make('status')
                    ->required(),
                TextInput::make('sumber')
                    ->required(),
                TextInput::make('harga')
                    ->required()
                    ->default('0'),
            ]);
    }
}
