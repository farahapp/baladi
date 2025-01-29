$(document).ready(function(){

    $(document).on('change','#search_by_text', function(e){
        make_search();
    });
    
    $(document).on('input','#complaint_date_search', function(e){
        make_search();
    });
    
    $(document).on('change','#complaint_status_search', function(e){
        make_search();
    });
    
    function make_search() {
        var search_by_text = $("#search_by_text").val();
        var complaint_date_search = $("#complaint_date_search").val();
        var complaint_status_search = $("#complaint_status_search").val();
        var token_search = $("#token_search").val();
        var ajax_search_url = $("#ajax_search_url").val();
        jQuery.ajax({
            url: ajax_search_url,
            type: 'post',
            dataType: 'html',
            cache: false,
            data: {
                search_by_text: search_by_text,
                complaint_date_search: complaint_date_search,
                complaint_status_search: complaint_status_search,
                "_token": token_search
            },
            success: function(data) {
                $("#daily_report_ajax_serachDiv").html(data);
            },
            error: function(){}
        });
    }
    
    function make_search_forPagenation(urlV) {
        var search_by_text = $("#search_by_text").val();
        var complaint_date_search = $("#complaint_date_search").val();
        var complaint_status_search = $("#complaint_status_search").val();
        var token_search = $("#token_search").val();
        jQuery.ajax({
            url: urlV,
            type: 'post',
            dataType: 'html',
            cache: false,
            data: {
                search_by_text: search_by_text,
                complaint_date_search: complaint_date_search,
                complaint_status_search: complaint_status_search,
                "_token": token_search
            },
            success: function(data) {
                $("#daily_report_ajax_serachDiv").html(data);
            },
            error: function(){}
        });
    }
    
    
    
    $(document).on('click','#Permission_sub_menues_ajax_pagination_in_search a', function(e){
    e.preventDefault();
     var search_by_text = $("#search_by_text").val();
    var driving_school_status_search = $("#driving_school_status_search").val();
    
    $('p').removeClass('active');
    $(this).parent('p').addClass('active');
    
     var maneUrl=$(this).attr("href");
    
     make_search_forPagenation(maneUrl);
    
    
    });
    
    
   
    

    //========================================================
    
   
    
    
    //========================================================
    
    });
    
    