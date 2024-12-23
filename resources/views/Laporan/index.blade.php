<x-app-layout>
    <div class="flex min-h-screen">
        @include('layouts.sidebar')

        <!-- Main Content -->
        <div class="flex-1 ml-[280px] p-8">
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-2xl font-bold text-gray-800">Laporan</h1>
                
                <!-- Filter & Download Section -->
                <div class="bg-white p-4 rounded-xl shadow-sm">
                    <form action="{{ route('laporan.download') }}" method="POST" class="flex gap-4">
                        @csrf
                        <div>
                            <select name="jenis_surat" class="rounded-lg border-gray-300 focus:border-pink-400 focus:ring-pink-200">
                                <option value="">Semua Jenis</option>
                                <option value="masuk">Surat Masuk</option>
                                <option value="keluar">Surat Keluar</option>
                            </select>
                        </div>
                        <div>
                            <input type="date" name="tanggal_mulai" 
                                class="rounded-lg border-gray-300 focus:border-pink-400 focus:ring-pink-200"
                                placeholder="Tanggal Mulai">
                        </div>
                        <div>
                            <input type="date" name="tanggal_akhir" 
                                class="rounded-lg border-gray-300 focus:border-pink-400 focus:ring-pink-200"
                                placeholder="Tanggal Akhir">
                        </div>
                        <button type="submit" class="px-4 py-2 bg-pink-400 text-white rounded-lg hover:bg-pink-500 transition-colors duration-200">
                            <i class="fas fa-download mr-2"></i>Download Laporan
                        </button>
                    </form>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white p-6 rounded-xl shadow-sm">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-pink-100 mr-4">
                            <i class="fas fa-envelope text-pink-400 text-xl"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Total Surat Masuk</p>
                            <h3 class="text-xl font-bold text-gray-800">{{ $suratMasuk->count() }}</h3>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-sm">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-blue-100 mr-4">
                            <i class="fas fa-paper-plane text-blue-400 text-xl"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Total Surat Keluar</p>
                            <h3 class="text-xl font-bold text-gray-800">{{ $suratKeluar->count() }}</h3>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-sm">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-100 mr-4">
                            <i class="fas fa-check-circle text-green-400 text-xl"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Total Surat Selesai</p>
                            <h3 class="text-xl font-bold text-gray-800">{{ $suratSelesai->count() }}</h3>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabel Laporan -->
            <div class="bg-white rounded-xl shadow-sm">
                <div class="p-6 border-b border-gray-100">
                    <h2 class="text-lg font-semibold">Daftar Surat</h2>
                </div>
                <div class="p-6">
                    <table id="example" class="display w-full">
                        <thead>
                            <tr>
                                <th class="text-left">No</th>
                                <th class="text-left">No Surat</th>
                                <th class="text-left">Jenis</th>
                                <th class="text-left">Pengirim</th>
                                <th class="text-left">Penerima</th>
                                <th class="text-left">Tanggal</th>
                                <th class="text-left">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1; @endphp
                            @foreach($suratMasuk->merge($suratKeluar)->sortByDesc('tanggal_surat') as $surat)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $surat->no_surat }}</td>
                                    <td>
                                        <span class="px-2 py-1 text-xs rounded-full 
                                            {{ $surat->jenis_surat === 'masuk' ? 'bg-pink-100 text-pink-800' : 'bg-blue-100 text-blue-800' }}">
                                            {{ ucfirst($surat->jenis_surat) }}
                                        </span>
                                    </td>
                                    <td>{{ $surat->pengirim }}</td>
                                    <td>{{ $surat->penerima }}</td>
                                    <td>{{ \Carbon\Carbon::parse($surat->tanggal_surat)->format('d M Y') }}</td>
                                    <td>
                                        <span class="px-2 py-1 text-xs rounded-full 
                                            {{ $surat->lastTracking?->status_surat === 'sudah diterima' ? 'bg-green-100 text-green-800' : 
                                               ($surat->lastTracking?->status_surat === 'sedang dikirim' ? 'bg-yellow-100 text-yellow-800' : 
                                               'bg-gray-100 text-gray-800') }}">
                                            {{ $surat->lastTracking?->status_surat ?? 'Belum ada status' }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- DataTables Initialization -->
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                "pageLength": 10,
                "ordering": true,
                "info": true,
                "responsive": true,
                "dom": '<"top"f>rt<"bottom"lip><"clear">',
                "language": {
                    "search": "Pencarian:",
                    "lengthMenu": "Tampilkan _MENU_ data per halaman",
                    "zeroRecords": "Data tidak ditemukan",
                    "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                    "infoEmpty": "Tidak ada data yang tersedia",
                    "infoFiltered": "(difilter dari _MAX_ total data)",
                    "paginate": {
                        "first": "Pertama",
                        "last": "Terakhir",
                        "next": "Selanjutnya",
                        "previous": "Sebelumnya"
                    }
                }
            });
        });
    </script>
</x-app-layout>
