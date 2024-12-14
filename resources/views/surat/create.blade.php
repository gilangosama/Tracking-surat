<x-app-layout>
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <div class="fixed w-[280px] h-screen bg-white shadow-lg p-6 left-0 top-0 z-50">
            <div class="text-center mb-10 pb-5 border-b-2 border-gray-100">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-20 h-20 mx-auto mb-4 rounded-2xl p-1 bg-pink-400">
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
                <h1 class="text-2xl font-bold text-gray-800">Create Surat</h1>
                {{-- <div class="flex items-center">
                    <img src="{{ asset('profile.png') }}" alt="Profile" class="w-10 h-10 rounded-full mr-3">
                    <span class="text-gray-700">{{ Auth::user()->name }}</span>
                </div> --}}
            </div>

            <!-- Form Container -->
            <div class="bg-white rounded-xl shadow-sm p-8">
                <form method="POST" action="{{ route('create.surat') }}" class="max-w-3xl mx-auto">
                    @csrf
                    <!-- Data Pengirim -->
                    <div class="bg-gray-50 p-6 rounded-lg mb-8">
                        <h3 class="text-gray-800 text-lg font-semibold mb-5 pb-3 border-b-2 border-pink-400">Data
                            Pengirim</h3>
                        <div class="space-y-6">
                            <div>
                                <label class="block text-gray-600 mb-2">Nama Pengirim</label>
                                <input type="text" name="sender_name" required
                                    class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-pink-400 focus:ring-2 focus:ring-pink-100 outline-none transition">
                            </div>
                            <div>
                                <label class="block text-gray-600 mb-2">Nomor Telepon Pengirim</label>
                                <input type="tel" name="sender_phone" required
                                    class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-pink-400 focus:ring-2 focus:ring-pink-100 outline-none transition">
                            </div>
                        </div>
                    </div>

                    <!-- Data Penerima -->
                    <div class="bg-gray-50 p-6 rounded-lg mb-8">
                        <h3 class="text-gray-800 text-lg font-semibold mb-5 pb-3 border-b-2 border-pink-400">Data
                            Penerima</h3>
                        <div class="space-y-6">
                            <div>
                                <label class="block text-gray-600 mb-2">Nama Penerima</label>
                                <input type="text" name="recipient_name" required
                                    class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-pink-400 focus:ring-2 focus:ring-pink-100 outline-none transition">
                            </div>
                            <div>
                                <label class="block text-gray-600 mb-2">Nomor Telepon Penerima</label>
                                <input type="tel" name="recipient_phone" required
                                    class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-pink-400 focus:ring-2 focus:ring-pink-100 outline-none transition">
                            </div>
                            <div>
                                <label class="block text-gray-600 mb-2">Alamat Penerima</label>
                                <textarea name="recipient_address" rows="4" required
                                    class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-pink-400 focus:ring-2 focus:ring-pink-100 outline-none transition resize-vertical"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="flex justify-center gap-4">
                        <button type="submit"
                            class="px-8 py-3 bg-pink-400 text-white rounded-full hover:bg-pink-500 transform hover:-translate-y-1 transition-all duration-300 uppercase tracking-wide text-sm font-medium">
                            Kirim
                        </button>
                        <button type="button"
                            class="px-8 py-3 border-2 border-pink-400 text-pink-400 rounded-full hover:bg-pink-400 hover:text-white transform hover:-translate-y-1 transition-all duration-300 uppercase tracking-wide text-sm font-medium">
                            Beri ke Layanan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</x-app-layout> 