
$(function(){
    /* delete supplier-invoice*/
    $(document).on('click',".delete-supplier-invoice",function(e) {
        var invoice_id=$(this).data('id');
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
                    type: 'GET',
                    url: 'invoices/delete/'+invoice_id+'/buying-1',
                    processData: false,
                    success: function (res) {
                        if((res.errors)){
                            Swal.fire({
                                type: 'error',
                                title: 'عفوا حاول مره اخري',
                                text: 'حدث خطا في الجذف',
                            })
                        }else{
                            $(".invoice-"+invoice_id).remove();
                            Swal.fire(
                                'تم الحذف',
                                'بنجاح',
                                'success'
                            )
                        }
                    }
                });
            } else {
                swal("تم الغاء الحذف", "لم يتم الحذف :)", "error");
            }
        });
        e.preventDefault();

    });

    /* delete customer-invoice*/
    $(document).on('click',".delete-customer-invoice",function(e) {
        var c_invoice_id=$(this).data('id');
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
                    type: 'GET',
                    url: 'delete/'+c_invoice_id+'/selling-1',
                    processData: false,
                    success: function (res) {
                        if((res.errors)){
                            Swal.fire({
                                type: 'error',
                                title: 'عفوا حاول مره اخري',
                                text: 'حدث خطا في الجذف',
                            })
                        }else{
                            $(".customer-invoice-"+c_invoice_id).remove();
                            Swal.fire(
                                'تم الحذف',
                                'بنجاح',
                                'success'
                            )
                        }
                    }
                });
            } else {
                swal("تم الغاء الحذف", "لم يتم الحذف :)", "error");
            }
        });
        e.preventDefault();

    });
    /* ------------- supplier-invoice-details --------------*/
    $(document).on('click',".s-invoice-details",function(e){
        var id=$(this).data('id');
        $.ajax({
            type: 'GET',
            url: 'this-invoices/'+id,
            processData: false,
            success: function (data) {
                if((data.errors)){
                    Swal.fire({
                        type: 'error',
                        title: 'عفوا',
                        text: 'حدثت مشكله ! ',
                    })
                }else{
                    $(".hello").html(
                        "<tr></tr>"
                    );
                    Swal.fire(
                        'سيتم عرض التفاصيل الان',
                        '',
                        'success'
                    )
                    $.each(data, function(i, item) {
                        $(".hello").append(
                            "<tr>"+
                            "<td>"+item.id +"</td>"+
                            "<td>"+item.product.name+"</td>"+
                            "<td>"+item.category.name +"</td>"+
                            "<td>"+item.price +"</td>"+
                            "<td>"+item.quantity +"</td>"+
                            "<td>"+item.sub_total  +"</td>"+"</tr>"
                        )
                        });
                }

            }

        });
        e.preventDefault();


    });
    /* ------------- customer-invoice-details --------------*/
    $(document).on('click',".invoices-details",function(e){
        var id=$(this).data('id');
        $.ajax({
            type: 'GET',
            url: 'this-customer-invoices/'+id,
            processData: false,
            success: function (data) {
                if((data.errors)){
                    Swal.fire({
                        type: 'error',
                        title: 'عفوا',
                        text: 'حدثت مشكله ! ',
                    })
                }else{
                    $(".helloo").html(
                        "<tr></tr>"
                    );
                    Swal.fire(
                        'سيتم عرض التفاصيل الان',
                        '',
                        'success'
                    )
                    $.each(data, function(i, item) {
                        $(".helloo").append(
                            "<tr>"+
                            "<td>"+item.id +"</td>"+
                            "<td>"+item.product.name+"</td>"+
                            "<td>"+item.category.name +"</td>"+
                            "<td>"+item.price +"</td>"+
                            "<td>"+item.quantity +"</td>"+
                            "<td>"+item.sub_total  +"</td>"+"</tr>"
                        )
                    });
                }

            }

        });
        e.preventDefault();


    });



    /* ------------- stock state (full)--------------*/
    $(document).on('click',".full-stock",function(e){
        $.ajax({
            type: 'GET',
            url: 'full-stock',
            processData: false,
            success: function (data) {
                if((data.errors)){
                    Swal.fire({
                        type: 'error',
                        title: 'عفوا',
                        text: 'حدثت مشكله ! ',
                    })
                }else{
                    $(".stock").html(
                        "<tr></tr>"
                    );
                    Swal.fire(
                        'سيتم عرض التفاصيل الان',
                        '',
                        'success'
                    )
                    $.each(data, function(i, item) {
                        $(".stock").append(
                            "<tr>"+
                            "<td>"+item.id +"</td>"+
                            "<td>"+item.category.name+"</td>"+
                            "<td>"+item.name+"</td>"+
                            "<td>"+item.price +"</td>"+
                            "<td>"+item.price2 +"</td>"+
                            "<td>"+item.reorder_point +"</td>"+
                            "<td>"+item.quantity +"</td>"+
                            "<td>"+item.description  +"</td>"+"</tr>"
                        )
                    });
                }

            }

        });
        e.preventDefault();


    });

    $(document).on('click',".empty-stock",function(e){
        $.ajax({
            type: 'GET',
            url: 'empty-stock',
            processData: false,
            success: function (data) {
                if((data.errors)){
                    Swal.fire({
                        type: 'error',
                        title: 'عفوا',
                        text: 'حدثت مشكله ! ',
                    })
                }else{
                    $(".stock").html(
                        "<tr></tr>"
                    );
                    Swal.fire(
                        'سيتم عرض التفاصيل الان',
                        '',
                        'success'
                    )
                    $.each(data, function(i, item) {
                        $(".stock").append(
                            "<tr>"+
                            "<td>"+item.id +"</td>"+
                            "<td>"+item.category.name+"</td>"+
                            "<td>"+item.name+"</td>"+
                            "<td>"+item.price +"</td>"+
                            "<td>"+item.price2 +"</td>"+
                            "<td>"+item.reorder_point +"</td>"+
                            "<td>"+item.quantity +"</td>"+
                            "<td>"+item.description +"</td>"+"</tr>"
                        )
                    });
                }

            }

        });
        e.preventDefault();


    });

    /* ------------- supplier-invoice-details --------------*/
    $(document).on('click',".user-details",function(e){
        var id=$(this).data('id');
        $.ajax({
            type: 'GET',
            url: 'user-details/'+id,
            processData: false,
            success: function (data) {
                if((data.errors)){
                    Swal.fire({
                        type: 'error',
                        title: 'عفوا',
                        text: 'حدثت مشكله ! ',
                    })
                }else{
                    $(".user").html(
                        "<tr></tr>"
                    );
                    Swal.fire(
                        'سيتم عرض التفاصيل الان',
                        '',
                        'success'
                    )
                    $.each(data, function(i, item) {
                            $(".user").append(
                                "<tr>"+
                                "<td>"+item.f_name +"</td>"+
                                "<td>"+item.l_name+"</td>"+
                                "<td>"+item.location+"</td>"+
                                "<td>"+item.phone+"</td>"+
                                "<td>"+item.hiring_date  +"</td>"+"</tr>"
                            )


                    });
                }

            }

        });
        e.preventDefault();


    });
    /* ------------- shift-select --------------*/
    $(document).on('click',".shift-select",function(e){
        var shift_id=$(this).data('id');
        $.ajax({
            type: 'GET',
            url: 'shift/'+shift_id,
            processData: false,
            success: function (data) {
                if((data.errors)){
                    Swal.fire({
                        type: 'error',
                        title: 'عفوا',
                        text: 'حدثت مشكله ! ',
                    })
                }else{
                    $(".shift-table").html(
                        "<tr></tr>"
                    );
                    $(".total").text(
                        "اجمالي المبيعات"
                    );
                    $(".payed").html(
                        "اجمالي المدفوع"
                    );
                    Swal.fire(
                        'سيتم عرض التفاصيل الان',
                        '',
                        'success'
                    )
                    $.each(data.data, function(i, item) {
                        $(".shift-table").append(
                            "<tr>"+
                            "<td>"+item.slug +"</td>"+
                            "<td>"+item.user.employer.f_name +" "+ item.user.employer.l_name+"</td>"+
                            "<td>"+item.customer.nickname+"</td>"+
                            "<td>"+item.branch.name +"</td>"+
                            "<td>"+item.date +"</td>"+
                            "<td>"+item.sub_total +"</td>"+
                            "<td>"+item.total +"</td>"+
                            "<td>"+item.added_value +"</td>"+
                            "<td>"+item.discount_value+"</td>"+
                            "<td>"+item.payed+"</td>"+
                            "<td>"+item.remaining +"</td>"+
                            "<td><button class='invoices-details btn btn-success' data-toggle='modal' data-target='#invoices-details' data-id='" + item.id +  "' >التفاصيل</button></td>"+
                            "</tr>"
                        )
                    });
                    $(".total").html(
                        "اجمالي المبيعات"+ '<br>'+
                        data.sum
                    );
                    $(".payed").html(
                        "اجمالي المدفوع"+ '<br>'+
                        data.payed
                    );
                }

            }

        });
        e.preventDefault();


    });

    /* ------------- today-shift-select --------------*/
    $(document).on('click',".t-shift-select",function(e){
        var t_shift_id=$(this).data('id');
        $.ajax({
            type: 'GET',
            url: 'today-shift/'+t_shift_id,
            processData: false,
            success: function (data) {
                if((data.errors)){
                    Swal.fire({
                        type: 'error',
                        title: 'عفوا',
                        text: 'حدثت مشكله ! ',
                    })
                }else{
                    $(".t-shift-table").html(
                        "<tr></tr>"
                    );
                    $(".t-total").text(
                        "اجمالي المبيعات"
                    );
                    $(".t-payed").html(
                        "اجمالي المدفوع"
                    );
                    Swal.fire(
                        'سيتم عرض التفاصيل الان',
                        '',
                        'success'
                    )
                    $.each(data.data, function(i, item) {
                        $(".t-shift-table").append(
                            "<tr>"+
                            "<td>"+item.slug +"</td>"+
                            "<td>"+item.user.employer.f_name +" "+ item.user.employer.l_name+"</td>"+
                            "<td>"+item.customer.nickname+"</td>"+
                            "<td>"+item.branch.name +"</td>"+
                            "<td>"+item.date +"</td>"+
                            "<td>"+item.sub_total +"</td>"+
                            "<td>"+item.total +"</td>"+
                            "<td>"+item.added_value +"</td>"+
                            "<td>"+item.discount_value+"</td>"+
                            "<td>"+item.payed+"</td>"+
                            "<td>"+item.remaining +"</td>"+
                            "<td><button class='invoices-details btn btn-success' data-toggle='modal' data-target='#invoices-details' data-id='" + item.id +  "' >التفاصيل</button></td>"+
                            "</tr>"
                        )
                    });
                    $(".t-total").html(
                        "اجمالي المبيعات"+ '<br>'+
                        data.sum
                    );
                    $(".t-payed").html(
                        "اجمالي المدفوع"+ '<br>'+
                        data.payed
                    );
                }

            }

        });
        e.preventDefault();


    });

    /* ------------- today-shift-select --------------*/
    $(document).on('click',".all-t-shift-select",function(e){
        $.ajax({
            type: 'GET',
            url: 'today-invoice-ajax/',
            processData: false,
            success: function (data) {
                if((data.errors)){
                    Swal.fire({
                        type: 'error',
                        title: 'عفوا',
                        text: 'حدثت مشكله ! ',
                    })
                }else{
                    $(".t-shift-table").html(
                        "<tr></tr>"
                    );
                    $(".t-total").text(
                        "اجمالي المبيعات"
                    );
                    $(".t-payed").html(
                        "اجمالي المدفوع"
                    );
                    Swal.fire(
                        'سيتم عرض التفاصيل الان',
                        '',
                        'success'
                    )
                    $.each(data.data, function(i, item) {
                        $(".t-shift-table").append(
                            "<tr>"+
                            "<td>"+item.slug +"</td>"+
                            "<td>"+item.user.employer.f_name +" "+ item.user.employer.l_name+"</td>"+
                            "<td>"+item.customer.nickname+"</td>"+
                            "<td>"+item.branch.name +"</td>"+
                            "<td>"+item.date +"</td>"+
                            "<td>"+item.sub_total +"</td>"+
                            "<td>"+item.total +"</td>"+
                            "<td>"+item.added_value +"</td>"+
                            "<td>"+item.discount_value+"</td>"+
                            "<td>"+item.payed+"</td>"+
                            "<td>"+item.remaining +"</td>"+
                            "<td><button class='invoices-details btn btn-success' data-toggle='modal' data-target='#invoices-details' data-id='" + item.id +  "' >التفاصيل</button></td>"+
                            "</tr>"
                        )
                    });
                    $(".t-total").html(
                        "اجمالي المبيعات"+ '<br>'+
                        data.sum
                    );
                    $(".t-payed").html(
                        "اجمالي المدفوع"+ '<br>'+
                        data.payed
                    );
                }

            }

        });
        e.preventDefault();


    });
    /*--------------------------- السلف--------------------*/
    $(document).on('change', '.select2-employee', function () {
        emploan=$('.select2-employee option[value="' + $(this).val() + '"]').attr('loan');
        $('.loan-input').html("السلف"+ '<br>'+
            emploan );
    });
    $(document).on('click',"#new-loan",function(e){
        var loanform=$('#new-loan-form').serialize();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: 'loan',
            data: loanform,
            processData: false,
            success: function (data) {
                if((data.errors)){
                    Swal.fire({
                        type: 'error',
                        title: 'عفوا حاول مره اخرى',
                        text: 'حدث خطا ! يجب ان تملا جميع البيانات المطلوبه الموظف والتاريخ و المبلغ ',
                    })
                }else{
                    Swal.fire(
                        'تمت العمليه بنجاح',
                        '',
                        'success'
                    );
                    $('.loan-input').html("السلف"+ '<br>');

                    $(".loan-table").append("<tr class='loan-"+data.id+"'>"+
                        "<td>"+data.id+"</td>"+
                        "<td>"+data.user.employer.f_name+" "+data.user.employer.l_name+"</td>"+
                        "<td>"+data.employer.f_name+" "+data.employer.l_name+"</td>"+
                        "<td>"+data.date+"</td>"+
                        "<td>"+data.payed+"</td>"+
                        "<td>"+data.notes+"</td>"+
                        "<td><button class='edit-loan btn btn-success'  data-toggle='modal' data-target='#edit-modal-salary' data-id='" + data.id + "' data-user-id='"+ data.user_id + "' data-user-id='"+ data.user_id + "' data-employee-id='"+ data.employee_id + "' data-payed='"+ data.payed + "'  data-date='"+ data.date+ "' data-notes='"+ data.notes + "'>تعديل</button></td>"
                        +
                        "<td><button class='delete-loan btn btn-danger'  data-id='" + data.id +  "' data-emp-id='" + data.employee_id+"'>حذف</button></td>"
                        +
                        "</tr>")
                }
                $('#new-loan-form').trigger("reset");
            }

        });
        e.preventDefault();


    });
    /* delete salary*/
    $(document).on('click',".delete-loan",function(e) {
        var loan_id=$(this).data('id');
        var emp_id=$(this).data('emp-id')
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
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'DELETE',
                    url: 'loan/'+loan_id+'/'+emp_id,
                    processData: false,
                    success: function (res) {
                        if((res.errors)){
                            Swal.fire({
                                type: 'error',
                                title: 'عفوا حاول مره اخري',
                                text: 'حدث خطا في الجذف',
                            })
                        }else{
                            $(".loan-"+loan_id).remove();
                            Swal.fire(
                                'تم الحذف',
                                'بنجاح',
                                'success'
                            )
                        }
                    }
                });
            } else {
                swal("تم الغاء الحذف", "لم يتم الحذف :)", "error");
            }
        });
        e.preventDefault();

    });
    $(".edit-loan").click(function(){
        $("#edit-loan-user-id").val($(this).data('user-id'));
        $("#edit-loan-date").val($(this).data('date'));
        $("#edit-loan-payed").val($(this).data('payed'));
        $("#edit-loan-notes").val($(this).data('notes'));
        $('.select2-employee option[value="' + $(this).data('employee-id') + '"]').attr("selected","selected");
        sloan=$('.select2-employee option[value="' + $(this).data('employee-id') + '"]').attr('loan');
        $('.loan-input').html("السلف"+ '<br>'+
            sloan );

        loanid=$(this).data('id');
    });
    $(document).on('click',"#edit-loan",function(e){
        var eloanform=$('#edit-loan-form').serialize();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'PUT',
            url: 'loan/'+loanid,
            data: eloanform,
            processData: false,
            success: function (data) {
                if((data.errors)){
                    Swal.fire({
                        type: 'error',
                        title: 'عفوا حاول مره اخرى',
                        text: 'حدث خطا ! يجب ان تملا جميع البيانات المطلوبه الموظف والتاريخ و المبلغ ',
                    })
                }else{
                    Swal.fire(
                        'تمت العمليه بنجاح',
                        '',
                        'success'
                    );
                    $('.loan-input').html("السلف"+ '<br>');

                    $(".loan-"+loanid).replaceWith("<tr class='loan-"+data.id+"'>"+
                        "<td>"+data.id+"</td>"+
                        "<td>"+data.user.employer.f_name+" "+data.user.employer.l_name+"</td>"+
                        "<td>"+data.employer.f_name+" "+data.employer.l_name+"</td>"+
                        "<td>"+data.date+"</td>"+
                        "<td>"+data.payed+"</td>"+
                        "<td>"+data.notes+"</td>"+
                        "<td><button class='edit-loan btn btn-success'  data-toggle='modal' data-target='#edit-modal-salary' data-id='" + data.id + "' data-user-id='"+ data.user_id + "' data-user-id='"+ data.user_id + "' data-employee-id='"+ data.employee_id + "' data-payed='"+ data.payed + "'  data-date='"+ data.date+ "' data-notes='"+ data.notes + "'>تعديل</button></td>"
                        +
                        "<td><button class='delete-loan btn btn-danger'  data-id='" + data.id +  "' data-emp-id='" + data.employee_id+"'>حذف</button></td>"
                        +
                        "</tr>")
                }
                $('#edit-loan-form').trigger("reset");
            }

        });
        e.preventDefault();


    });

    /*--------------------------- المرتبات--------------------*/
    $(document).on('change', '.select-employee', function () {
        empsalary=$('.select-employee option[value="' + $(this).val() + '"]').attr('salary');
        $('.salary-input').html("المرتب"+ '<br>'+
            empsalary );
    });
    $(document).on('click',"#new-salary",function(e){
        var salaryform=$('#new-salary-form').serialize();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: 'salary',
            data: salaryform,
            processData: false,
            success: function (data) {
                if((data.errors)){
                    Swal.fire({
                        type: 'error',
                        title: 'عفوا حاول مره اخرى',
                        text: 'حدث خطا ! يجب ان تملا جميع البيانات المطلوبه الموظف والتاريخ و المبلغ ',
                    })
                }else{
                    Swal.fire(
                        'تمت العمليه بنجاح',
                        '',
                        'success'
                    );
                    $('.salary-input').html("المرتب"+ '<br>');

                    $(".salary-table").append("<tr class='salary-"+data.id+"'>"+
                        "<td>"+data.id+"</td>"+
                        "<td>"+data.user.employer.f_name+" "+data.user.employer.l_name+"</td>"+
                        "<td>"+data.employer.f_name+" "+data.employer.l_name+"</td>"+
                        "<td>"+data.date+"</td>"+
                        "<td>"+data.payed+"</td>"+
                        "<td>"+data.remaining+"</td>"+
                        "<td>"+data.notes+"</td>"+
                        "<td><button class='edit-salary btn btn-success'  data-toggle='modal' data-target='#edit-modal-salary' data-id='" + data.id + "' data-user-id='"+ data.user_id + "' data-user-id='"+ data.user_id + "' data-employee-id='"+ data.employee_id + "' data-payed='"+ data.payed + "' data-remaining='"+ data.remaining + "' data-date='"+ data.date+ "' data-notes='"+ data.notes + "'>تعديل</button></td>"
                        +
                        "<td><button class='delete-salary btn btn-danger'  data-id='" + data.id +  "' >حذف</button></td>"
                        +
                        "</tr>")
                }
                $('#new-salary-form').trigger("reset");
            }

        });
        e.preventDefault();


    });
    /* delete salary*/
    $(document).on('click',".delete-salary",function(e) {
        var salary_id=$(this).data('id');
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
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'DELETE',
                    url: 'salary/'+salary_id,
                    processData: false,
                    success: function (res) {
                        if((res.errors)){
                            Swal.fire({
                                type: 'error',
                                title: 'عفوا حاول مره اخري',
                                text: 'حدث خطا في الجذف',
                            })
                        }else{
                            $(".salary-"+salary_id).remove();
                            Swal.fire(
                                'تم الحذف',
                                'بنجاح',
                                'success'
                            )
                        }
                    }
                });
            } else {
                swal("تم الغاء الحذف", "لم يتم الحذف :)", "error");
            }
        });
        e.preventDefault();

    });
    $(".edit-salary").click(function(){
        $("#edit-salary-user-id").val($(this).data('user-id'));
        $("#edit-salary-date").val($(this).data('date'));
        $("#edit-payed").val($(this).data('payed'));
        $("#edit-remaining").val($(this).data('remaining'));
        $("#edit-notes").val($(this).data('notes'));
        $('.select-employee option[value="' + $(this).data('employee-id') + '"]').attr("selected","selected");
        ssalary=$('.select-employee option[value="' + $(this).data('employee-id') + '"]').attr('salary');
        $('.salary-input').html("المرتب"+ '<br>'+
            ssalary );

        salid=$(this).data('id');
    });
    $(document).on('click',"#edit-salary",function(e){
        var esalaryform=$('#edit-salary-form').serialize();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'PUT',
            url: 'salary/'+salid,
            data: esalaryform,
            processData: false,
            success: function (data) {
                if((data.errors)){
                    Swal.fire({
                        type: 'error',
                        title: 'عفوا حاول مره اخرى',
                        text: 'حدث خطا ! يجب ان تملا جميع البيانات المطلوبه الموظف والتاريخ و المبلغ ',
                    })
                }else{
                    Swal.fire(
                        'تمت العمليه بنجاح',
                        '',
                        'success'
                    );
                    $('.salary-input').html("المرتب"+ '<br>');

                    $(".salary-"+salid).replaceWith("<tr class='salary-"+data.id+"'>"+
                        "<td>"+data.id+"</td>"+
                        "<td>"+data.user.employer.f_name+" "+data.user.employer.l_name+"</td>"+
                        "<td>"+data.employer.f_name+" "+data.employer.l_name+"</td>"+
                        "<td>"+data.date+"</td>"+
                        "<td>"+data.payed+"</td>"+
                        "<td>"+data.remaining+"</td>"+
                        "<td>"+data.notes+"</td>"+
                        "<td><button class='edit-salary btn btn-success'  data-toggle='modal' data-target='#edit-modal-salary' data-id='" + data.id + "' data-user-id='"+ data.user_id + "' data-user-id='"+ data.user_id + "' data-employee-id='"+ data.employee_id + "' data-payed='"+ data.payed + "' data-remaining='"+ data.remaining + "' data-date='"+ data.date+ "' data-notes='"+ data.notes + "'>تعديل</button></td>"
                        +
                        "<td><button class='delete-salary btn btn-danger'  data-id='" + data.id +  "' >حذف</button></td>"
                        +
                        "</tr>")
                }
                $('#edit-salary-form').trigger("reset");
            }

        });
        e.preventDefault();


    });
    /* ------------- supplier-invoice --------------*/
    $(document).on('click',".sup-invoice",function(e){
        var id=$(this).data('id');
        $.ajax({
            type: 'GET',
            url: 'supp-invoices/'+id,
            processData: false,
            success: function (data) {
                if((data.errors)){
                    Swal.fire({
                        type: 'error',
                        title: 'عفوا',
                        text: 'حدثت مشكله ! ',
                    })
                }else{
                    $(".supplier-invoice").html(
                        "<tr></tr>"
                    );
                    Swal.fire(
                        'سيتم عرض التفاصيل الان',
                        '',
                        'success'
                    )
                    $.each(data, function(i, item) {
                        $(".supplier-invoice").append(
                            "<tr class='supplier-"+item.id+"'>"+
                            "<td>"+item.slug +"</td>"+
                            "<td>"+item.employer.employer.f_name+" "+item.employer.employer.l_name+"</td>"+
                            "<td>"+item.branch.name +"</td>"+
                            "<td>"+item.date +"</td>"+
                            "<td>"+item.total +"</td>"+
                            "<td>"+item.payed +"</td>"+
                            "<td>"+item.remaining  +"</td>"+
                            "<td><button class='edit-supp-payed btn btn-success'  data-toggle='modal' data-target='#edit-modal-payed' data-id='"+item.id+"' data-payed='"+item.payed+"' data-remaining='"+item.remaining+"'> تعديل</bbutton></td>"
                            +"</tr>"
                        )
                    });
                }

            }

        });
        e.preventDefault();

    });
    /* edit-supp-payed*/
    $(document).on('click', '.edit-supp-payed',function(){
        $("#edit-payed-payed").val($(this).data('payed'));
        $('.remaining-input').html("المتبقي"+ '<br>'+
            $(this).data('remaining') );
        remain=parseFloat($(this).data('remaining'));
        payedid=$(this).data('id');
    });
    $(document).on('keyup', '#edit-payed-payed', function () {
         val = parseFloat($(this).val());
         res=remain-val;
        $('.remaining-input').html("المتبقي"+"<br>"+ res+ ' جنية ');
    });
    $(document).on('click',"#payed-edit",function(e){
        var epayedform=$('#edit-payed-form').serialize();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: 'payed/'+payedid,
            data: epayedform,
            processData: false,
            success: function (data) {
                if((data.errors)){
                    Swal.fire({
                        type: 'error',
                        title: 'عفوا حاول مره اخرى',
                        text: 'حدث خطا ! يجب ان تملا جميع البيانات المطلوبه الموظف والتاريخ و المبلغ ',
                    })
                }else{
                    Swal.fire(
                        'تمت العمليه بنجاح',
                        '',
                        'success'
                    );
                    $('.remaining-input').html("المتبقي"+ '<br>');

                        $(".supplier-"+payedid).replaceWith(
                            "<tr class='supplier-"+data.id+"'>"+
                            "<td>"+data.slug +"</td>"+
                            "<td>"+data.employer.employer.f_name+" "+data.employer.employer.l_name+"</td>"+
                            "<td>"+data.branch.name +"</td>"+
                            "<td>"+data.date +"</td>"+
                            "<td>"+data.total +"</td>"+
                            "<td>"+data.payed +"</td>"+
                            "<td>"+data.remaining  +"</td>"+
                            "<td><button class='edit-supp-payed btn btn-success'  data-toggle='modal' data-target='#edit-modal-payed' data-id='"+data.id+"' data-payed='"+data.payed+"' data-remaining='"+data.remaining+"'> تعديل</bbutton></td>"
                            +"</tr>"
                        );
                }
                $('#edit-payed-form').trigger("reset");
            },
            error:function(){
                Swal.fire({
                    type: 'error',
                    title: 'عفوا حاول مره اخرى',
                    text: 'حدث خطا ! يجب ان تدخل رقم اقل او يساوي المتبقي ',
                })
            }

        });
        e.preventDefault();


    });
    $(document).on('click',".total-in",function(e){
        $.ajax({
            type: 'GET',
            url: 'total-ind',
            processData: false,
            success: function (data) {
                if((data.errors)){
                    Swal.fire({
                        type: 'error',
                        title: 'عفوا',
                        text: 'حدثت مشكله ! ',
                    })
                }else{

                    $(".total-ind").html(
                        "اجمالي المديونات"
                    );
                    Swal.fire(
                        'سيتم عرض التفاصيل الان',
                        '',
                        'success'
                    )

                    $(".total-ind").html(
                        "اجمالي المديونات"+ '<br>'+
                        data
                    );

                }

            }

        });
        e.preventDefault();


    });
})
