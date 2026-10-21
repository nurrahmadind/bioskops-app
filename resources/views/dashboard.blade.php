<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Penonton') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900 text-center">
                <h3 class="text-lg font-medium mb-4">Selamat Datang, {{ Auth::user()->name }}!</h3>
                <p class="text-gray-600 mb-6">Silakan klik tombol di bawah untuk mulai memesan tiket bioskop atau melihat riwayat pemesanan Anda.</p>
                
                <a href="{{ route('pemesanans.index') }}" class="bg-blue-600 text-white px-6 py-3 rounded-md hover:bg-blue-700 font-semibold text-lg shadow">
                    🎟️ Masuk ke Menu Pemesanan Tiket
                </a>
            </div>
        </div>
    </div>
</x-app-layout>