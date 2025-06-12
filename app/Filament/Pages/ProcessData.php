<?php
namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\RecordData;

class ProcessData extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.process-data';

    protected static bool $shouldRegisterNavigation = false;

    public ?RecordData $record;

    public static function getRouteName(?string $panel = null): string
    {
        return 'filament.admin.pages.process-data';
    }

    public static function getRoutePath(?string $panel = null): string
    {
        return 'process-data/{record}';
    }

    public static function route(?string $panel = null): \Illuminate\Routing\Route
    {
        return parent::route($panel)->whereNumber('record');
    }

    public function mount(RecordData $record): void
    {
        $this->record;
    }
}
