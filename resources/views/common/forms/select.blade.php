@if (!isset($group))
    <div class="form-group">
        <label for="{{ $name }}" class="control-label">{{ $input_label }}:</label>
        <select name="{{ $name }}" id="{{ $name }}" class="form-control">
            @foreach($options as $option)
                @if (isset($object) && $option->$value === $object)
                    <option value="{{ $option->$value }}" selected>{{ $option->$label }}</option>
                @else
                    <option value="{{ $option->$value }}">{{ $option->$label }}</option>
                @endif
            @endforeach
        </select>
    </div>
@elseif($group)
    <div class="form-group">
        <label for="{{ $name }}" class="control-label">{{ $input_label }}:</label>
        <select name="{{ $name }}" id="{{ $name }}" class="form-control">
            @foreach($options as $option)
                <optgroup label="{{ $option->name }}">
                    @foreach($option->rowChilds as $sub)
                        @if (isset($object) && $sub->$value === $object)
                            <option value="{{ $sub->$value }}" selected>{{ $sub->$label }}</option>
                        @else
                            <option value="{{ $sub->$value }}">{{ $sub->$label }}</option>
                        @endif
                    @endforeach
                </optgroup>
            @endforeach
        </select>
    </div>
@endif
