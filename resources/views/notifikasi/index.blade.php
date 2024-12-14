<x-app-layout>
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        @include('layouts.sidebar')

        <!-- Main Content -->
        <div class="flex-1 ml-[280px] p-8">
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-2xl font-bold text-gray-800">Notifikasi</h1>
                {{-- <div class="flex items-center">
                    <img src="{{ asset('profile.png') }}" alt="Profile" class="w-10 h-10 rounded-full mr-3">
                    <span class="text-gray-700">{{ Auth::user()->name }}</span>
                </div> --}}
            </div>

            <!-- Notification List -->
            <div class="bg-white rounded-xl shadow-sm">
                <!-- Unread Notification -->
                @foreach($notifications as $notification)
                <div class="p-6 border-b border-gray-100 {{ !$notification->read_at ? 'bg-pink-50' : '' }}">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 
                                {{ $notification->type === 'received' ? 'bg-pink-400' : 
                                   ($notification->type === 'transit' ? 'bg-blue-400' : 'bg-green-400') }} 
                                rounded-full flex items-center justify-center">
                                <i class="fas {{ $notification->type === 'received' ? 'fa-envelope' : 
                                               ($notification->type === 'transit' ? 'fa-truck' : 'fa-check-circle') }} text-white"></i>
                            </div>
                        </div>
                        <div class="ml-4 flex-1">
                            @if(!$notification->read_at)
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-medium text-gray-900">{{ $notification->title }}</h3>
                                <form method="POST" action="{{ route('notifications.markAsRead', $notification->id) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="text-sm text-pink-400 hover:text-pink-500">
                                        Tandai Dibaca
                                    </button>
                                </form>
                            </div>
                            @else
                            <h3 class="text-lg font-medium text-gray-900">{{ $notification->title }}</h3>
                            @endif
                            <p class="mt-1 text-gray-600">{{ $notification->message }}</p>
                            <span class="mt-2 text-sm text-gray-400">{{ $notification->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                </div>
                @endforeach

                @if($notifications->isEmpty())
                <div class="p-6 text-center text-gray-500">
                    Tidak ada notifikasi
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</x-app-layout>
