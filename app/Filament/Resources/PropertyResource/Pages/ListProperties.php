<?php

namespace App\Filament\Resources\PropertyResource\Pages;

use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\PropertyResource;

class ListProperties extends ListRecords
{
    protected static string $resource = PropertyResource::class;
}
