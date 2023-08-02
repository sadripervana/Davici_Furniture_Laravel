@props(['name', 'value'])

<x-form.field>
    <x-form.label :name="$name"/>

    @foreach (['XS', 'S', 'M', 'L', 'XL', 'XXL'] as $size)
        <span id="{{ $size }}">
            {{ ucfirst($size) }}:<input type="checkbox" 
                name="{{ $name }}[]"
                class="mr-5"
                id="{{ $size }}"
                value="{{ $size }}"
                @if(isset($value) && is_array($value) && in_array($size, $value)) checked @endif
            >
        </span>
    @endforeach

    <x-form.error :name="$name"/>
</x-form.field>
