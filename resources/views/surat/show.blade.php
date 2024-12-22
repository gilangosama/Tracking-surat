<x-app-layout>
    <div class="flex min-h-screen">
        @include('layouts.sidebar')

        <!-- Main Content -->
        <div class="flex-1 ml-[280px] p-8">
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-2xl font-bold text-gray-800">Detail Surat</h1>
                <a href="{{ url()->previous() }}" 
                   class="px-4 py-2 bg-gray-100 text-gray-600 rounded-lg hover:bg-gray-200 transition-all duration-300">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
            </div>

            <!-- Detail Container -->
            <div class="bg-white rounded-xl shadow-sm">
                <!-- Data Surat -->
                <div class="p-6 border-b border-gray-100">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Data Surat</h2>
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <p class="text-gray-600 mb-1">Nomor Surat</p>
                            <p class="font-medium">{{ $surat->no_surat }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600 mb-1">Jenis Surat</p>
                            <p class="font-medium capitalize">{{ $surat->jenis_surat }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600 mb-1">Tanggal Surat</p>
                            <p class="font-medium">{{ $surat->tanggal_surat }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600 mb-1">Perihal</p>
                            <p class="font-medium">{{ $surat->perihal }}</p>
                        </div>
                    </div>
                </div>

                <!-- Data Pengirim -->
                <div class="p-6 border-b border-gray-100">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Data Pengirim</h2>
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <p class="text-gray-600 mb-1">Nama Pengirim</p>
                            <p class="font-medium">{{ $surat->pengirim }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600 mb-1">Nomor Pengirim</p>
                            <p class="font-medium">{{ $surat->no_pengirim }}</p>
                        </div>
                    </div>
                </div>

                <!-- Data Penerima -->
                <div class="p-6 border-b border-gray-100">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Data Penerima</h2>
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <p class="text-gray-600 mb-1">Nama Penerima</p>
                            <p class="font-medium">{{ $surat->penerima }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600 mb-1">Nomor Penerima</p>
                            <p class="font-medium">{{ $surat->no_penerima }}</p>
                        </div>
                        <div class="col-span-2">
                            <p class="text-gray-600 mb-1">Alamat Penerima</p>
                            <p class="font-medium">{{ $surat->alamat_penerima }}</p>
                        </div>
                    </div>
                </div>

                <!-- File Surat -->
                <div class="p-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">File Surat</h2>
                    <div class="flex items-center gap-4">
                        <a href="{{ route('surat.download', $surat->id_surat) }}" 
                           class="px-4 py-2 bg-pink-400 text-white rounded-lg hover:bg-pink-500 transition-all duration-300">
                            <i class="fas fa-download mr-2"></i>Download
                        </a>
                        <a href="{{ route('surat.preview', $surat->id_surat) }}" 
                           class="px-4 py-2 bg-blue-400 text-white rounded-lg hover:bg-blue-500 transition-all duration-300">
                            <i class="fas fa-eye mr-2"></i>Preview
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
