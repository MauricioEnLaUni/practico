<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmpleadoResource\Pages;
use App\Filament\Resources\EmpleadoResource\RelationManagers;
use App\Models\Empleado;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EmpleadoResource extends Resource
{
    protected static ?string $model = Empleado::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make("nombre")
                    ->required()
                    ->maxLength(45)
                    ->minLength(3),
                Forms\Components\TextInput::make("apellido")
                    ->required()
                    ->maxLength(45)
                    ->minLength(3),
                Forms\Components\TextInput::make("telefono")
                    ->required()
                    ->maxLength(20)
                    ->minLength(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make("nombre")
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make("apellido")
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make("telefono")
                    ->searchable()
                    ->tel(),
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
            'index' => Pages\ListEmpleados::route('/'),
            'create' => Pages\CreateEmpleado::route('/create'),
            'edit' => Pages\EditEmpleado::route('/{record}/edit'),
        ];
    }
}
