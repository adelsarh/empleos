<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-8 py-4 bg-gray-100 border border-gray-400 rounded-3xl font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
