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
                <h1 class="text-2xl font-bold text-gray-800">Cek Track Surat</h1>
                {{-- <div class="flex items-center">
                    <img src="{{ asset('profile.png') }}" alt="Profile" class="w-10 h-10 rounded-full mr-3">
                    <span class="text-gray-700">{{ Auth::user()->name }}</span>
                </div> --}}
            </div>

            <!-- Tracking Container -->
            <div class="bg-white rounded-xl shadow-sm p-8">
                <!-- Info Section -->
                <div class="bg-gray-50 p-6 rounded-lg mb-8">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-600 font-medium mb-2">Username:</label>
                            <span class="text-gray-800">{{ Auth::user()->name }}</span>
                        </div>
                        <div>
                            <label class="block text-gray-600 font-medium mb-2">Tujuan:</label>
                            <span class="text-gray-800">Cirebon, Jawa Barat</span>
                        </div>
                    </div>
                </div>

                <!-- Timeline Tracking -->
                <div class="relative">
                    <div class="flex justify-between items-center">
                        <!-- Timeline Items -->
                        @foreach([
                        ['status' => 'Di Post', 'location' => 'Jakarta Pusat', 'date' => '20 Mar 2024', 'completed' =>
                        true],
                        ['status' => 'Kota Transit', 'location' => 'Bandung', 'date' => '21 Mar 2024', 'completed' =>
                        true],
                        ['status' => 'Post Center', 'location' => 'Bandung', 'date' => '22 Mar 2024', 'completed' =>
                        false],
                        ['status' => 'Tujuan', 'location' => 'Cirebon', 'date' => '-', 'completed' => false]
                        ] as $item)
                        <div class="relative flex flex-col items-center w-1/4">
                            <div
                                class="w-8 h-8 {{ $item['completed'] ? 'bg-pink-400' : 'bg-gray-200' }} rounded-full flex items-center justify-center">
                                <i
                                    class="fas {{ $item['completed'] ? 'fa-check' : 'fa-circle' }} text-white text-sm"></i>
                            </div>
                            <div class="mt-3 text-center">
                                <h3 class="font-medium text-gray-900">{{ $item['status'] }}</h3>
                                <p class="text-sm text-gray-500">{{ $item['location'] }}</p>
                                <span class="text-xs text-gray-400">{{ $item['date'] }}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Connecting Line -->
                    <div class="absolute top-4 left-0 right-0 h-0.5 bg-gray-200 -z-10"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</x-app-layout>