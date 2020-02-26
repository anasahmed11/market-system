@extends('layouts.app')

@section('pageTitle')
    فواتير
@endsection
@section('content')
    <div class="row text-center">
        <div class="col-md-6">
            <form action="{{ route('invoices.filter', $invoicesType->slug) }}" method="post">
                @csrf
                من <input type="date" name="from" class="form-group">
                الي<input type="date" name="to" class="form-group">
                <button class="btn btn-success">
                    بحث
                </button>
            </form>
        </div>

    </div>
    <br>
        {!! $table !!}
@endsection

@section('after_js')
    <script>
        $('#main-table').DataTable();
    </script>
@endsection
