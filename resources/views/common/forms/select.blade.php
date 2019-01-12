<div class="form-group">
    <label for="{{ $name }}" class="control-label">نوع الدين:</label>
    <select name="{{ $name }}" id="{{ $name }}" class="form-control">
        @foreach($options as $option)
            <option value="{{ $option->$value }}">{{ $option->$label }}</option>
        @endforeach
    </select>
</div>
