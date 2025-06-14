<x-filament-panels::page>
    <h1 class="text-2xl font-bold">Detail Dataset</h1>

    <div class="mt-4 space-y-2">
        <p><strong>ID:</strong> {{ $record->id }}</p>
        <p><strong>Title:</strong> {{ $record->title }}</p>
        <p><strong>Attachment:</strong> {{ $record->attachment }}</p>
    </div>

    <div class="mb-4 flex items-end gap-2">
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Pilih Wilayah:</label>
            <select x-model="selectedRegion"
                class="block w-full rounded-md border-gray-300 shadow-sm focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-800 dark:text-white">
                <option value="ALL">Semua Wilayah</option>
                @foreach([
                    'BANDUNG', 'BANDUNG BARAT', 'BEKASI', 'BOGOR', 'CIAMIS', 'CIANJUR', 'CIREBON', 'GARUT',
                    'INDRAMAYU', 'KARAWANG', 'KUNINGAN', 'MAJALENGKA', 'PURWAKARTA', 'SUBANG', 'SUKABUMI', 'SUMEDANG',
                    'TASIKMALAYA', 'KOTA BANDUNG', 'KOTA BANJAR', 'KOTA BEKASI', 'KOTA CIMAHI', 'KOTA CIREBON',
                    'KOTA DEPOK', 'KOTA SUKABUMI', 'KOTA TASIKMALAYA', 'KOTA BOGOR', 'PANGANDARAN'
                    ] as $region)
                    <option value="{{ $region }}">{{ $region }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-1">
            <x-filament::button color="warning" @click="processRegion">
                Proses
            </x-filament::button>
        </div>
    </div>




    <div x-data="{ section: 'missing' }" class="mt-8 mb-8">
        <!-- BUTTONS -->
        <div class="flex flex-wrap gap-4 mb-6">
            <x-filament::button color="primary" @click="section = 'missing'">
                Missing Value
            </x-filament::button>

            <x-filament::button color="info" @click="section = 'normalization'">
                Normalitation
            </x-filament::button>

            <x-filament::button color="success" @click="section = 'train_test'">
                Train & Test
            </x-filament::button>

            <x-filament::button color="warning" @click="section = 'forecast_graph'">
                Grafik Forecasting
            </x-filament::button>

            <x-filament::button color="gray" @click="section = 'evaluation'">
                Table Evaluasi
            </x-filament::button>
        </div>

        <!-- SECTION CONTENT -->
        <div x-show="section === 'missing'" x-transition>
            <h2 class="text-xl font-semibold mb-4">Check Data Missing Value</h2>

            <div class="overflow-x-auto rounded-lg shadow border border-gray-200 dark:border-gray-700">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 text-sm">
                    <thead class="bg-gray-100 dark:bg-gray-800">
                        <tr>
                            <th class="px-4 py-2 font-medium text-left text-gray-700 dark:text-gray-300">No</th>
                            <th class="px-4 py-2 font-medium text-left text-gray-700 dark:text-gray-300">TANGGAL</th>
                            @foreach([
                                'BANDUNG', 'BANDUNG BARAT', 'BEKASI', 'BOGOR', 'CIAMIS', 'CIANJUR', 'CIREBON', 'GARUT',
                                'INDRAMAYU',
                                'KARAWANG', 'KUNINGAN', 'MAJALENGKA', 'PURWAKARTA', 'SUBANG', 'SUKABUMI', 'SUMEDANG',
                                'TASIKMALAYA',
                                'KOTA BANDUNG', 'KOTA BANJAR', 'KOTA BEKASI', 'KOTA CIMAHI', 'KOTA CIREBON', 'KOTA
                                DEPOK',
                                'KOTA SUKABUMI', 'KOTA TASIKMALAYA', 'KOTA BOGOR', 'PANGANDARAN', 'TOTAL'
                                ] as $column)
                                <th class="px-4 py-2 font-medium text-left text-gray-700 dark:text-gray-300">
                                    {{ $column }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                        @foreach([
                            ['2019-01-31 00:00:00', 2100, 1300, 2450, 1100, 1200, 2800, 6000, 4700, 12000, 7200, 1800,
                            3100, 1100,
                            6600, 3000, 1500, 2300, 40, 150, 12, 9, 6, '-', 70, 310, '-', 640, 62550],
                            ['2019-02-28 00:00:00', 2000, 1400, 2500, 1150, 1250, 2850, 6100, 4600, 12300, 7100, 1900,
                            3150, 1080,
                            6700, 3050, 1480, 2400, 35, 165, 11, 8, 7, '-', 72, 320, '-', 660, 63020],
                            ['2019-03-31 00:00:00', 2200, 1500, 2600, 1120, 1220, 2900, 6200, 4800, 12100, 7300, 1850,
                            3120, 1090,
                            6680, 3080, 1470, 2350, 38, 158, 13, 10, 6, '-', 74, 315, '-', 655, 62980],
                            ['2019-04-30 00:00:00', 2150, 1450, 2480, 1170, 1230, 2950, 6050, 4750, 11900, 7250, 1870,
                            3160, 1110,
                            6720, 3070, 1460, 2360, 37, 162, 14, 7, 8, '-', 76, 318, '-', 645, 62790],
                            ['2019-05-31 00:00:00', 2080, 1380, 2420, 1130, 1240, 2820, 6150, 4650, 11850, 7150, 1820,
                            3140, 1070,
                            6690, 3020, 1490, 2380, 36, 155, 10, 6, 9, '-', 71, 317, '-', 648, 62470],
                            ] as $index => $row)
                            <tr>
                                <td class="px-4 py-2 text-gray-900 dark:text-gray-100">{{ $index + 1 }}</td>
                                @foreach($row as $cell)
                                    <td class="px-4 py-2 text-gray-900 dark:text-gray-100">{{ $cell }}</td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


        <div x-show="section === 'normalization'" x-transition>
            <h2 class="text-xl font-semibold mb-4">Normalitation</h2>

            <div class="w-full overflow-x-auto rounded-lg shadow border border-gray-200 dark:border-gray-700">
                <table class="w-full table-auto text-sm divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-100 dark:bg-gray-800">
                        <tr>
                            <th class="px-4 py-2 text-left font-medium text-gray-700 dark:text-gray-300">Date</th>
                            <th class="px-4 py-2 text-left font-medium text-gray-700 dark:text-gray-300">Data Actual
                            </th>
                            <th class="px-4 py-2 text-left font-medium text-gray-700 dark:text-gray-300">Normalized Data
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                        @foreach([
                            ['2019-01-31 00:00:00', 32276100.0, 0.02228860657939213],
                            ['2019-02-28 00:00:00', 21908400.0, 0.014413581478969135],
                            ['2019-03-31 00:00:00', 206380800.0, 0.15453383759440956],
                            ['2019-04-30 00:00:00', 570946500.0, 0.4314481036575432],
                            ['2019-05-31 00:00:00', 1228118400.0, 0.9306181417763653],
                            ] as $row)
                            <tr>
                                <td class="px-4 py-2 text-gray-900 dark:text-gray-100">{{ $row[0] }}</td>
                                <td class="px-4 py-2 text-gray-900 dark:text-gray-100">
                                    {{ number_format($row[1], 1) }}</td>
                                <td class="px-4 py-2 text-gray-900 dark:text-gray-100">{{ $row[2] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


        <div x-show="section === 'train_test'" x-transition>
            <h2 class="text-xl font-semibold mb-4">Train & Test</h2>

            {{-- Gambar grafik --}}
            <div class="mb-6 w-full flex justify-center">
                <img src="{{ asset('storage/sampel-data.png') }}" alt="Train & Test Graph"
                    class="w-full max-w-3xl rounded shadow" />
            </div>

            {{-- Tabel Evaluasi --}}
            <div class="w-full mt-3 overflow-x-auto rounded-lg shadow border border-gray-200 dark:border-gray-700">
                <table class="w-full table-auto text-sm divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-100 dark:bg-gray-800">
                        <tr>
                            <th class="px-4 py-2 font-medium text-left text-gray-700 dark:text-gray-300">No</th>
                            <th class="px-4 py-2 font-medium text-left text-gray-700 dark:text-gray-300">Total Epochs
                            </th>
                            <th class="px-4 py-2 font-medium text-left text-gray-700 dark:text-gray-300">Epoch yang
                                digunakan</th>
                            <th class="px-4 py-2 font-medium text-left text-gray-700 dark:text-gray-300">Train Loss</th>
                            <th class="px-4 py-2 font-medium text-left text-gray-700 dark:text-gray-300">Test Loss</th>
                            <th class="px-4 py-2 font-medium text-left text-gray-700 dark:text-gray-300">Waktu yang
                                Dibutuhkan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                        @foreach([
                            [1, 500, 20, 0.0385, 0.0416, '00:01'],
                            [2, 500, 40, 0.0237, 0.0252, '00:01'],
                            [3, 500, 60, 0.0245, 0.0193, '00:02'],
                            ] as $row)
                            <tr>
                                <td class="px-4 py-2 text-gray-900 dark:text-gray-100">{{ $row[0] }}</td>
                                <td class="px-4 py-2 text-gray-900 dark:text-gray-100">{{ $row[1] }}</td>
                                <td class="px-4 py-2 text-gray-900 dark:text-gray-100">{{ $row[2] }}</td>
                                <td class="px-4 py-2 text-gray-900 dark:text-gray-100">{{ $row[3] }}</td>
                                <td class="px-4 py-2 text-gray-900 dark:text-gray-100">{{ $row[4] }}</td>
                                <td class="px-4 py-2 text-gray-900 dark:text-gray-100">{{ $row[5] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


        <div x-show="section === 'forecast_graph'" x-transition class="mt-3">
            <h2 class="text-xl font-semibold mb-2">Grafik Forecasting</h2>
            {{-- Gambar grafik --}}
            <div class="mb-6 w-full flex justify-center">
                <img src="{{ asset('storage/sampel-data-2.png') }}" alt="Train & Test Graph"
                    class="w-full max-w-3xl rounded shadow" />
            </div>

            {{-- Tabel Evaluasi --}}
            <div class="w-full mt-3 overflow-x-auto rounded-lg shadow border border-gray-200 dark:border-gray-700">
                <table class="w-full table-auto text-sm divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-100 dark:bg-gray-800">
                        <tr>
                            <th class="px-4 py-2 font-medium text-left text-gray-700 dark:text-gray-300">No</th>
                            <th class="px-4 py-2 font-medium text-left text-gray-700 dark:text-gray-300">Tahun / Bulan
                            </th>
                            <th class="px-4 py-2 font-medium text-left text-gray-700 dark:text-gray-300">Total</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                        @foreach([
                            [1, '2024-11', 1230.73],
                            [2, '2024-12', 486.49],
                            [3, '2025-01', 948.29],
                            [4, '2025-02', 1282.47],
                            [5, '2025-03', 848.31],
                            ] as $row)
                            <tr>
                                <td class="px-4 py-2 text-gray-900 dark:text-gray-100">{{ $row[0] }}</td>
                                <td class="px-4 py-2 text-gray-900 dark:text-gray-100">{{ $row[1] }}</td>
                                <td class="px-4 py-2 text-gray-900 dark:text-gray-100">
                                    {{ number_format($row[2], 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                
            </div>
        </div>

        <div x-show="section === 'evaluation'" x-transition class="mt-3">
            <h2 class="text-xl font-semibold mb-2">Table Evaluasi</h2>
            <div class="w-full mt-6 overflow-x-auto rounded-lg shadow border border-gray-200 dark:border-gray-700">
                <table class="w-full table-auto text-sm divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-100 dark:bg-gray-800">
                        <tr>
                            <th class="px-4 py-2 font-medium text-left text-gray-700 dark:text-gray-300">No</th>
                            <th class="px-4 py-2 font-medium text-left text-gray-700 dark:text-gray-300">Model
                            </th>
                            <th class="px-4 py-2 font-medium text-left text-gray-700 dark:text-gray-300">Nilai</th>

                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                        @foreach([
                            [1, "MAE", 299.65],
                            [2, "RMSE", 313.12],
                            [3, "R2", -0.100],
                            [4, "MAPE", "24.90%"],
                            [5, "AIC", 58706.4],
                            ] as $row)
                            <tr>
                                <td class="px-4 py-2 text-gray-900 dark:text-gray-100">{{ $row[0] }}</td>
                                <td class="px-4 py-2 text-gray-900 dark:text-gray-100">{{ $row[1] }}</td>
                                <td class="px-4 py-2 text-gray-900 dark:text-gray-100">{{ $row[2] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-filament-panels::page>
