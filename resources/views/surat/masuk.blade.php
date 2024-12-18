<x-app-layout>
    <div class="flex min-h-screen">
        @include('layouts.sidebar')

        <!-- Main Content -->
        <div class="flex-1 ml-[280px] p-8">
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-2xl font-bold text-gray-800">Surat Masuk</h1>
            </div>

            <!-- Surat List -->
            <div class="bg-white rounded-xl shadow-sm">
                <div class="p-6 border-b border-gray-100">
                    <h2 class="text-lg font-semibold text-gray-800">Daftar Surat Masuk</h2>
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
                            @foreach ($suratMasuk as $surat)
                                <tr>
                                    <td>{{ $surat->admin->name }}</td>
                                    <td>{{ $surat->perihal }}</td>
                                    <td>{{ $surat->no_surat }}</td>
                                    <td>{{ $surat->tanggal_surat }}</td>
                                    <td>
                                        <div class="flex gap-2 mb-2">
                                            <a href="{{ route('surat.show', $surat->id_surat) }}" class="text-white bg-pink-500 px-3 py-1 rounded-full transform hover:-translate-y-1 transition-all duration-300">Detail</a>
                                            <a href="{{ route('surat.edit', $surat->id_surat) }}" class="text-white bg-blue-500 px-3 py-1 rounded-full transform hover:-translate-y-1 transition-all duration-300">Edit</a>
                                            <a href="{{ route('surat.delete', $surat->id_surat) }}" class="text-white bg-red-500 px-3 py-1 rounded-full transform hover:-translate-y-1 transition-all duration-300">Hapus</a>
                                        </div>
                                        <div class="flex gap-2">
                                            <a href="{{ route('surat.tracking', $surat->id_surat) }}" class="text-white bg-pink-500 px-3 py-1 rounded-full transform hover:-translate-y-1 transition-all duration-300">Tracking</a>
                                            <a href="{{ route('surat.lampiran', $surat->id_surat) }}" class="text-white bg-yellow-400 px-3 py-1 rounded-full transform hover:-translate-y-1 transition-all duration-300">Lampiran</a>
                                            <a href="{{ route('surat.distribution', $surat->id_surat) }}" class="text-white bg-green-500 px-3 py-1 rounded-full transform hover:-translate-y-1 transition-all duration-300">Selesai</a>
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
