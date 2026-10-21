<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Laporan Rekapan Pemesanan Tiket') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900">
                
                <!-- Form Filter Tanggal -->
                <form action="{{ route('laporan.index') }}" method="GET" class="mb-6 flex gap-4 items-end bg-gray-50 p-4 rounded-md border">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Dari Tanggal</label>
                        <input type="date" name="tanggal_mulai" value="{{ $tanggalMulai ?? '' }}" class="border-gray-300 rounded-md shadow-sm text-sm" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Sampai Tanggal</label>
                        <input type="date" name="tanggal_selesai" value="{{ $tanggalSelesai ?? '' }}" class="border-gray-300 rounded-md shadow-sm text-sm" required>
                    </div>
                    <div>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 text-sm font-semibold">
                            🔍 Filter Laporan
                        </button>
                    </div>
                    <div>
                        <button type="button" onclick="window.print()" class="bg-gray-800 text-white px-4 py-2 rounded-md hover:bg-gray-700 text-sm font-semibold">
                            🖨️ Cetak / PDF
                        </button>
                    </div>
                </form>

                <!-- Tabel Rekapan -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal Transaksi</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Pemesan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Judul Film</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jumlah Tiket</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total Bayar</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @php $grandTotal = 0; @endphp
                            @forelse($pemesanans as $index => $item)
                                @php $grandTotal += $item->total_harga; @endphp
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $item->created_at->format('d/m/Y H:i') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $item->user->name ?? '-' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 font-semibold">{{ $item->jadwal->film->judul_film ?? '-' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $item->jumlah_tiket }} Tiket</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-green-600">Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center text-gray-500 text-sm">Tidak ada data transaksi pada rentang tanggal tersebut.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Total Pendapatan Keseluruhan dari Hasil Filter -->
                <div class="mt-4 p-4 bg-green-50 border border-green-200 rounded-md flex justify-between items-center">
                    <span class="font-bold text-gray-700">Total Pendapatan (Periode Ini):</span>
                    <span class="text-xl font-extrabold text-green-700">Rp {{ number_format($grandTotal, 0, ',', '.') }}</span>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>