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

  
    $(document).on('click', '.edit', function () {
        var url = $(this).attr('type-url');
        setTimeout(function(){
            getCategoryTypesEdit(url);
        }, 1000);

    });

    $(document).on('click', '.filter', function () {
        console.log("star ......");
        var flag = $(this).attr('data-flag');
        
            $.ajax({
            type: 'get',

            url: '{{ route('report.storeState') }}'+'?flag='+flag,
            success: function (res) {

                console.log("callbaCK ......");

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
            console.log(myurl);
            var page=$(this).attr('href').split('page=')[1];
  
            getData(myurl,page);
        });
  
    });
  
    function getData(myurl,page){
        $.ajax(
        {
            url: myurl,//'?page=' + page,
            type: "get",
            datatype: "html"
        }).done(function(data){
            console.log("done");
            $("#main-table").empty().html(data.table);
            //$('#main-table').html(res.table);
            //location.hash = page;
        }).fail(function(jqXHR, ajaxOptions, thrownError){
              alert('No response from server');
        });
    }

 

    

</script>
