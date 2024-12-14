<x-app-layout>
    <div class="flex min-h-screen">
        @include('layouts.sidebar')

        <!-- Main Content -->
        <div class="flex-1 ml-[280px] p-8">
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-2xl font-bold text-gray-800">Surat Masuk</h1>
            </div>

            <!-- Upload Area -->
            <div class="bg-white rounded-xl shadow-sm p-8 mb-6">
                <form action="{{ route('surat.store') }}" method="POST" enctype="multipart/form-data" 
                    class="dropzone" id="suratDropzone">
                    @csrf
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center cursor-pointer hover:border-pink-400 transition-colors">
                        <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-4"></i>
                        <p class="text-gray-600">Drag and drop file surat disini atau</p>
                        <button type="button" class="text-pink-400 hover:text-pink-500 font-medium">
                            pilih file
                        </button>
                        <p class="text-sm text-gray-500 mt-2">PDF, DOC, DOCX (Max 10MB)</p>
                    </div>
                </form>
            </div>

            <!-- Surat List -->
            <div class="bg-white rounded-xl shadow-sm">
                <div class="p-6 border-b border-gray-100">
                    <h2 class="text-lg font-semibold text-gray-800">Daftar Surat Masuk</h2>
                </div>
                <div class="divide-y divide-gray-100">
                    @forelse($suratMasuk as $surat)
                    <div class="p-6 flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-pink-100 rounded-lg flex items-center justify-center mr-4">
                                <i class="fas fa-file-pdf text-pink-400"></i>
                            </div>
                            <div>
                                <h3 class="text-gray-800 font-medium">{{ $surat->nama_file }}</h3>
                                <p class="text-sm text-gray-500">
                                    Diunggah {{ $surat->created_at->diffForHumans() }}
                                </p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <a href="{{ route('surat.preview', $surat->id) }}" 
                                class="text-gray-400 hover:text-gray-600">
                                <i class="fas fa-eye"></i>
                            </a>
                            <form action="{{ route('surat.destroy', $surat->id) }}" method="POST" 
                                onsubmit="return confirm('Yakin ingin menghapus surat ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-gray-400 hover:text-red-500">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    @empty
                    <div class="p-6 text-center text-gray-500">
                        Belum ada surat masuk
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    
    <script>
        Dropzone.options.suratDropzone = {
            acceptedFiles: ".pdf,.doc,.docx",
            maxFilesize: 10,
            success: function(file, response){
                window.location.reload();
            }
        };
    </script>
    @endpush
</x-app-layout> 