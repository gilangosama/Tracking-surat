<x-app-layout>
    <div class="flex min-h-screen">
        @include('layouts.sidebar')

        <!-- Main Content -->
        <div class="flex-1 ml-[280px] p-8">
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-2xl font-bold text-gray-800">Surat Masuk</h1>
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
            <!-- Surat List -->
            <div class="bg-white rounded-xl shadow-sm">
                <div class="p-6 border-b border-gray-100">
                    <h2 class="text-lg font-semibold text-gray-800">Daftar Surat Keluar</h2>
                </div>
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-6">
                    <table id="example" class="display" style="width:100%">
                        <thead class="justify-center">
                            <tr>
                                <th>Name</th>
                                <th>Perihal</th>
                                <th>No Surat</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($suratKeluar as $surat)
                                <tr>
                                    <td>{{ $surat->user->name }}</td>
                                    <td>{{ $surat->perihal }}</td>
                                    <td>{{ $surat->no_surat }}</td>
                                    <td>{{ $surat->tanggal_surat }}</td>
                                    <td>
                                        <div class="flex gap-2 mb-2">
                                            <a href="{{ route('surat.show', $surat->id_surat) }}"
                                                class="text-white bg-pink-500 px-3 py-1 rounded-full transform hover:-translate-y-1 transition-all duration-300">Detail</a>
                                            <a href="{{ route('surat.edit', $surat->id_surat) }}"
                                                class="text-white bg-blue-500 px-3 py-1 rounded-full transform hover:-translate-y-1 transition-all duration-300">Edit</a>
                                            <form action="{{ route('surat.delete', $surat->id_surat) }}"
                                                method="POST" class="inline delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button"
                                                    class="text-white bg-red-500 px-3 py-1 rounded-full transform hover:-translate-y-1 transition-all duration-300 delete-button">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                        <div class="flex gap-2">
                                            <a href="{{ route('tracking', $surat->id_surat) }}"
                                                class="text-white bg-pink-500 px-3 py-1 rounded-full transform hover:-translate-y-1 transition-all duration-300">Tracking</a>
                                            <a href="{{ route('surat.lampiran', $surat->id_surat) }}"
                                                class="text-white bg-yellow-400 px-3 py-1 rounded-full transform hover:-translate-y-1 transition-all duration-300">Lampiran</a>
                                            <a href="{{ route('surat.distribution', $surat->id_surat) }}"
                                                class="text-white bg-green-500 px-3 py-1 rounded-full transform hover:-translate-y-1 transition-all duration-300">Selesai</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('.delete-button');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function(e) {
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
