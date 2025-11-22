<?php

namespace App\Filament\Resources\GemstoneResource\Pages;

use App\Filament\Resources\GemstoneResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateGemstone extends CreateRecord
{
    protected static string $resource = GemstoneResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
