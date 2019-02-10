<script>
    function getCategoryTypes() {
        $.ajax({
            type: 'GET',
            url: '{{ route('categories.parents') }}',
            success: function (res) {
                $('#types').html(res);
            }
        });
    }
    $(document).on('click', '.add-new', function () {
        if ($(this).attr('parent') == "1") {
            $('#types').html('');
            return void (0);
        }
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
        var isParent = $(this).attr('parent');
        if (isParent == 1) return 0;
        getCategoryTypesEdit(url);
    });
</script>
