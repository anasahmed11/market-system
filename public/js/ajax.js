$(document).ajaxStart(function(){
    $("#wait").css("display", "block");
});

$(document).ajaxComplete(function(){
    $("#wait").css("display", "none");
});

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
            if (res.status)  {
                //Success Message
                swal(res.title, res.message, "success");
                $('#add-new').modal('toggle');
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
/**
 * Update form
 */
$(document).on('submit', 'form.form-edit', function (e) {
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
                //Success Message
                swal(res.title, res.message, "success");
                $('#edit-one').modal('toggle');
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
                formErrors(res.responseJSON.errors, true);
            }
        }
    })
});
/**
 * Error handle
 */
function formErrors(errorsForm, edit=0) {
    for (var errors in errorsForm) {
        var startErrors = '<div class="alert alert-danger"> <ul> ';
        var contentErrors = '';
        for (var error in errorsForm[errors]) {
            contentErrors += '<li>'+ errorsForm[errors][error] +'</li>';
        }
        var endErrors = '</ul> </div>';
        var select = edit ? errors + '-edit' : errors;
        $('#'+select).after(startErrors + contentErrors + endErrors);
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
    });
});
/**
 * Edit one
 */
$(document).on('click', 'button.edit', function () {
    var url = $(this).attr('url');

    $.ajax({
        url: url,
        type: 'GET',
        success: function (res) {
            console.log(res);
            $('section#edit').html(res.model);
            $('#edit-one').modal('show');
        },
        error: function(res) {
            console.log(res);
        }
    })
});
/**
 *  Delete one
 */
$(document).on('submit', 'form.delete-one', function (e) {
    e.preventDefault();
    var url = $(this).attr('action'),
        method = $(this).attr('method'),
        formData = $(this).serialize();
    Swal({
        title: 'هل انت متاكد?',
        text: "اذا تم الحذف لن نتمكن من استرجاعه!",
        type: 'warning',
        showCancelButton: true,
        cancelButtonText: 'الغاء',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'نعم, احذف!'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: url,
                type: method,
                data: formData,
                success: function (res) {
                    if (res.status)  {
                        //Success Message
                        swal(res.title, res.message, "success");
                        $('form.form-search').submit();
                    } else {
                        //Error Message
                        swal(res.title, res.message, "error");
                    }
                }
            });
        } else {
            swal("تم الغاء الحذف", "لم يتم الحذف :)", "error");
        }
    });
});
