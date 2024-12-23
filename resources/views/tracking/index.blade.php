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
        <div class="flex-1 ml-[280px] p-8">
            <h1 class="text-2xl font-bold mb-4">Tracking Data</h1>
            <x-primary-button x-data=""
                x-on:click="$dispatch('open-modal', 'create-track')">{{ __('Add Track') }}</x-primary-button>

            <!-- Tracking Data Table -->
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-6 bg-white rounded-xl mt-4">
                <table id="example" class="display" style="width:100%">
                    <thead class="justify-center">
                        <tr>
                            <th>Status</th>
                            <th>Lokasi</th>
                            <th>Tanggal</th>
                            {{-- <th>Action</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tracking as $track)
                            <tr>
                                <td>{{ $track->status_surat }}</td>
                                <td>{{ $track->lokasi }}</td>
                                <td>{{ $track->tanggal_tracking }}</td>
                                {{-- <td>
                                    <div class="flex gap-2 mb-2">
                                            <a href="{{ route('surat.show', $surat->id_surat) }}" class="text-white bg-pink-500 px-3 py-1 rounded-full transform hover:-translate-y-1 transition-all duration-300">Detail</a>
                                            <a href="{{ route('surat.edit', $surat->id_surat) }}" class="text-white bg-blue-500 px-3 py-1 rounded-full transform hover:-translate-y-1 transition-all duration-300">Edit</a>
                                            <a href="{{ route('surat.delete', $surat->id_surat) }}" class="text-white bg-red-500 px-3 py-1 rounded-full transform hover:-translate-y-1 transition-all duration-300">Hapus</a>
                                        </div>
                                        <div class="flex gap-2">
                                            <a href="{{ route('tracking', $surat->id_surat) }}" class="text-white bg-pink-500 px-3 py-1 rounded-full transform hover:-translate-y-1 transition-all duration-300">Tracking</a>
                                            <a href="{{ route('surat.lampiran', $surat->id_surat) }}" class="text-white bg-yellow-400 px-3 py-1 rounded-full transform hover:-translate-y-1 transition-all duration-300">Lampiran</a>
                                            <a href="{{ route('surat.distribution', $surat->id_surat) }}" class="text-white bg-green-500 px-3 py-1 rounded-full transform hover:-translate-y-1 transition-all duration-300">Selesai</a>
                                        </div>
                                </td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Modal -->
            <x-modal name="create-track" focusable>
                <form method="post" action="{{ route('tracking.store') }}" class="p-6">
                    @csrf
                    <!-- Data Surat -->
                    <div class="bg-gray-50 p-6 rounded-lg mb-8">
                        <h3 class="text-gray-800 text-lg font-semibold mb-5 pb-3 border-b-2 border-pink-400">Tambah
                            Tracking
                        </h3>
                        <div class="space-y-6">
                            <input type="hidden" name="status_surat" value="sedang dikirim" required
                                class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-pink-400 focus:ring-2 focus:ring-pink-100 outline-none transition">
                            <input type="hidden" name="id_surat" value="{{ $surat }}" required
                                class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-pink-400 focus:ring-2 focus:ring-pink-100 outline-none transition">
                            <div>
                                <label for="lokasi" class="block text-gray-600 mb-2">Lokasi</label>
                                <textarea type="text" value="{{ old('lokasi') }}" name="lokasi" required
                                    class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-pink-400 focus:ring-2 focus:ring-pink-100 outline-none transition"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <x-secondary-button x-on:click="$dispatch('close')">
                            {{ __('Cancel') }}
                        </x-secondary-button>

                        <x-primary-button class="ms-3">
                            {{ __('Add Tracking') }}
                        </x-primary-button>
                    </div>
                </form>
            </x-modal>
        </div>
    </div>
</x-app-layout>
