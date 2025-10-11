<?php

namespace App\Filament\Resources\MetalResource\Pages;

use App\Filament\Resources\MetalResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMetals extends ListRecords
{
    protected static string $resource = MetalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
