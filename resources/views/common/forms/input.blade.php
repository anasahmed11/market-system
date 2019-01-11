<div class="form-group">
    <label for="{{ $name }}" class="control-label">{{ $label }}:</label>
    <input type="{{ $type }}"
           class="form-control"
           id="{{ $name }}"
           name="{{ $name }}"
            @isset ($attrs)
                @foreach ($attrs as $attr)
                    {{ $attr['name'] }} = "{{ $attr['value'] }}"
                @endforeach
            @endif
    >
</div>
