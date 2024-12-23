<x-app-layout>
    <div class="flex min-h-screen">
        @include('layouts.sidebar')
        
        <!-- Main Content -->
        <div class="flex-1 ml-[280px] p-8">
            <div class="mb-8">
                <h1 class="text-2xl font-bold text-gray-800 mb-4">Tracking Surat</h1>
                
                <!-- Search Form -->
                <div class="bg-white p-6 rounded-xl shadow-sm mb-8">
                    <form method="POST" action="{{ route('history-track') }}" class="flex gap-4">
                        @csrf
                        <div class="flex-1">
                            <input type="search" 
                                id="search" 
                                name="search" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-200 focus:border-pink-400"
                                placeholder="Masukkan No Surat"
                                value="{{ request('search') }}"
                                required>
                        </div>
                        <button type="submit" 
                            class="px-6 py-2 bg-pink-400 text-white rounded-lg hover:bg-pink-500 transition-colors duration-200">
                            Cari
                        </button>
                    </form>
                </div>

                @if(isset($surat))
                    <!-- Informasi Surat -->
                    <div class="bg-white p-6 rounded-xl shadow-sm mb-8">
                        <h2 class="text-lg font-semibold mb-4">Informasi Surat</h2>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-600">No. Surat:</p>
                                <p class="font-medium">{{ $surat->no_surat }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Perihal:</p>
                                <p class="font-medium">{{ $surat->perihal }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Timeline Tracking -->
                    <div class="bg-white p-6 rounded-xl shadow-sm mb-8">
                        <h2 class="text-lg font-semibold mb-6">Status Pengiriman</h2>
                        <div class="relative">
                            <div class="flex justify-between items-center">
                                @foreach ($items as $index => $item)
                                    <div class="relative flex flex-col items-center flex-1">
                                        <!-- Status Circle -->
                                        <div class="w-12 h-12 rounded-full flex items-center justify-center
                                            {{ $item['current'] ? 'bg-yellow-400 ring-4 ring-yellow-100' : 
                                               ($item['completed'] ? 'bg-green-500' : 'bg-gray-200') }}">
                                            <i class="fas 
                                                {{ $item['current'] ? 'fa-clock text-white' :
                                                   ($item['completed'] ? 'fa-check text-white' : 'fa-circle text-gray-400') }} 
                                                text-lg"></i>
                                        </div>

                                        <!-- Status Text -->
                                        <div class="mt-4 text-center w-32">
                                            <h3 class="font-medium text-gray-900 mb-1">{{ $item['status'] }}</h3>
                                            <p class="text-sm text-gray-600">{{ $item['location'] }}</p>
                                            <span class="text-xs text-gray-400 mt-1 block">{{ $item['date'] }}</span>
                                        </div>

                                        <!-- Connecting Line -->
                                        @if (!$loop->last)
                                            <div class="absolute top-6 left-1/2 w-full h-1 
                                                {{ $item['completed'] ? 'bg-green-500' : 'bg-gray-200' }}"></div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Detail Table -->
                    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                        <div class="p-6 border-b border-gray-100">
                            <h2 class="text-lg font-semibold">Riwayat Detail</h2>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lokasi</th>
                                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal & Waktu</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($items as $item)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full
                                                    {{ $item['current'] ? 'bg-yellow-100 text-yellow-800' : 
                                                       ($item['completed'] ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800') }}">
                                                    {{ $item['status'] }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 text-sm text-gray-600">{{ $item['location'] }}</td>
                                            <td class="px-6 py-4 text-sm text-gray-600">{{ $item['date'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif

                @if (session('error'))
                    <script>
                        Swal.fire({
                            title: "Error!",
                            text: "{{ session('error') }}",
                            icon: "error",
                            confirmButtonText: "OK"
                        });
                    </script>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
