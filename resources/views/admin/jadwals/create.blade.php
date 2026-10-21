<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Jadwal Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900">
                
                <form action="{{ route('jadwals.store') }}" method="POST">
                    @csrf

                    <!-- Pilih Film (Dropdown) -->
                    <div class="mb-4">
                        <label for="film_id" class="block text-gray-700 font-bold mb-2">Pilih Film</label>
                        <select name="film_id" id="film_id" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                            <option value="">-- Pilih Film --</option>
                            @foreach($films as $film)
                                <option value="{{ $film->id }}" {{ old('film_id') == $film->id ? 'selected' : '' }}>
                                    {{ $film->judul_film }}
                                </option>
                            @endforeach
                        </select>
                        @error('film_id')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex gap-4 mb-4">
                        <!-- Input Tanggal -->
                        <div class="w-1/2">
                            <label for="tanggal" class="block text-gray-700 font-bold mb-2">Tanggal Tayang</label>
                            <input type="date" name="tanggal" id="tanggal" value="{{ old('tanggal') }}" class="w-full border-gray-300 rounded-md shadow-sm" required>
                            @error('tanggal')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Input Jam -->
                        <div class="w-1/2">
                            <label for="jam" class="block text-gray-700 font-bold mb-2">Jam Tayang</label>
                            <input type="time" name="jam" id="jam" value="{{ old('jam') }}" class="w-full border-gray-300 rounded-md shadow-sm" required>
                            @error('jam')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Input Harga -->
                    <div class="mb-6">
                        <label for="harga" class="block text-gray-700 font-bold mb-2">Harga Tiket (Rp)</label>
                        <input type="number" name="harga" id="harga" value="{{ old('harga') }}" placeholder="Contoh: 50000" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                        @error('harga')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="flex justify-between">
                        <a href="{{ route('jadwals.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600">Batal</a>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Simpan Jadwal</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>