<form action="{{ $route }}" method="post" class="form-search row">
    @csrf
    <div class="col-md-2">
        <label> {{ $searchLabel }} </label>
    </div>
    <div class="col-md-5">
        <select name="search_type" class="form-control">
            @foreach($types as $value=> $label)
                <option value="{{ $value }}">{{ $label }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-5">
        <input type="text" name="search" class="input-search form-control">
    </div>
</form>
