$(document).ready(function(){


    $(document).on('change','#searchbyradio', function(e){
        make_search();
    });
    
    $(document).on('input','#search_by_text', function(e){
        make_search();
    });
    

    
    
    
    
    function make_search() {
        var searchbyradio=$("input[type=radio][name=searchbyradio]:checked").val();
        var search_by_text = $("#search_by_text").val();
        var token_search = $("#token_search").val();
        var ajax_search_url = $("#ajax_search_url").val();
        jQuery.ajax({
            url: ajax_search_url,
            type: 'post',
            dataType: 'html',
            cache: false,
            data: {
                searchbyradio: searchbyradio,
                search_by_text: search_by_text,
                "_token": token_search
            },
            success: function(data) {
                $("#ajax_responce_serachDiv").html(data);
            },
            error: function(){
            }
        });
    }
    
    function make_search_forPagenation(urlV) {
        var searchbyradio=$("input[type=radio][name=searchbyradio]:checked").val();
        var search_by_text = $("#search_by_text").val();
        var token_search = $("#token_search").val();
        var ajax_search_url = $("#ajax_search_url").val();
        jQuery.ajax({
            url: urlV,
            type: 'post',
            dataType: 'html',
            cache: false,
            data: {
                searchbyradio: searchbyradio,
                search_by_text: search_by_text,
                "_token": token_search
            },
            success: function(data) {
                $("#ajax_responce_serachDiv").html(data);
            },
            error: function(){}
        });
    }
    
    
    
    $(document).on('click','#the_legal_ajax_pagination_in_search a', function(e){
    e.preventDefault();
    
    $('p').removeClass('active');
    $(this).parent('p').addClass('active');
    
     var maneUrl=$(this).attr("href");
    
     make_search_forPagenation(maneUrl);
    
    
    });
    
    
    //=======================================================
  
    
    // ========================================================
 
    // ========================================================
   
    
    //========================================================
    
  
    
    //========================================================
    
    });
    
    