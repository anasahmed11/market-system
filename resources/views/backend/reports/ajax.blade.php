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

    function getCategoryTypesEdit(url) {
        $.ajax({
            type: 'GET',
            url: url,
            success: function (res) {
                $('#types-edit').html(res);
            }
        });
    }
    $(document).on('click', '.edit', function () {
        var url = $(this).attr('type-url');
        setTimeout(function(){
            getCategoryTypesEdit(url);
        }, 1000);

    });

</script>
