<?php

namespace App\Filament\Resources\ClienteResource\Pages;

use App\Filament\Resources\ClienteResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditCliente extends EditRecord
{
    protected static string $resource = ClienteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
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
        ];
    }
}
