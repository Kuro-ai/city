@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-pale bg-bgcyan text-pale focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) !!}>
