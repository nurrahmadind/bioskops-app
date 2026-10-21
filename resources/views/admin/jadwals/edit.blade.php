<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Jadwal Tayang') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900">
                
                <form action="{{ route('jadwals.update', $jadwal->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Pilih Film -->
                    <div class="mb-4">
                        <label for="film_id" class="block text-gray-700 font-bold mb-2">Film</label>
                        <select name="film_id" id="film_id" class="w-full border-gray-300 rounded-md shadow-sm" required>
                            @foreach($films as $film)
                                <option value="{{ $film->id }}" {{ old('film_id', $jadwal->film_id) == $film->id ? 'selected' : '' }}>
                                    {{ $film->judul_film }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Format waktu tayang lama menjadi Tanggal dan Jam terpisah -->
                    @php
                        $waktu = \Carbon\Carbon::parse($jadwal->waktu_tayang);
                    @endphp

                    <div class="flex gap-4 mb-4">
                        <!-- Input Tanggal -->
                        <div class="w-1/2">
                            <label for="tanggal" class="block text-gray-700 font-bold mb-2">Tanggal Tayang</label>
                            <input type="date" name="tanggal" id="tanggal" value="{{ old('tanggal', $waktu->format('Y-m-d')) }}" class="w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>

                        <!-- Input Jam -->
                        <div class="w-1/2">
                            <label for="jam" class="block text-gray-700 font-bold mb-2">Jam Tayang</label>
                            <!-- Format jam untuk HTML5 adalah H:i (24 jam) -->
                            <input type="time" name="jam" id="jam" value="{{ old('jam', $waktu->format('H:i')) }}" class="w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>
                    </div>

                    <!-- Input Harga -->
                    <div class="mb-6">
                        <label for="harga" class="block text-gray-700 font-bold mb-2">Harga Tiket (Rp)</label>
                        <input type="number" name="harga" id="harga" value="{{ old('harga', $jadwal->harga) }}" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="flex justify-between">
                        <a href="{{ route('jadwals.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600">Batal</a>
                        <button type="submit" class="bg-indigo-500 text-white px-4 py-2 rounded-md hover:bg-indigo-600">Perbarui Jadwal</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>