<?php

namespace App\Filament\Resources\Materials\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Support\RawJs;
use Filament\Forms\Components\Select;



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
                Select::make('status')
                    ->required()
                    ->options([
                        'Pre Order' => 'Pre Order',
                        'Opsi 2' => 'Opsi 2',
                        'Opsi 3' => 'Opsi 3',
                    ]),
                Select::make('sumber')
                    ->required()
                    ->options([
                        'Holding' => 'Holding',
                        'Authorized' => 'Authorized',
                        'Opsi 3' => 'Opsi 3',
                    ]),
                TextInput::make('harga')
                    ->required()
                    ->prefix('Rp')
                    ->mask(RawJs::make('$money($input)'))
                    ->stripCharacters(',')
                    ->numeric(),
            ]);
    }
}
