<div class="form-group">
    <label for="debt" class="control-label">نوع الدين:</label>
    <select name="debt" id="debt" class="select2">
        @foreach($options as $option)
        <option value="{{ $option->$value }}">{{ $option->$label }}</option>
        @endforeach
    </select>
</div>
