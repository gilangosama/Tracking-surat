<x-app-layout>
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <div class="fixed w-[280px] h-screen bg-white shadow-lg p-6 left-0 top-0 z-50">
            <div class="text-center mb-10 pb-5 border-b-2 border-gray-100">
                <img src="{{ asset('images/logo.png') }}" alt="Logo"
                    class="w-20 h-20 mx-auto mb-4 rounded-2xl p-1 bg-pink-400">
                <h2 class="text-gray-800 text-xl font-semibold">Tracking Office</h2>
            </div>

            <div class="mt-8">
                @include('layouts.sidebar')

                <!-- Logout -->
                <form method="POST" action="{{ route('logout') }}" class="mt-4">
                    @csrf
                    <button type="submit"
                        class="flex w-full items-center px-5 py-4 text-gray-600 rounded-lg mb-2 hover:bg-gray-100 hover:text-pink-400 transition-all duration-300">
                        <i class="fas fa-sign-out-alt w-6 mr-3 text-lg"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 ml-[280px] p-8">
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-2xl font-bold text-gray-800">Dashboard</h1>
                {{-- <div class="flex items-center">
                    <img src="{{ asset('profile.png') }}" alt="Profile" class="w-10 h-10 rounded-full mr-3">
                    <span class="text-gray-700">{{ Auth::user()->name }}</span>
                </div> --}}
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                <div class="bg-white p-6 rounded-xl shadow-sm">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-pink-100 mr-4">
                            <i class="fas fa-envelope text-pink-400 text-xl"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Surat Masuk</p>
                            <h3 class="text-xl font-bold text-gray-800">{{ $suratMasuk }}</h3>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-sm">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-blue-100 mr-4">
                            <i class="fas fa-paper-plane text-blue-400 text-xl"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Surat Keluar</p>
                            <h3 class="text-xl font-bold text-gray-800">{{ $suratKeluar }}</h3>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-sm">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-100 mr-4">
                            <i class="fas fa-check-circle text-green-400 text-xl"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Surat Selesai</p>
                            <h3 class="text-xl font-bold text-gray-800">{{ $suratSelesai }}</h3>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Table Section -->
            <div class="bg-white rounded-xl shadow-sm p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-semibold text-gray-800">History Surat</h2>
                    <button class="px-4 py-2 text-pink-400 hover:text-pink-500">
                        Lihat Semua
                    </button>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="text-left bg-slate-200">
                                <th class="px-6 py-3 text-gray-600">Nama</th>
                                <th class="px-6 py-3 text-gray-600">Pengirim</th>
                                <th class="px-6 py-3 text-gray-600">Penerima</th>
                                <th class="px-6 py-3 text-gray-600">Status</th>
                                <th class="px-6 py-3 text-gray-600">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach ($suratTracking as $surat)
                                <tr>
                                    <td>{{ $surat->admin->name }}</td>
                                    <td>{{ $surat->pengirim }}</td>
                                    <td>{{ $surat->penerima }}</td>
                                    <td>{{ $surat->lastTracking->status_surat ?? 'tidak ada status' }}</td>
                                    <td>
                                        <div class="flex gap-2 mb-2">
                                            <a href="{{ route('surat.show', $surat->id_surat) }}"
                                                class="text-white bg-pink-500 px-3 py-1 rounded-full transform hover:-translate-y-1 transition-all duration-300">Detail</a>
                                            <a href="{{ route('surat.edit', $surat->id_surat) }}"
                                                class="text-white bg-blue-500 px-3 py-1 rounded-full transform hover:-translate-y-1 transition-all duration-300">Edit</a>
                                            <a href="{{ route('surat.delete', $surat->id_surat) }}"
                                                class="text-white bg-red-500 px-3 py-1 rounded-full transform hover:-translate-y-1 transition-all duration-300">Hapus</a>
                                        </div>
                                        <div class="flex gap-2">
                                            <a href="{{ route('surat.tracking', $surat->id_surat) }}"
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

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</x-app-layout>
