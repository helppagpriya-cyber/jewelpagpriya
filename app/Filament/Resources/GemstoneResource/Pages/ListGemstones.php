<?php

namespace App\Filament\Resources\GemstoneResource\Pages;

use App\Filament\Resources\GemstoneResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGemstones extends ListRecords
{
    protected static string $resource = GemstoneResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
