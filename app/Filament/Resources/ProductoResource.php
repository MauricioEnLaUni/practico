<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductoResource\Pages;
use App\Filament\Resources\ProductoResource\RelationManagers;
use App\Models\Producto;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductoResource extends Resource
{
    protected static ?string $model = Producto::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make("descripcion")
                    ->required()
                    ->maxLength(45)
                    ->minLength(3),
                Forms\Components\TextInput::make("costo")
                    ->numeric()
                    ->required()
                    ->minValue(1),
                Forms\Components\TextInput::make("precio")
                    ->numeric()
                    ->required()
                    ->minValue(1),
                Forms\Components\TextInput::make("existencia")
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make("descripcion")
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make("costo")
                    ->sortable(),
                Tables\Columns\TextColumn::make("precio")
                    ->sortable(),
                Tables\Columns\TextColumn::make("existencia")
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
                Tables\Actions\DeleteAction::make()
                    ->action(function ($data, $record) {
                        if ($record->venta()->count() > 0) {
                            Notification::make()
                                ->danger()
                                ->title("¡No se puede eliminar empleados con ventas!")
                                ->body("Borre la venta primero.")
                                ->send();
                            return;
                        }

                            Notification::make()
                                ->success()
                                ->title()
                                ->body()
                                ->send();
                            $record->delete();
                        }
                    ),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                    ->action(function ($data, $record) {
                        if ($record->venta()->count() > 0) {
                            Notification::make()
                                ->danger()
                                ->title("¡No se puede eliminar empleados con ventas!")
                                ->body("Borre la venta primero.")
                                ->send();
                            return;
                        }

                            Notification::make()
                                ->success()
                                ->title()
                                ->body()
                                ->send();
                            $record->delete();
                        }
                    ),
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
            'index' => Pages\ListProductos::route('/'),
            'create' => Pages\CreateProducto::route('/create'),
            'edit' => Pages\EditProducto::route('/{record}/edit'),
        ];
    }
}
