<x-app-layout>
    <div class="flex min-h-screen">
        @include('layouts.sidebar')

        <!-- Main Content -->
        <div class="flex-1 ml-[280px] p-8">
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-2xl font-bold text-gray-800">Surat Keluar</h1>
            </div>

            <!-- Surat List -->
            <div class="bg-white rounded-xl shadow-sm">
                <div class="p-6 border-b border-gray-100">
                    <h2 class="text-lg font-semibold text-gray-800">Daftar Surat Keluar</h2>
                </div>
                <div class="divide-y divide-gray-100">
                    @forelse($suratKeluar as $surat)
                    <div class="p-6 flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-pink-100 rounded-lg flex items-center justify-center mr-4">
                                <i class="fas fa-file-pdf text-pink-400"></i>
                            </div>
                            <div>
                                <h3 class="text-gray-800 font-medium">{{ $surat->nama_file }}</h3>
                                <p class="text-sm text-gray-500">
                                    Dibuat {{ $surat->created_at->diffForHumans() }}
                                </p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <a href="{{ route('surat.download', $surat->id) }}" 
                                class="text-gray-400 hover:text-gray-600">
                                <i class="fas fa-download"></i>
                            </a>
                            <a href="{{ route('surat.preview', $surat->id) }}" 
                                class="text-gray-400 hover:text-gray-600">
                                <i class="fas fa-eye"></i>
                            </a>
                        </div>
                    </div>
                    @empty
                    <div class="p-6 text-center text-gray-500">
                        Belum ada surat keluar
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 