@extends('layouts.app')

@section('pageTitle')
    فاتورة بيع
@endsection

@section('content')
    <div class="row block-ltr text-right" >
        <div class="col-md-4">
            @include('common.forms.select',
                array(
                      'options'=> $branches,
                      'value'=> 'id',
                      'input_label'=> 'الفرع',
                      'label'=> 'name',
                      'name'=> 'branch'
                )
            )
        </div>
        <div class="col-md-4">
            @include('common.forms.input', ['label'=> 'التاريخ', 'name'=> 'date', 'type'=> 'date'])
        </div>
        <div class="col-md-4 region-top-right">
            @isset($region_top_right)
                {!! $region_top_right !!}
            @endisset
        </div>
    </div>
    <hr>
    <div class="table-product table-responsive table-bordered">
        <table class="table color-table inverse-table">
            <thead>
            <tr>
                <th class="product-name">
                    المنتج
                    <select id="select-product" class="select2 form-control" style="width: 100%; height:36px;">
                        <option>اختار المنتج</option>
                        @foreach($categoryWithProducts as $category)
                            @if (count($category->products))
                                <optgroup label="@isset($category->rowParent->name) {{ $category->rowParent->name }} , @endisset {{ $category->name }}">
                                    @foreach($category->products as $product)
                                        @if ($product->quantity > 1)
                                            <option value="{{ $product->id }}"
                                                    quantity="{{ $product->quantity }}"
                                                    price="@if($invoicesType->slug === 'selling-1'){{ $product->price }}@elseif ($invoicesType->slug === 'selling-2'){{ $product->price2 }}@endif">
                                                {{ $product->name }}
                                                <span>
                                                {{--@if($invoicesType->slug === 'selling-1')--}}
                                                    {{--{{ $product->price }}--}}
                                                {{--@elseif ($invoicesType->slug === 'selling-2')--}}
                                                    {{--{{ $product->price2 }}--}}
                                                {{--@endif--}}
                                        </span>
                                            </option>
                                        @else
                                            <option disabled style="color: red">
                                                {{ $product->name }}
                                            </option>
                                        @endif
                                    @endforeach
                                </optgroup>
                            @endif
                        @endforeach

                    </select>
                </th>
                <th>
                    سعر المنتج
                    <div id="product-price" price="">0 جنية</div>
                </th>
                <th>
                    الكمية
                    <input type="number" id="quantity" name="quantity" class="form-control" value="1" min="1">
                </th>
                <th>
                    اجمالي السعر
                    <div id="product-total-price">0 جنية</div>
                </th>
                <th>
                    <button type="button" id="add-product-invoice" class="btn btn-success">اضافة</button>
                </th>
            </tr>
            </thead>
            <tbody id="invoice-products">

            </tbody>
        </table>
    </div>
    <hr>
    <div class="row block-ltr">
        <div class="col-md-3">
            <label for="invoice-total">المبلغ المتبقي</label>
            <input type="text" id="remaining" name="remaining" class="form-control" readonly value="0">
            @include('common.forms.input', ['label'=> 'المبلغ المدفوع', 'name'=> 'payed', 'type'=> 'number', 'value'=> 0])
        </div>
        <div class="col-md-3">
            <label for="invoice-total">المبلغ المستحق</label>
            <input type="text" id="invoice-total" name="invoice_total" class="form-control" readonly value="0">
            @include('common.forms.input', ['label'=> 'القيمة المضافة', 'name'=> 'added_value', 'type'=> 'number', 'value'=> 0])
        </div>
        <div class="col-md-3">
            <label for="invoice-total">اجمالي الفاتورة</label>
            <input type="text" id="invoice-sub-total" name="invoice_sub_total" class="form-control" readonly value="0">
            @include('common.forms.input', ['label'=> 'الخصم', 'name'=> 'discount', 'type'=> 'number', 'value'=> 0])
        </div>
        <div class="col-md-3 text-center">
            <button class="btn btn-success" id="save-invoice">حفظ</button>
            <button class="btn btn-danger" onclick="location.reload()">فاتورة جديدة</button>
        </div>
    </div>

@endsection

@section('after_js')
    <script>
        //global variables
        let invoiceProductsArray = [],
            invoiceProductsWithAllDetails = [];

        //events
        $(document).on('change', '#select-product', function () {
            let option = $('#select-product optgroup option[value="' + $(this).val() + '"]'),
                productPrice = option.attr('price'),
                productMaxQuantity = option.attr('quantity'),
                quantityInput = $('#quantity'),
                productPriceDiv = $('#product-price');

            quantityInput.attr('max', productMaxQuantity);
            quantityInput.val(1);

            productPriceDiv.html(productPrice + ' جنية ');
            productPriceDiv.attr('price', productPrice);
            $('#product-total-price').html(productPrice + ' جنية ');
            calculateInvoice();
        });

        $(document).on('keyup', '#quantity', function () {
            let max = $(this).attr('max'),
                value = $(this).val(),
                productPrice = $('#product-price').attr('price');

            if (parseInt(value) > parseInt(max)) {
                swal('خطاء في تحديد الكمية', 'غير متوافر سوي ' + max, "error");
                value = max;
                $(this).val(value);
            }

            $('#product-total-price').html(productPrice * value + ' جنية ');
            calculateInvoice();
        });

        $(document).on('click', '#add-product-invoice', function () {
            let product = $('#select-product').val(),
                option = $('#select-product optgroup option[value="' + product + '"]'),
                quantity = $('#quantity'),
                row = '<tr id="row-' + product + '">';

            if (isNaN(product)){
                swal('خطاء في تحديد المنتج', 'يجب تحديد المنتج  ', "error");
                return void (0);
            }

            const isSelected = invoiceProductsArray.find(function(element) {
                return element === product;
            });
            if (isSelected) {
                swal('خطاء في تحديد المنتج', 'لا يمكن اضافة المنتج اكثر من مره ', "error");
                return void (0);
            }

            const productTotal = parseInt(quantity.val()) * parseFloat(option.attr('price'));

            row += '<td>' + option.html() + '</td>';
            row += '<td>' + option.attr('price') + '</td>';
            row += '<td>' + quantity.val() + '</td>';
            row += '<td class="product-total">' + productTotal + '</td>';
            row += '<td>' +
                        // '<button class="btn btn-info edit-row" row-id="' + product + '">تعديل</button>' +
                        '<button class="btn btn-danger delete-row" row-id="' + product + '">حذف</button>' +
                    '</td>';
            row += '</tr>';

            $('#invoice-products').append(row);
            invoiceProductsArray.push(product);
            invoiceProductsWithAllDetails.push({
                id: product,
                price: option.attr('price'),
                quantity: quantity.val(),
                product_total: productTotal
            });
            calculateInvoice();
        });

        $(document).on('click', '.delete-row', function () {
            const rowId = $(this).attr('row-id');
            Swal({
                title: 'هل انت متاكد?',
                text: "سيتم حذف المنتج من الفاتورة!",
                type: 'warning',
                showCancelButton: true,
                cancelButtonText: 'الغاء',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'نعم, احذف!'
            }).then((result) => {
                if (result.value) {
                    $('#row-'+rowId).remove();
                    const filtered = invoiceProductsArray.filter(function(value){
                        return value !== rowId;
                    });

                    const filteredProducts = invoiceProductsWithAllDetails.filter(function(value){
                        return value.id !== rowId;
                    });

                    invoiceProductsArray = filtered;
                    invoiceProductsWithAllDetails = filteredProducts;
                }
                calculateInvoice();
                return void (0);
            });

        });

        $(document).on('keyup', '#discount, #added_value, #payed', function () {
            calculateInvoice();
        });

        $(document).on('click', '#save-invoice', function () {
            const formData = {
                customer_id: $('#customer').val(),
                branch_id: $('#branch').val(),
                date: $('#date').val(),
                sub_total: $('#invoice-sub-total').val(),
                total: $('#invoice-total').val(),
                added_value: $('#added_value').val(),
                discount_value: $('#discount').val(),
                payed: $('#payed').val(),
                remaining: $('#remaining').val(),
                note: $('#note').val(),
                products: invoiceProductsWithAllDetails,
                _token: '{{ csrf_token() }}'
            };

            $.ajax({
                url: '{{ route('invoices.store', $invoicesType->slug) }}',
                type: 'POST',
                data: formData,
                success: function (res) {
                    console.log(res);
                    if (res.status == true) {
                        swal(res.title, res.message, "success");
                    } else {
                        swal(res.title, res.message, "error");
                    }
                },
                error: function (res) {
                    console.log(res);
                }
            });
        });

        //functions
        function calculateInvoice() {
            const products = $('.product-total'),
                addedValue = $('#added_value').val(),
                discount = $('#discount').val(),
                payed = $('#payed').val();

            let subTotal = 0;
            for(let i=0; i < products.length; i++) {
                subTotal += parseFloat(products[i].innerText);
            }

            $('#invoice-sub-total').val(subTotal);
            //validation @TODO full validation
            if (isNaN(addedValue) ||
                isNaN(discount) ||
                isNaN(payed) ||
                addedValue === '' ||
                discount === '' ||
                payed === ''
            ) return void (0);
            //calculate
            const total = subTotal + parseFloat(addedValue) - parseFloat(discount);
            $('#invoice-total').val(total);
            $('#remaining').val(total - payed);
        }
        
        function validInvoice() {
            //
        }
    </script>
    <script>
        //@TODO select2 ajax
        // $(".ajax").select2({
        //     ajax: {
        //         url: "https://api.github.com/search/repositories",
        //         dataType: 'json',
        //         delay: 250,
        //         data: function(params) {
        //             return {
        //                 q: params.term, // search term
        //                 page: params.page
        //             };
        //         },
        //         processResults: function(data, params) {
        //             // parse the results into the format expected by Select2
        //             // since we are using custom formatting functions we do not need to
        //             // alter the remote JSON data, except to indicate that infinite
        //             // scrolling can be used
        //             params.page = params.page || 1;
        //             return {
        //                 results: data.items,
        //                 pagination: {
        //                     more: (params.page * 30) < data.total_count
        //                 }
        //             };
        //         },
        //         cache: true
        //     },
        //     escapeMarkup: function(markup) {
        //         return markup;
        //     }, // let our custom formatter work
        //     minimumInputLength: 1,
        //     //templateResult: formatRepo, // omitted for brevity, see the source of this page
        //     //templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
        // });
    </script>
@endsection
