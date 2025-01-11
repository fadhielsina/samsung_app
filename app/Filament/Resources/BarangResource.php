<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Barang;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\BarangResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\BarangResource\RelationManagers;

class BarangResource extends Resource
{
    protected static ?string $model = Barang::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('type'),
                TextInput::make('harga'),
                TextInput::make('stok_dbo'),
                TextInput::make('stok_pin'),
                TextInput::make('stok_dpi'),
                TextInput::make('stok_dri'),
                TextInput::make('stok_rkt'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('type')->searchable()->copyable(),
                TextColumn::make('harga')->copyable()
                    ->formatStateUsing(fn(Barang $record): string => '' . number_format($record->harga, 0, '.', '.')),
                TextColumn::make('harga_total')->copyable()
                    ->state(fn(Barang $record): string => '' . number_format($record->harga + 99000, 0, '.', '.')),
                TextColumn::make('stok_dbo')->copyable(),
                TextColumn::make('stok_pin')->copyable(),
                TextColumn::make('stok_dpi')->copyable(),
                TextColumn::make('stok_dri')->copyable(),
                TextColumn::make('stok_rkt')->copyable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                // Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBarangs::route('/'),
            'create' => Pages\CreateBarang::route('/create'),
            'edit' => Pages\EditBarang::route('/{record}/edit'),
        ];
    }
}
