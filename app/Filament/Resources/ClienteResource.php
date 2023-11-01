<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClienteResource\Pages;
use App\Filament\Resources\ClienteResource\RelationManagers;
use Filament\Notifications\Notification;

use App\Models\Cliente;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ClienteResource extends Resource
{
    protected static ?string $model = Cliente::class;

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
                Forms\Components\TextInput::make("direccion")
                    ->required()
                    ->maxLength(100)
                    ->minLength(3),
                Forms\Components\TextInput::make("email")
                    ->required()
                    ->maxLength(45)
                    ->minLength(3)
                    ->unique(ignorable: fn ($record) => $record),
                Forms\Components\TextInput::make("usuario")
                    ->required()
                    ->maxLength(45)
                    ->minLength(3)
                    ->unique(ignorable: fn ($record) => $record),
                Forms\Components\DatePicker::make("fecha_nacimiento")
                    ->maxDate(now())
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
                Tables\Columns\TextColumn::make("direccion")
                    ->searchable(),
                Tables\Columns\TextColumn::make("email")
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make("usuario")
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
                Tables\Actions\DeleteAction::make()
                    ->action(function ($data, $record) {
                        if ($record->venta()->count() > 0) {
                            Notification::make()
                                ->danger()
                                ->title("¡No se puede eliminar clientes con ventas!")
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
            'index' => Pages\ListClientes::route('/'),
            'create' => Pages\CreateCliente::route('/create'),
            'edit' => Pages\EditCliente::route('/{record}/edit'),
        ];
    }
}
