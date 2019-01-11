/**
 * Add new form
 */
$('form.form-add').submit(function (e) {
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
                swal(res.title, res.message, "success")
            } else {
                //Error Message
                swal(res.title, res.message, "error")
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
/**
 * Error handle
 */
function formErrors(errorsForm) {
    for (var errors in errorsForm) {
        var startErrors = '<div class="alert alert-danger"> <ul> ';
        var contentErrors = '';
        for (var error in errorsForm[errors]) {
            contentErrors += '<li>'+ errorsForm[errors][error] +'</li>';
        }
        var endErrors = '</ul> </div>';
        $('#'+errors).after(startErrors + contentErrors + endErrors);
    }
}
/**
 * Search
 */
$(document).on('keyup', '.input-search', function () {
   $(this).parent().submit();
});

$('form.form-search').submit(function (e) {
    e.preventDefault();
    var url = $(this).attr('action'),
        method = $(this).attr('method'),
        formData = $(this).serialize();

    $.ajax({
        url: url,
        type: method,
        data: formData,
        success: function (res) {
            if (res.status)  {
                $('#main-table').html(res.table);
            }
        },
        error: function(res) {
            console.log(res);
        }
    })
});
