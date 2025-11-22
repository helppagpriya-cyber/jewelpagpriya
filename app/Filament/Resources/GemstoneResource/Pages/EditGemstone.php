<?php

namespace App\Filament\Resources\GemstoneResource\Pages;

use App\Filament\Resources\GemstoneResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGemstone extends EditRecord
{
    protected static string $resource = GemstoneResource::class;

//    protected function getHeaderActions(): array
//    {
//        return [
//            Actions\DeleteAction::make(),
//        ];
//    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
