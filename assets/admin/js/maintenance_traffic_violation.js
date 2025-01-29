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

    function make_search() {
        var searchbyradio=$("input[type=radio][name=searchbyradio]:checked").val();
        var search_by_text = $("#search_by_text").val();
        var vechile_car_or_bike = $("#vechile_car_or_bike_search").val();
        var vechile_model = $("#vechile_model_search").val();
        var vechile_status = $("#vechile_status_search").val();
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
                "_token": token_search
            },
            success: function(data) {
                $("#Traffic_Violations_ajax_serachDiv").html(data);
            },
            error: function(){
            }
        });
    }

    function make_search_forPagenation(urlV) {
        var searchbyradio=$("input[type=radio][name=searchbyradio]:checked").val();
        var search_by_text = $("#search_by_text").val();
        var vechile_car_or_bike = $("#vechile_car_or_bike_search").val();
        var vechile_model = $("#vechile_model_search").val();
        var vechile_status = $("#vechile_status_search").val();
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
                "_token": token_search
            },
            success: function(data) {
                $("#Traffic_Violations_ajax_serachDiv").html(data);
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








$(document).on('click','.load_add_maintenance_to_vehicle', function(e){
    var id_value=$(this).data('id');
    var token_search = $("#token_search").val();
    var ajax_url = $("#ajax_search_load_add_maintenance_to_vehicle").val();
   jQuery.ajax({
        url: ajax_url,
        type: 'post',
        dataType: 'html',
        cache: false,
        data: {
            id: id_value,
            "_token": token_search
        },
        success: function(data) {
            $("#load_add_maintenance_to_vehicleModalBody").html(data);
           $("#load_add_maintenance_to_vehicleModal").modal("show");
           $('.select2').select2({
            theme: 'bootstrap4'
          });
        },
        error: function(){
            alert("لم يتم تحميل النموزج من فضلك حاول مرة اخرى !");
        }
    });
});


// ======================================================
// ======================================================
$(document).on('click','.load_add_vechile_spare_part', function(e){
    var id_value=$(this).data('id');
    var token_search = $("#token_search").val();
    var ajax_url = $("#ajax_search_load_add_vechile_spare_part").val();
   jQuery.ajax({
        url: ajax_url,
        type: 'post',
        dataType: 'html',
        cache: false,
        data: {
            id: id_value,
            "_token": token_search
        },
        success: function(data) {
            $("#load_add_vechile_spare_partModalBody").html(data);
           $("#load_add_vechile_spare_partModal").modal("show");
           $('.select2').select2({
            theme: 'bootstrap4'
          });
        },
        error: function(){
            alert("لم يتم تحميل النموزج من فضلك حاول مرة اخرى !");
        }
    });
});
// ======================================================

$(document).on('click','.load_add_traffic_violation', function(e){
    var id_value=$(this).data('id');
    var token_search = $("#token_search").val();
    var ajax_url = $("#ajax_load_add_traffic_violation").val();
   jQuery.ajax({
        url: ajax_url,
        type: 'post',
        dataType: 'html',
        cache: false,
        data: {
            id: id_value,
            "_token": token_search
        },
        success: function(data) {
            $("#load_add_traffic_violationModalBody").html(data);
           $("#load_add_traffic_violationModal").modal("show");
           $('.select2').select2({
            theme: 'bootstrap4'
          });
        },
        error: function(){
            alert("لم يتم تحميل النموزج من فضلك حاول مرة اخرى !");
        }
    });
});
// ======================================================


});

