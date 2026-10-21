<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pesan Tiket Bioskop') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900">
                
                <form action="{{ route('pemesanans.store') }}" method="POST">
                    @csrf

                    <!-- Pilih Jadwal Film -->
                    <div class="mb-4">
                        <label for="jadwal_id" class="block text-gray-700 font-bold mb-2">Pilih Film & Jadwal Tayang</label>
                        <select name="jadwal_id" id="jadwal_id" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required onchange="hitungTotal()">
                            <option value="" data-harga="0">-- Pilih Film & Jadwal --</option>
                            @foreach($jadwals as $jadwal)
                                <option value="{{ $jadwal->id }}" data-harga="{{ $jadwal->harga }}" {{ old('jadwal_id') == $jadwal->id ? 'selected' : '' }}>
                                    {{ $jadwal->film->judul_film }} | {{ \Carbon\Carbon::parse($jadwal->waktu_tayang)->format('d M Y (H:i)') }} WIB - Rp {{ number_format($jadwal->harga, 0, ',', '.') }}
                                </option>
                            @endforeach
                        </select>
                        @error('jadwal_id')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Jumlah Tiket -->
                    <div class="mb-4">
                        <label for="jumlah_tiket" class="block text-gray-700 font-bold mb-2">Jumlah Tiket</label>
                        <input type="number" name="jumlah_tiket" id="jumlah_tiket" value="{{ old('jumlah_tiket', 1) }}" min="1" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required oninput="hitungTotal()">
                        @error('jumlah_tiket')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Estimasi Total Bayar -->
                    <div class="mb-6 p-4 bg-gray-50 rounded-md border border-gray-200">
                        <p class="text-sm text-gray-600 font-medium">Estimasi Total Bayar:</p>
                        <p class="text-2xl font-bold text-green-600 mt-1" id="display_total">Rp 0</p>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="flex justify-between items-center">
                        <a href="{{ route('pemesanans.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 text-sm">
                            Batal
                        </a>
                        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 text-sm font-semibold">
                            Konfirmasi & Bayar Tiket
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- Script Hitung Total Otomatis -->
    <script>
        function hitungTotal() {
            const jadwalSelect = document.getElementById('jadwal_id');
            const selectedOption = jadwalSelect.options[jadwalSelect.selectedIndex];
            const harga = parseFloat(selectedOption.getAttribute('data-harga')) || 0;
            const jumlah = parseInt(document.getElementById('jumlah_tiket').value) || 0;

            const total = harga * jumlah;
            document.getElementById('display_total').innerText = 'Rp ' + total.toLocaleString('id-ID');
        }

        document.addEventListener('DOMContentLoaded', hitungTotal);
    </script>
</x-app-layout>