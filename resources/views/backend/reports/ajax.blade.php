<script>
    function getCategoryTypes() {
        $.ajax({
            type: 'GET',
            url: '{{ route('categories.types') }}',
            success: function (res) {
                $('#types').html(res);
            }
        });
    }
    $(document).on('click', '#add-new-product', function () {
        getCategoryTypes();
    });

    function getfilterDate(flag) {
        $.ajax({
            type: 'POST',
            data: { 'flag' : flag ,
                    '_token': {{ csrf_token() }} 
                 },
            url: '{{ route('report.filter') }}',
            success: function (res) {
                $('#main-table').html(res.table);
            }
        });
    }
    $(document).on('click', '.edit', function () {
        var url = $(this).attr('type-url');
        setTimeout(function(){
            getCategoryTypesEdit(url);
        }, 1000);

    });

    $(document).on('click', '.filter', function () {
        var flag = $(this).attr('data-flag');
        //setTimeout(function(){
           // getfilterDate(flag);
            $.ajax({
            type: 'POST',
            data: { 'flag' : flag ,
                    '_token': '{{ csrf_token() }}' 
                 },
            url: '{{ route('report.filter') }}',
            success: function (res) {
                $('#main-table').html(res.table);
            }
        });
       // }, 1000);

    });

    

</script>
