<div class="fixed w-[280px] h-screen bg-white shadow-lg p-6 left-0 top-0 z-50">
    <div class="text-center mb-10 pb-5 border-b-2 border-gray-100">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class=" mx-auto mb-4 rounded-2xl p-1 ">
        {{-- <h2 class="text-gray-800 text-xl font-semibold">Tracking Office</h2> --}}
    </div>

    <div class="mt-8">
        <a href="{{ route('dashboard') }}"
            class="flex items-center px-5 py-4 {{ request()->routeIs('dashboard') ? 'text-white bg-pink-400' : 'text-gray-600 hover:bg-gray-100 hover:text-pink-400' }} rounded-lg mb-2 transition-all duration-300">
            <i class="fas fa-home w-6 mr-3 text-lg"></i>
            <span>Dashboard</span>
        </a>
        <a href="{{ route('create.surat') }}"
            class="flex items-center px-5 py-4 {{ request()->routeIs('create.surat') ? 'text-white bg-pink-400' : 'text-gray-600 hover:bg-gray-100 hover:text-pink-400' }} rounded-lg mb-2 transition-all duration-300">
            <i class="fas fa-envelope w-6 mr-3 text-lg"></i>
            <span>Create Surat</span>
        </a>
        <a href="{{ route('surat.masuk') }}"
            class="flex items-center px-5 py-4 {{ request()->routeIs('surat.masuk') ? 'text-white bg-pink-400' : 'text-gray-600 hover:bg-gray-100 hover:text-pink-400' }} rounded-lg mb-2 transition-all duration-300">
            <i class="fas fa-inbox w-6 mr-3 text-lg"></i>
            <span>Surat Masuk</span>
        </a>
        <a href="{{ route('surat.keluar') }}"
            class="flex items-center px-5 py-4 {{ request()->routeIs('surat.keluar') ? 'text-white bg-pink-400' : 'text-gray-600 hover:bg-gray-100 hover:text-pink-400' }} rounded-lg mb-2 transition-all duration-300">
            <i class="fas fa-paper-plane w-6 mr-3 text-lg"></i>
            <span>Surat Keluar</span>
        </a>
        <a href="{{ route('cek.track') }}"
            class="flex items-center px-5 py-4 {{ request()->routeIs('cek.track') ? 'text-white bg-pink-400' : 'text-gray-600 hover:bg-gray-100 hover:text-pink-400' }} rounded-lg mb-2 transition-all duration-300">
            <i class="fas fa-search w-6 mr-3 text-lg"></i>
            <span>Cek Track</span>
        </a>
        <a href="{{ route('notifikasi') }}"
            class="flex items-center px-5 py-4 {{ request()->routeIs('notifikasi') ? 'text-white bg-pink-400' : 'text-gray-600 hover:bg-gray-100 hover:text-pink-400' }} rounded-lg mb-2 transition-all duration-300">
            <i class="fas fa-bell w-6 mr-3 text-lg"></i>
            <span>Notifikasi</span>
        </a>
        <a href="{{ route('profile.edit') }}"
            class="flex items-center px-5 py-4 {{ request()->routeIs('profile.edit') ? 'text-white bg-pink-400' : 'text-gray-600 hover:bg-gray-100 hover:text-pink-400' }} rounded-lg mb-2 transition-all duration-300">
            <i class="fas fa-cog w-6 mr-3 text-lg"></i>
            <span>Settings</span>
        </a>
    </div>
</div> 