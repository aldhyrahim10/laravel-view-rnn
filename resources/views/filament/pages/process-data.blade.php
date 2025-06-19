<x-filament-panels::page>
    <h1 class="text-2xl font-bold">Detail Dataset</h1>

    <div class="mt-4 space-y-2">
        <p><strong>ID:</strong> {{ $record->id }}</p>
        <p><strong>Title:</strong> {{ $record->title }}</p>
        <p><strong>Attachment:</strong> {{ $record->attachment }}</p>
    </div>

    <div x-data="{
        selectedRegion: '{{ request('wilayah', 'ALL') }}',
        processRegion() {
            const wilayah = this.selectedRegion;
            const url = new URL(window.location.href);
            url.searchParams.set('wilayah', wilayah);
            window.location.href = url.toString();
        }
    }" class="mb-4 flex items-end gap-2">
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Pilih Wilayah:
            </label>
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

            {{-- <x-filament::button color="info" @click="section = 'normalization'">
                Normalitation
            </x-filament::button> --}}

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
                <table class="w-full min-w-max divide-y divide-gray-200 dark:divide-gray-700 text-sm">
                    <thead class="bg-gray-100 dark:bg-gray-800">
                        <tr>
                            <th class="px-4 py-2 font-medium text-left text-gray-700 dark:text-gray-300">Tanggal</th>
                            @foreach($cities as $city)
                                <th class="px-4 py-2 font-medium text-left text-gray-700 dark:text-gray-300">
                                    {{ ucfirst(strtolower($city)) }}
                                </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                        @foreach($dataUreaJSON as $row)
                            <tr>
                                <td class="px-4 py-2 text-gray-900 dark:text-gray-100 whitespace-nowrap">
                                    {{ \Carbon\Carbon::parse($row['TANGGAL'])->format('Y-m-d') }}
                                </td>
                                @foreach($cities as $city)
                                    <td class="px-4 py-2 text-gray-900 dark:text-gray-100 whitespace-nowrap">
                                        {{ $row[$city] ?? '-' }}
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>


        {{-- <div x-show="section === 'normalization'" x-transition>
            <h2 class="text-xl font-semibold mb-4">Normalitation</h2>

            <div class="w-full overflow-x-auto rounded-lg shadow border border-gray-200 dark:border-gray-700">
                <table class="w-full table-auto text-sm divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-100 dark:bg-gray-800">
                        <tr>
                            <th class="px-4 py-2 text-left font-medium text-gray-700 dark:text-gray-300">Tanggal</th>
                            <th class="px-4 py-2 text-left font-medium text-gray-700 dark:text-gray-300">Data Sebelum
                                Normalisasi
                            </th>
                            <th class="px-4 py-2 text-left font-medium text-gray-700 dark:text-gray-300">Data Setelah
                                Normalisasi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                        @foreach($dataNormalization as $row)
                            <tr>
                                <td class="px-4 py-2 text-gray-900 dark:text-gray-100">
                                    {{ \Carbon\Carbon::parse($row['Tanggal'])->format('Y-m-d') }}
                                </td>
                                <td class="px-4 py-2 text-gray-900 dark:text-gray-100">
                                    {{ number_format($row['Data Sebelum Normalisasi'], 2) }}
                                </td>
                                <td class="px-4 py-2 text-gray-900 dark:text-gray-100">
                                    {{ number_format($row['Data Sesudah Normalisasi'], 4) }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div> --}}


        <div x-show="section === 'train_test'" x-transition>
            <h2 class="text-xl font-semibold mb-4">Train & Test</h2>

            {{-- Gambar grafik --}}
            <div class="mb-6 w-full flex justify-center">
                <img src="data:image/png;base64,{{ $dataTrainTest['loss_plot'] }}"
                    alt="Train & Test Graph" class="w-full max-w-3xl rounded shadow" />
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
                        @foreach($dataTrainTest['summary'] as $row)
                            <tr>
                                <td class="px-4 py-2 text-gray-900 dark:text-gray-100">
                                    {{ $row["no"] }}</td>
                                <td class="px-4 py-2 text-gray-900 dark:text-gray-100">
                                    {{ $row["total_epochs"] }}</td>
                                <td class="px-4 py-2 text-gray-900 dark:text-gray-100">
                                    {{ $row["used_epochs"] }}</td>
                                <td class="px-4 py-2 text-gray-900 dark:text-gray-100">
                                    {{ $row["train_loss"] }}</td>
                                <td class="px-4 py-2 text-gray-900 dark:text-gray-100">
                                    {{ $row["test_loss"] }}</td>
                                <td class="px-4 py-2 text-gray-900 dark:text-gray-100">
                                    {{ $row["elapsed_time"] }}</td>
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
                <img src="data:image/png;base64,{{ $dataForecasting['loss_plot'] }}"
                    alt="Train & Test Graph" class="w-full max-w-3xl rounded shadow" />
            </div>

            {{-- Tabel Evaluasi --}}
            <div class="w-full mt-3 overflow-x-auto rounded-lg shadow border border-gray-200 dark:border-gray-700">
                <table class="w-full table-auto text-sm divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-100 dark:bg-gray-800">
                        <tr>
                            <th class="px-4 py-2 font-medium text-left text-gray-700 dark:text-gray-300">No</th>
                            <th class="px-4 py-2 font-medium text-left text-gray-700 dark:text-gray-300">Tahun / Bulan
                            </th>
                            <th class="px-4 py-2 font-medium text-left text-gray-700 dark:text-gray-300">Prediksi RNN</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                        @foreach($dataForecasting["summary"] as $row)
                            <tr>
                                <td class="px-4 py-2 text-gray-900 dark:text-gray-100">{{ $loop->iteration }}</td>
                                <td class="px-4 py-2 text-gray-900 dark:text-gray-100">
                                    {{ $row["tanggal"] }}</td>
                                <td class="px-4 py-2 text-gray-900 dark:text-gray-100">
                                    {{ $row["hasil"] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>

        <div x-show="section === 'evaluation'" x-transition class="mt-3">
            <h2 class="text-xl font-semibold mb-4">Tabel Evaluasi Model</h2>

            {{-- Tabel Training --}}
            <div class="w-full mt-4 overflow-x-auto rounded-lg shadow border border-gray-200 dark:border-gray-700">
                <table class="w-full table-auto text-sm divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-100 dark:bg-gray-800">
                        <tr>
                            <th colspan="3" class="text-left px-4 py-2 text-gray-700 dark:text-gray-300">Training</th>
                        </tr>
                        <tr>
                            <th class="px-4 py-2 font-medium text-left text-gray-700 dark:text-gray-300">No</th>
                            <th class="px-4 py-2 font-medium text-left text-gray-700 dark:text-gray-300">Metode</th>
                            <th class="px-4 py-2 font-medium text-left text-gray-700 dark:text-gray-300">Nilai</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                        @php
                            $trainingData = $dataEvaluation["evaluation"]["training"];
                        @endphp
                        @foreach($trainingData as $label => $value)
                            <tr>
                                <td class="px-4 py-2 text-gray-900 dark:text-gray-100">{{ $loop->iteration }}</td>
                                <td class="px-4 py-2 text-gray-900 dark:text-gray-100">{{ strtoupper($label) }}</td>
                                <td class="px-4 py-2 text-gray-900 dark:text-gray-100">{{ $value }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div style="height: 40px"></div>
            {{-- Tabel Testing --}}
            <div class="w-full mt-4 overflow-x-auto rounded-lg shadow border border-gray-200 dark:border-gray-700">
                <table class="w-full table-auto text-sm divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-100 dark:bg-gray-800">
                        <tr>
                            <th colspan="3" class="text-left px-4 py-2 text-gray-700 dark:text-gray-300">Testing</th>
                        </tr>
                        <tr>
                            <th class="px-4 py-2 font-medium text-left text-gray-700 dark:text-gray-300">No</th>
                            <th class="px-4 py-2 font-medium text-left text-gray-700 dark:text-gray-300">Metode</th>
                            <th class="px-4 py-2 font-medium text-left text-gray-700 dark:text-gray-300">Nilai</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                        @php
                            $testingData = $dataEvaluation["evaluation"]["testing"];
                        @endphp
                        @foreach($testingData as $label => $value)
                            <tr>
                                <td class="px-4 py-2 text-gray-900 dark:text-gray-100">{{ $loop->iteration }}</td>
                                <td class="px-4 py-2 text-gray-900 dark:text-gray-100">{{ strtoupper($label) }}</td>
                                <td class="px-4 py-2 text-gray-900 dark:text-gray-100">{{ $value }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-filament-panels::page>
