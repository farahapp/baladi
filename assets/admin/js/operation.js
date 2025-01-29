$(document).ready(function(){


    $(document).on('change','#searchbyradio', function(e){
        make_search();
    });
    
    $(document).on('input','#search_by_text', function(e){
        make_search();
    });
    
    $(document).on('change','#vechile_car_or_bike_search', function(e){
        make_search();
    });

    $(document).on('change','#vechile_model_search', function(e){
        make_search();
    });
    
    $(document).on('change','#vechile_status_search', function(e){
        make_search();
    });

    $(document).on('change','#operating_company_search', function(e){
        make_search();
    });

    $(document).on('change','#operating_contract_type_search', function(e){
        make_search();
    });


    

    function make_search() {
        var searchbyradio=$("input[type=radio][name=searchbyradio]:checked").val();
        var search_by_text = $("#search_by_text").val();
        var vechile_car_or_bike = $("#vechile_car_or_bike_search").val();
        var vechile_model = $("#vechile_model_search").val();
        var vechile_status = $("#vechile_status_search").val();
        var operating_company = $("#operating_company_search").val();
        var operating_contract_type = $("#operating_contract_type_search").val();
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
                vechile_car_or_bike: vechile_car_or_bike,
                vechile_model: vechile_model,
                vechile_status: vechile_status,
                operating_company: operating_company,
                operating_contract_type: operating_contract_type,
                "_token": token_search
            },
            success: function(data) {
                $("#ajax_responce_serachDiv").html(data);
                // alert("success");
            },
            error: function(){
                // alert("error");
            }
        });
    }

    function make_search_forPagenation(urlV) {
        var searchbyradio=$("input[type=radio][name=searchbyradio]:checked").val();
        var search_by_text = $("#search_by_text").val();
        var vechile_car_or_bike = $("#vechile_car_or_bike_search").val();
        var vechile_model = $("#vechile_model_search").val();
        var vechile_status = $("#vechile_status_search").val();
        var operating_company = $("#operating_company_search").val();
        var operating_contract_type = $("#operating_contract_type_search").val();
        var token_search = $("#token_search").val();
        jQuery.ajax({
            url: urlV,
            type: 'post',
            dataType: 'html',
            cache: false,
            data: {
                searchbyradio: searchbyradio,
                search_by_text: search_by_text,
                vechile_car_or_bike: vechile_car_or_bike,
                vechile_model: vechile_model,
                vechile_status: vechile_status,
                operating_company: operating_company,
                operating_contract_type: operating_contract_type,
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







// ======================================================


});

