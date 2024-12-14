<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-md">
            <!-- Logo -->
            <div class="text-center mb-8">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="mx-auto mb-4 rounded-2xl p-1">
                {{-- <h2 class="text-2xl font-bold text-gray-800">Tracking Office</h2> --}}
                <p class="text-gray-500 mt-2">Buat akun baru</p>
            </div>

            <!-- Sign Up Form -->
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="space-y-5">
                    <!-- Nama Lengkap -->
                    <div>
                        <label for="name" class="block text-gray-700 mb-2">Nama Lengkap</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                <i class="fas fa-user"></i>
                            </span>
                            <input type="text" id="name" name="name"
                                class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-lg focus:border-pink-400 focus:ring-2 focus:ring-pink-100 outline-none transition"
                                placeholder="Masukkan nama lengkap"
                                value="{{ old('name') }}" required>
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-gray-700 mb-2">Email</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                <i class="fas fa-envelope"></i>
                            </span>
                            <input type="email" id="email" name="email"
                                class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-lg focus:border-pink-400 focus:ring-2 focus:ring-pink-100 outline-none transition"
                                placeholder="Masukkan email"
                                value="{{ old('email') }}" required>
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                    </div>

                    <!-- No. Telepon -->
                    <div>
                        <label for="phone" class="block text-gray-700 mb-2">No. Telepon</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                <i class="fas fa-phone"></i>
                            </span>
                            <input type="tel" id="phone" name="phone"
                                class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-lg focus:border-pink-400 focus:ring-2 focus:ring-pink-100 outline-none transition"
                                placeholder="Masukkan no. telepon"
                                value="{{ old('phone') }}" required>
                            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                        </div>
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-gray-700 mb-2">Password</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                <i class="fas fa-lock"></i>
                            </span>
                            <input type="password" id="password" name="password"
                                class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-lg focus:border-pink-400 focus:ring-2 focus:ring-pink-100 outline-none transition"
                                placeholder="Buat password" required>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>
                    </div>

                    <!-- Konfirmasi Password -->
                    <div>
                        <label for="password_confirmation" class="block text-gray-700 mb-2">Konfirmasi Password</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                <i class="fas fa-lock"></i>
                            </span>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-lg focus:border-pink-400 focus:ring-2 focus:ring-pink-100 outline-none transition"
                                placeholder="Konfirmasi password" required>
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>
                    </div>

                    <!-- Terms -->
                    <div class="flex items-start">
                        <input type="checkbox" id="terms" name="terms"
                            class="w-4 h-4 mt-1 text-pink-400 border-gray-300 rounded focus:ring-pink-400" required>
                        <label for="terms" class="ml-2 text-sm text-gray-600">
                            Saya setuju dengan <a href="#" class="text-pink-400 hover:text-pink-500">Syarat &
                                Ketentuan</a> dan <a href="#" class="text-pink-400 hover:text-pink-500">Kebijakan
                                Privasi</a>
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                        class="w-full py-3 bg-pink-400 text-white rounded-lg hover:bg-pink-500 transition-colors duration-300">
                        Daftar
                    </button>
                </div>
            </form>

            <!-- Login Link -->
            <div class="mt-6 text-center">
                <p class="text-gray-600">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="text-pink-400 hover:text-pink-500 font-medium">Masuk</a>
                </p>
            </div>
        </div>
    </div>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</x-guest-layout>