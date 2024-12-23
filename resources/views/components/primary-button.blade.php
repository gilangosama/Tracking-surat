<button {{ $attributes->merge(['type' => 'submit', 'class' => 'px-6 py-2 bg-pink-400 text-white rounded-lg hover:bg-pink-500 transition-all duration-300']) }}>
    {{ $slot }}
</button>
