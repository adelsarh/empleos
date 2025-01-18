@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'text-sm text-red-600 space-y-1']) }}>
        @foreach ((array) $messages as $message)
            <li class="border-l-4 border-red-600 text-red-600 font-semibold p-2">{{ $message }}</li>
        @endforeach
    </ul>
@endif
