<x-app-layout>
    <div class="flex min-h-screen">
        @include('layouts.sidebar')

        <!-- Main Content -->
        <div class="flex-1 ml-[280px] p-8">
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-2xl font-bold text-gray-800">{{ isset($surat) ? 'Edit Surat' : 'Create Surat' }}</h1>
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

            <!-- Form Container -->
            <div class="bg-white rounded-xl shadow-sm p-8">
                <form method="POST" action="{{ isset($surat) ? route('surat.update', $surat->id_surat) : route('surat.store') }}" class="max-w-3xl mx-auto" enctype="multipart/form-data">
                    @csrf
                    @if(isset($surat))
                        @method('PUT')
                    @endif

                    <!-- Data Surat -->
                    <div class="bg-gray-50 p-6 rounded-lg mb-8">
                        <h3 class="text-gray-800 text-lg font-semibold mb-5 pb-3 border-b-2 border-pink-400">Data Surat</h3>
                        <div class="space-y-6">
                            <div>
                                <label class="block text-gray-600 mb-2">Jenis Surat</label>
                                <select name="jenis_surat" required
                                    class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-pink-400 focus:ring-2 focus:ring-pink-100 outline-none transition">
                                    <option value="masuk" {{ (old('jenis_surat') ?? $surat->jenis_surat ?? '') == 'masuk' ? 'selected' : '' }}>Masuk</option>
                                    <option value="keluar" {{ (old('jenis_surat') ?? $surat->jenis_surat ?? '') == 'keluar' ? 'selected' : '' }}>Keluar</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-gray-600 mb-2">Nomor Surat</label>
                                <input type="text" value="{{ old('no_surat') ?? $surat->no_surat ?? '' }}" name="no_surat" required
                                    class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-pink-400 focus:ring-2 focus:ring-pink-100 outline-none transition">
                            </div>
                            <div>
                                <label class="block text-gray-600 mb-2">Perihal</label>
                                <input type="text" value="{{ old('perihal') ?? $surat->perihal ?? '' }}" name="perihal" required
                                    class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-pink-400 focus:ring-2 focus:ring-pink-100 outline-none transition">
                            </div>
                            <div>
                                <label class="block text-gray-600 mb-2">Lampiran</label>
                                <input type="text" value="{{ old('lampiran') ?? $surat->lampiran ?? '' }}" name="lampiran" required
                                    class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-pink-400 focus:ring-2 focus:ring-pink-100 outline-none transition">
                            </div>
                            <div>
                                <label class="block text-gray-600 mb-2">Tanggal Surat</label>
                                <input type="date" value="{{ old('tanggal_surat') ?? $surat->tanggal_surat ?? '' }}" name="tanggal_surat" required
                                    class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-pink-400 focus:ring-2 focus:ring-pink-100 outline-none transition">
                            </div>
                            <div class="flex items-center justify-center w-full">
                                <label for="dropzone-file"
                                    class="flex flex-col items-center justify-center w-full h-40 border-2 border-pink-400 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                        </svg>
                                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span
                                                class="font-semibold">Click to upload</span> or drag and drop</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">PDF, DOCX</p>
                                    </div>
                                    <input id="dropzone-file" type="file" class="hidden" name="path" />
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Data Pengirim -->
                    <div class="bg-gray-50 p-6 rounded-lg mb-8">
                        <h3 class="text-gray-800 text-lg font-semibold mb-5 pb-3 border-b-2 border-pink-400">Data Pengirim</h3>
                        <div class="space-y-6">
                            <div>
                                <label class="block text-gray-600 mb-2">Nama Pengirim</label>
                                <input type="text" value="{{ old('pengirim') ?? $surat->pengirim ?? '' }}" name="pengirim" required
                                    class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-pink-400 focus:ring-2 focus:ring-pink-100 outline-none transition">
                            </div>
                            <div>
                                <label class="block text-gray-600 mb-2">Nomor Pengirim</label>
                                <input type="tel" value="{{ old('nomor_pengirim') ?? $surat->no_pengirim ?? '' }}" name="nomor_pengirim" required
                                    class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-pink-400 focus:ring-2 focus:ring-pink-100 outline-none transition">
                            </div>
                        </div>
                    </div>

                    <!-- Data Penerima -->
                    <div class="bg-gray-50 p-6 rounded-lg mb-8">
                        <h3 class="text-gray-800 text-lg font-semibold mb-5 pb-3 border-b-2 border-pink-400">Data Penerima</h3>
                        <div class="space-y-6">
                            <div>
                                <label class="block text-gray-600 mb-2">Nama Penerima</label>
                                <input type="text" value="{{ old('penerima') ?? $surat->penerima ?? '' }}" name="penerima" required
                                    class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-pink-400 focus:ring-2 focus:ring-pink-100 outline-none transition">
                            </div>
                            <div>
                                <label class="block text-gray-600 mb-2">Nomor Penerima</label>
                                <input type="tel" value="{{ old('nomor_penerima') ?? $surat->no_penerima ?? '' }}" name="nomor_penerima" required
                                    class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-pink-400 focus:ring-2 focus:ring-pink-100 outline-none transition">
                            </div>
                            <div>
                                <label class="block text-gray-600 mb-2">Alamat Penerima</label>
                                <textarea name="alamat_penerima" rows="4" required
                                    class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-pink-400 focus:ring-2 focus:ring-pink-100 outline-none transition resize-vertical">{{ old('alamat_penerima') ?? $surat->alamat_penerima ?? '' }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="flex justify-center gap-4">
                        <button type="submit"
                            class="px-8 py-3 bg-pink-400 text-white rounded-full hover:bg-pink-500 transform hover:-translate-y-1 transition-all duration-300 uppercase tracking-wide text-sm font-medium">
                            {{ isset($surat) ? 'Update' : 'Kirim dan Beri ke Layanan' }}
                        </button>
                        {{-- <button type="button"
                            class="px-8 py-3 border-2 border-pink-400 text-pink-400 rounded-full hover:bg-pink-400 hover:text-white transform hover:-translate-y-1 transition-all duration-300 uppercase tracking-wide text-sm font-medium">
                            Beri ke Layanan
                        </button> --}}
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>
