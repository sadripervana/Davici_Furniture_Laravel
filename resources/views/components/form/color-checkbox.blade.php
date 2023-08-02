@props(['name', 'value'])

<x-form.field>
    <x-form.label :name="$name"/>

    @foreach (['red', 'blue', 'green', 'yellow', 'orange', 'purple', 'pink'] as $color)
        <span id="{{ $color }}">
            {{ ucfirst($color) }}:<input type="checkbox" 
                name="{{ $name }}[]"
                class="mr-5"
                id="{{ $color }}"
                value="{{ $color }}"
                @if(isset($value) && is_array($value) && in_array($color, $value)) checked @endif
            >
        </span>
    @endforeach

    <x-form.error :name="$name"/>
</x-form.field>
