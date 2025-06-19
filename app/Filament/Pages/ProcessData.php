<?php
namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\RecordData;
use App\Models\APIList;
use Illuminate\Support\Facades\Http;



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

    public array $dataUreaJSON = [];

    public array $cities = [];

    // public array $dataNormalization = [];

    public array $dataTrainTest = [];

    public array $dataForecasting = [];

    public array $dataEvaluation = [];

    public function mount(RecordData $record)
    {

        $apiData = APIList::first();

        $url = $apiData->url;

        $this->record = $record;

        $filePath = storage_path("app/public/" . $record->attachment);

        /// Ambil wilayah dari query string (?wilayah=...)
        $wilayah = request()->query('wilayah'); // bisa null
        $wilayah = ($wilayah === 'ALL' || empty($wilayah)) ? null : $wilayah;


        $response = Http::attach(
            'file',
            file_get_contents($filePath),
            $record->attachment
        )->post( $url . 'api/urea', [
            'wilayah' => $wilayah
        ]);

        $this->dataUreaJSON = $response->json();

        // Panggil endpoint lainnya
        // $response2 = Http::get($url . 'api/normalization');
        // $this->dataNormalization = $response2->json();

        $response3 = Http::attach(
            'file',
            file_get_contents($filePath),
            $record->attachment
        )->post($url . 'api/traintest', [
            'wilayah' => $wilayah
        ]);
        

        $this->dataTrainTest = $response3->json();

        $response4 = Http::attach(
            'file',
            file_get_contents($filePath),
            $record->attachment
        )->post($url . 'api/forecasting', [
            'wilayah' => $wilayah
        ]);

        $this->dataForecasting = $response4->json();

        $response5 = Http::attach(
            'file',
            file_get_contents($filePath),
            $record->attachment
        )->post($url . 'api/evaluation', [
            'wilayah' => $wilayah
        ]);


        $this->dataEvaluation = $response5->json();

        if (!empty($this->dataUreaJSON)) {
            $this->cities = array_filter(array_keys($this->dataUreaJSON[0]), fn($key) => $key !== 'TANGGAL');
        }
    }
}
