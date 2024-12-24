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
                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <label class="block text-gray-600 mb-2">Nomor Surat</label>
                                <input type="text" value="{{ old('no_surat') ?? $surat->no_surat ?? '' }}" name="no_surat" required
                                    class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-pink-400 focus:ring-2 focus:ring-pink-100 outline-none transition">
                            </div>
                            <div>
                                <label class="block text-gray-600 mb-2">Jenis Surat</label>
                                <select name="jenis_surat" required
                                    class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-pink-400 focus:ring-2 focus:ring-pink-100 outline-none transition">
                                    <option value="masuk" {{ (old('jenis_surat') ?? $surat->jenis_surat ?? '') == 'masuk' ? 'selected' : '' }}>Surat Masuk</option>
                                    <option value="keluar" {{ (old('jenis_surat') ?? $surat->jenis_surat ?? '') == 'keluar' ? 'selected' : '' }}>Surat Keluar</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-gray-600 mb-2">Tanggal Surat</label>
                                <input type="date" value="{{ old('tanggal_surat') ?? $surat->tanggal_surat ?? '' }}" name="tanggal_surat" required
                                    class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-pink-400 focus:ring-2 focus:ring-pink-100 outline-none transition">
                            </div>
                            <div>
                                <label class="block text-gray-600 mb-2">Perihal</label>
                                <input type="text" value="{{ old('perihal') ?? $surat->perihal ?? '' }}" name="perihal" required
                                    class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-pink-400 focus:ring-2 focus:ring-pink-100 outline-none transition">
                            </div>
                            <div class="col-span-2">
                                <label class="block text-gray-600 mb-2">File Surat</label>
                                <input type="file" name="path" accept=".pdf,.doc,.docx" required
                                    class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:border-pink-400 focus:ring-2 focus:ring-pink-100 outline-none transition">
                                <p class="text-sm text-gray-500 mt-1">Format: PDF, DOC, DOCX (Max: 2MB)</p>
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
                        <button type="submit" name="action" value="draft"
                            class="px-8 py-3 border-2 border-pink-400 text-pink-400 rounded-full hover:bg-pink-400 hover:text-white transform hover:-translate-y-1 transition-all duration-300 uppercase tracking-wide text-sm font-medium">
                            Simpan Draft
                        </button>
                        <button type="submit" name="action" value="send"
                            class="px-8 py-3 bg-pink-400 text-white rounded-full hover:bg-pink-500 transform hover:-translate-y-1 transition-all duration-300 uppercase tracking-wide text-sm font-medium">
                            {{ isset($surat) ? 'Update' : 'Kirim dan Beri ke Layanan' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>
