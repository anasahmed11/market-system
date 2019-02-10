<script>
    function getDebtTypes() {
        $.ajax({
            type: 'GET',
            url: '{{ route('debts.types') }}',
            success: function (res) {
                $('.debt-types').html(res);
            }
        });
    }

    $(document).on('click', '.btn-add-debt', function () {
        $('#form-add-debts').attr('action', $(this).attr('url'));
        getDebtTypes();
    });

    $(document).on('click', '.btn-remove-debt', function () {
        $('#form-remove-debts').attr('action', $(this).attr('url'));
        getDebtTypes();
    });

    $('form#form-add-debts, form#form-remove-debts').submit(function (e) {
        e.preventDefault();
        var url = $(this).attr('action'),
            method = $(this).attr('method'),
            formData = $(this).serialize();

        $.ajax({
            url: url,
            type: method,
            data: formData,
            success: function (res) {
                console.log(res);
                if (res.status)  {
                    //Success Message
                    swal(res.title, res.message, "success");
                    $('#add-debts, #remove-debts').modal('hide');
                    $('form.form-search').submit();
                } else {
                    //Error Message
                    swal(res.title, res.message, "error");
                }
            },
            error: function(res) {
                // validations errors
                if (res.status === 422) {
                    console.log(res.responseJSON.errors);
                    formErrors(res.responseJSON.errors);
                }
            }
        })
    });
</script>
