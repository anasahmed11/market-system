
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
                        title: 'Oops... , try again',
                        text: 'Something went wrong ! ',
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
                        title: 'Oops... , try again',
                        text: 'Something went wrong ! ',
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
                        title: 'Oops... , try again',
                        text: 'Something went wrong ! ',
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
                        title: 'Oops... , try again',
                        text: 'Something went wrong ! ',
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
                        title: 'Oops... , try again',
                        text: 'Something went wrong ! ',
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
                        title: 'Oops... , try again',
                        text: 'Something went wrong !',
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
                        title: 'Oops... , try again',
                        text: 'Something went wrong !',
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
                        title: 'Oops... , try again',
                        text: 'Something went wrong !',
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
})
