@props(['name', 'label' => '', 'required' => false])

@php
    $attributes = $attributes->class([
        'block w-full content-text-small file:mr-4 file:py-2 file:px-4 file:br-buttons file:border-0 file:text-sm file:bg-light-color file:text-button hover:file:accent-hover cursor-pointer',
        'border-red-500' => $errors->has($name),
    ])->merge([
        'required' => $required,
        'autofocus' => $autofocus ?? null,
        'autocomplete' => $autocomplete ?? null,
    ]);
@endphp

@once
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                var preview = input.parentNode.querySelector('.preview');
                if (preview) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endonce

<div>
    @if ($label)
        <x-input-label :value="$label" />
    @endif

    <label for="{{ $name }}" :value="__('Foto')">
        {{ $slot }}
        <input type="file" id="{{ $name }}" name="{{ $name }}" accept="image/*" class="hidden" {{ $attributes }} onchange="readURL(this);" />
    </label>

    <img class="preview" style="max-width: 100px; max-height: 100px; margin-top: 10px; display: none;" />
    <x-input-error :messages="$errors->get($name)" class="mt-2" />
</div>
