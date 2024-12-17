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
                <form action="{{ route('surat.store') }}" method="POST" enctype="multipart/form-data" class="dropzone"
                    id="suratDropzone">
                    @csrf
                    <div
                        class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center cursor-pointer hover:border-pink-400 transition-colors">
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
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>No. Surat</th>
                                <th>Tanggal Surat</th>
                                <th>Pengirim</th>
                                <th>Perihal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($suratMasuk as $surat)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $surat->nomor_surat }}</td>
                                    <td>{{ $surat->tanggal_surat }}</td>
                                    <td>{{ $surat->pengirim }}</td>
                                    <td>{{ $surat->perihal }}</td>
                                    <td>
                                        <a href="#" class="btn btn-primary btn-sm">Lihat</a>
                                        <a href="#" class="btn btn-danger btn-sm">Hapus</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
                success: function(file, response) {
                    window.location.reload();
                }
            };
        </script>
    @endpush
</x-app-layout>
