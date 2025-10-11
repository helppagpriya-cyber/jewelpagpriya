<?php

namespace App\Filament\Resources\MetalResource\Pages;

use App\Filament\Resources\MetalResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMetal extends CreateRecord
{
    protected static string $resource = MetalResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
