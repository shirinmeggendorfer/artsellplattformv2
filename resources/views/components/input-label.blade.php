@props(['value'])

<label {{ $attributes->merge(['class' => 'block content-text']) }}>
    {{ $value ?? $slot }}
</label>
