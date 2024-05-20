@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-bbyellow text-sm font-medium leading-5 text-bbyellow focus:outline-none focus:border-bbyellow transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-bbyellow hover:text-yellow-500 hover:border-yellow-500 focus:outline-none focus:text-yellow-500 focus:border-gray-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
