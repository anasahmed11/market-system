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
      

    });
    



    /** ====================ajax pagination======================== */

    $(window).on('hashchange', function() {
        if (window.location.hash) {
            var page = window.location.hash.replace('#', '');
            if (page == Number.NaN || page <= 0) {
                return false;
            }else{
                getData(page);
            }
        }
    });
    
    $(document).ready(function()
    {
        $(document).on('click', '.pagination a',function(event)
        {
            event.preventDefault();
  
            $('li').removeClass('active');
            $(this).parent('li').addClass('active');
  
            var myurl = $(this).attr('href');
            var page=$(this).attr('href').split('page=')[1];
  
            getData(page);
        });
  
    });
  
    function getData(page){
        $.ajax(
        {
            url: '?page=' + page,
            type: "get",
            datatype: "html"
        }).done(function(data){
            $("#main-table").empty().html(data);
            location.hash = page;
        }).fail(function(jqXHR, ajaxOptions, thrownError){
              alert('No response from server');
        });
    }

 

    

</script>
