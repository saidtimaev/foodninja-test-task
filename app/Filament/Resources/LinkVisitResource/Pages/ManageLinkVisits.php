<?php

namespace App\Filament\Resources\LinkVisitResource\Pages;

use App\Filament\Resources\LinkVisitResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageLinkVisits extends ManageRecords
{
    protected static string $resource = LinkVisitResource::class;

    protected function getHeaderActions(): array
    {
        return [
        ];
    }
}
