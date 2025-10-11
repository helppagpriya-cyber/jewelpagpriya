<?php

namespace App\Filament\Resources\MetalResource\Pages;

use App\Filament\Resources\MetalResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMetal extends EditRecord
{
    protected static string $resource = MetalResource::class;

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
