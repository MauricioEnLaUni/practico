<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VentaResource\Pages;
use App\Filament\Resources\VentaResource\RelationManagers;
use App\Models\Venta;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use App\Models\Empleado;
use App\Models\Cliente;

class VentaResource extends Resource
{
    protected static ?string $model = Venta::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make("id_empleado")
                    ->options(Empleado::all()->pluck("nombre", "id"))
                    ->searchable()
                    ->preload(),
                Forms\Components\Select::make("id_cliente")
                    ->options(Cliente::all()->pluck("nombre", "id"))
                    ->searchable()
                    ->preload(),
                Forms\Components\TextInput::make("total")
                    ->numeric()
                    ->required()
                    ->minValue(1),
                Forms\Components\Select::make("estatus")
                    ->options(["Abierta" => 0, "Cobro" => 1, "Cancelada" => 2])
                    ->searchable()
                    ->preload(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make("id_empleado")
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make("id_cliente")
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make("total")
                    ->sortable(),
                Tables\Columns\TextColumn::make("estatus")
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make("created_at")
                    ->sortable(),
                Tables\Columns\TextColumn::make("updated_at")
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListVentas::route('/'),
            'create' => Pages\CreateVenta::route('/create'),
            'edit' => Pages\EditVenta::route('/{record}/edit'),
        ];
    }
}
