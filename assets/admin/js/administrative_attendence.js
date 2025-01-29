$(document).ready(function(){




$(document).on('input','#search_by_text', function(e){
    make_search();
});


$(document).on('change','#AttendanceStatus', function(e){
    make_search();
});


$(document).on('input','#attendance_date_from', function(e){
    make_search();
});

$(document).on('input','#attendance_date_to', function(e){
    make_search();
});

$(document).on('input','#attendance_time_from', function(e){
    make_search();
});

$(document).on('input','#attendance_time_to', function(e){
    make_search();
});

$(document).on('change','#date_filter', function(e){
    make_search();
});




function make_search() {
    var search_by_text = $("#search_by_text").val();
    var AttendanceStatus = $("#AttendanceStatus").val();
    var attendance_date_from = $("#attendance_date_from").val();
    var attendance_date_to = $("#attendance_date_to").val();
    var attendance_time_from = $("#attendance_time_from").val();
    var attendance_time_to = $("#attendance_time_to").val();
    var date_filter = $("#date_filter").val();
    var token_search = $("#token_search").val();
    var ajax_search_url = $("#ajax_search_url").val();
    jQuery.ajax({
        url: ajax_search_url,
        type: 'post',
        dataType: 'html',
        cache: false,
        data: {
            search_by_text: search_by_text,
            AttendanceStatus: AttendanceStatus,
            attendance_date_from: attendance_date_from,
            attendance_date_to: attendance_date_to,
            attendance_time_from: attendance_time_from,
            attendance_time_to: attendance_time_to,
            date_filter: date_filter,
            "_token": token_search
        },
        success: function(data) {
                // alert("success");
            $("#attendence_ajax_serachDiv").html(data);
        },
        error: function(){
            // alert("error");
        }
    });
}

function make_search_forPagenation(urlV) {
    var search_by_text = $("#search_by_text").val();
    var AttendanceStatus = $("#AttendanceStatus").val();
    var attendance_date_from = $("#attendance_date_from").val();
    var attendance_date_to = $("#attendance_date_to").val();
    var attendance_time_from = $("#attendance_time_from").val();
    var attendance_time_to = $("#attendance_time_to").val();
    var date_filter = $("#date_filter").val();
    var token_search = $("#token_search").val();
    jQuery.ajax({
        url: urlV,
        type: 'post',
        dataType: 'html',
        cache: false,
        data: {
            search_by_text: search_by_text,
            AttendanceStatus: AttendanceStatus,
            attendance_date_from: attendance_date_from,
            attendance_date_to: attendance_date_to,
            attendance_time_from: attendance_time_from,
            attendance_time_to: attendance_time_to,
            date_filter: date_filter,
            "_token": token_search
        },
        success: function(data) {
            $("#attendence_ajax_serachDiv").html(data);
        },
        error: function(){}
    });
}



$(document).on('click','#attendence_ajax_pagination_in_search a', function(e){
e.preventDefault();



$('p').removeClass('active');
$(this).parent('p').addClass('active');

 var maneUrl=$(this).attr("href");

 make_search_forPagenation(maneUrl);


});


//=======================================================


//========================================================

});

