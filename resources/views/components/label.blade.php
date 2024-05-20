@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-pale']) }}>
    {{ $value ?? $slot }}
</label>
