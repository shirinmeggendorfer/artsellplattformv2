@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'content-text dark:text-green-400']) }}>
        {{ $status }}
    </div>
@endif
