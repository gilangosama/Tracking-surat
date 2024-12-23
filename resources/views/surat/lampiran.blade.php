<x-app-layout>
    <div class="flex min-h-screen">
        @include('layouts.sidebar')

        <!-- Main Content -->
        <div class="flex-1 ml-[280px] p-8">
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-2xl font-bold text-gray-800">Lampiran Surat</h1>
                <div class="flex gap-4">
                    <a href="{{ url()->previous() }}"
                        class="px-4 py-2 bg-gray-100 text-gray-600 rounded-lg hover:bg-gray-200 transition-all duration-300">
                        <i class="fas fa-arrow-left mr-2"></i>Kembali
                    </a>
                    <button onclick="document.getElementById('uploadForm').classList.toggle('hidden')"
                        class="px-4 py-2 bg-pink-400 text-white rounded-lg hover:bg-pink-500 transition-all duration-300">
                        <i class="fas fa-plus mr-2"></i>Tambah Lampiran
                    </button>
                </div>
            </div>

            @if (session('success'))
                <script>
                    Swal.fire({
                        title: "Berhasil!",
                        text: "{{ session('success') }}",
                        icon: "success",
                        confirmButtonText: "OK"
                    });
                </script>
            @endif
            @if ($errors->any())
                <script>
                    Swal.fire({
                        title: "Error!",
                        text: "@foreach ($errors->all() as $error){{ $error }}@endforeach",
                        icon: "error",
                        confirmButtonText: "OK"
                    });
                </script>
            @endif

            <!-- Upload Form -->
            <div id="uploadForm" class="bg-white rounded-xl shadow-sm p-6 mb-8 hidden">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Upload Lampiran Baru</h2>
                <form action="{{ route('lampiran.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id_surat" value="{{ $id_surat }}">
                    <div class="grid grid-cols-2 gap-6">
                        <div class="col-span-2">
                            <label class="block text-gray-600 mb-2">File Lampiran</label>
                            <input type="file" name="nama_file" required
                                class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:border-pink-400 focus:ring-2 focus:ring-pink-100 outline-none transition">
                            <p class="text-sm text-gray-500 mt-1">Format: PDF, DOC, DOCX, JPG, PNG (Max: 2MB)</p>
                        </div>
                    </div>
                    <div class="flex justify-end mt-6">
                        <button type="submit"
                            class="px-6 py-2 bg-pink-400 text-white rounded-lg hover:bg-pink-500 transition-all duration-300">
                            Upload Lampiran
                        </button>
                    </div>
                </form>
            </div>

            <!-- Lampiran List -->
            <div class="bg-white rounded-xl shadow-sm">
                <div class="p-6 border-b border-gray-100">
                    <h2 class="text-lg font-semibold text-gray-800">Daftar Lampiran</h2>
                </div>
                <div class="p-6">
                    @if ($lampirans->isEmpty())
                        <p class="text-gray-500 text-center py-4">Belum ada lampiran</p>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach ($lampirans as $lampiran)
                                <div class="border rounded-lg p-4">
                                    <div class="flex items-center justify-between mb-2">
                                        <div class="flex items-center">
                                            <i class="fas fa-file-alt text-gray-400 mr-2 text-xl"></i>
                                            <span class="font-medium truncate">{{ $lampiran->nama_file }}</span>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <a href="{{ route('lampiran.download', $lampiran->id_lampiran) }}"
                                                class="text-blue-500 hover:text-blue-600">
                                                <i class="fas fa-download"></i>
                                            </a>
                                            <form action="{{ route('lampiran.destroy', $lampiran->id_lampiran) }}"
                                                method="POST" class="inline delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button"
                                                    class="text-red-500 hover:text-red-600 delete-button">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>

                                        </div>
                                    </div>
                                    <p class="text-sm text-gray-500">
                                        Ditambahkan: {{ $lampiran->created_at->format('d M Y H:i') }}
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.delete-button');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();

                const form = this.closest('.delete-form');

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>
