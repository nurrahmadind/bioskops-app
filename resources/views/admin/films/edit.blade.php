<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Film') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900">
                
                <form action="{{ route('films.update', $film->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Judul Film -->
                    <div class="mb-4">
                        <label for="judul_film" class="block text-gray-700 font-bold mb-2">Judul Film</label>
                        <input type="text" name="judul_film" id="judul_film" value="{{ old('judul_film', $film->judul_film) }}" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                    </div>

                    <!-- Genre -->
                    <div class="mb-4">
                        <label for="genre" class="block text-gray-700 font-bold mb-2">Genre</label>
                        <input type="text" name="genre" id="genre" value="{{ old('genre', $film->genre) }}" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                    </div>


                    <!-- Tombol Aksi -->
                    <div class="flex justify-between">
                        <a href="{{ route('films.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600">Batal</a>
                        <button type="submit" class="bg-indigo-500 text-white px-4 py-2 rounded-md hover:bg-indigo-600">Perbarui Film</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>