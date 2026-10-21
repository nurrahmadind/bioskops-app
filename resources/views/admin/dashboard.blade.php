<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Admin Bioskop') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900">
                <h3 class="text-lg font-bold mb-4">Selamat Datang, Administrator!</h3>
                <p class="text-gray-600 mb-6">Silakan pilih menu pengelolaan di bawah ini:</p>

                <!-- Tombol Navigasi Menu Admin -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Menu Film -->
                    <a href="{{ route('films.index') }}" class="p-6 bg-blue-500 text-white rounded-lg shadow hover:bg-blue-600 transition text-center font-semibold">
                        🎬 Kelola Film
                    </a>

                    <!-- Menu Jadwal -->
                    <a href="{{ route('jadwals.index') }}" class="p-6 bg-green-500 text-white rounded-lg shadow hover:bg-green-600 transition text-center font-semibold">
                        🕒 Kelola Jadwal Tayang
                    </a>

                    <!-- Menu Laporan Pemesanan -->
                    <a href="{{ route('laporan.index') }}" class="p-6 bg-purple-500 text-white rounded-lg shadow hover:bg-purple-600 transition text-center font-semibold">
                        📊 Laporan Pemesanan
                    </a>
                    <!-- Menu Penonton -->
                     <a href="{{ route('penontons.index') }}" class="p-6 bg-yellow-500 text-white rounded-lg shadow hover:bg-yellow-600 transition text-center font-semibold">
                        👥 Kelola Penonton
                     </a>   
                </div>
            </div>
        </div>
    </div>
</x-app-layout>