$(document).ready(function(){

$(document).on('change','#search_by_text', function(e){
    make_search();
});

$(document).on('input','#report_date_search', function(e){
    make_search();
});

$(document).on('change','#report_status_search', function(e){
    make_search();
});

function make_search() {
    var search_by_text = $("#search_by_text").val();
    var report_date_search = $("#report_date_search").val();
    var report_status_search = $("#report_status_search").val();
    var token_search = $("#token_search").val();
    var ajax_search_url = $("#ajax_search_url").val();
    jQuery.ajax({
        url: ajax_search_url,
        type: 'post',
        dataType: 'html',
        cache: false,
        data: {
            search_by_text: search_by_text,
            report_date_search: report_date_search,
            report_status_search: report_status_search,
            "_token": token_search
        },
        success: function(data) {
            $("#daily_driving_report_ajax_serachDiv").html(data);
        },
        error: function(){}
    });
}

function make_search_forPagenation(urlV) {
    var search_by_text = $("#search_by_text").val();
    var report_date_search = $("#report_date_search").val();
    var report_status_search = $("#report_status_search").val();
    var token_search = $("#token_search").val();
    jQuery.ajax({
        url: urlV,
        type: 'post',
        dataType: 'html',
        cache: false,
        data: {
            search_by_text: search_by_text,
            report_date_search: report_date_search,
            report_status_search: report_status_search,
            "_token": token_search
        },
        success: function(data) {
            $("#daily_driving_report_ajax_serachDiv").html(data);
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


//=======================================================
$(document).on('click','.load_add_note_btn', function(e){

    var id=$(this).data("id");
    $("#do_add_permission").attr('data-id',id);
    $("#add_note_modal").modal("show");

});

$(document).on('click','#do_add_permission', function(e){

    var token_search = $("#token_search").val();
    var ajax_do_add_permission = $("#ajax_do_add_permission").val();
    var permission_sub_menues_id=$(this).data('id');
    
    var permission_name_modal = $("#permission_name_modal").val();
    if(permission_name_modal==""){
        alert("عفوا من فضلك أدخل الاسم");
        $("#permission_name_modal").focus();
        return false;
    }
   jQuery.ajax({
        url: ajax_do_add_permission,
        type: 'post',
        dataType: 'json',
        cache: false,
        data: {
            name: permission_name_modal,
            permission_sub_menues_id: permission_sub_menues_id,
            "_token": token_search
        },
        success: function(data) {
            if(data=='found'){
                alert("عفوا هذه البيانات مسجلة من قبل");
        }else{
            make_search();
            $("#add_permission_modal").modal("hide");
        }
    },
        error: function(){
            alert("لم تتم الاضافة من فضل حاول مرة اخرى !");
        }
    });
});

// ========================================================

$(document).on('click','.load_edit_permission_btn', function(e){

    var id=$(this).data('id');
    var token_search = $("#token_search").val();
    var ajax_load_edit_permission = $("#ajax_load_edit_permission").val();
    
   jQuery.ajax({
        url: ajax_load_edit_permission,
        type: 'post',
        dataType: 'html',
        cache: false,
        data: {
            id: id,
            "_token": token_search
        },
        success: function(data) {

            $("#edit_permission_modalBody").html(data);
            $("#edit_permission_modal").modal("show");
        
    },
        error: function(){
            alert("لم تتم الاضافة من فضل حاول مرة اخرى !");
        }
    });
});

// ========================================================
$(document).on('click','#do_edit_sub_permission_btn', function(e){

    var name=$("#name_edit").val();
    if(name==""){
        alert("من فضلك أدخل الإسم");
        $("#name_edit").focus();
        return false;
    }
 
    var id=$(this).data('id');
    var token_search = $("#token_search").val();
    var ajax_do_edit_permission = $("#ajax_do_edit_permission").val();
    
   jQuery.ajax({
        url: ajax_do_edit_permission,
        type: 'post',
        dataType: 'json',
        cache: false,
        data: {
            id: id,
            name: name,
            "_token": token_search
        },
        success: function(data) {
            $("#edit_permission_modal").modal("hide");
            make_search();
        
    },
        error: function(){
            alert("لم تتم الاضافة من فضل حاول مرة اخرى !");
        }
    });
});

//========================================================

$(document).on('click','.do_delete_permission_btn', function(e){
    var id_value=$(this).data('id');
    var token_search = $("#token_search").val();
    var ajax_do_delete_permission = $("#ajax_do_delete_permission").val();
   jQuery.ajax({
        url: ajax_do_delete_permission,
        type: 'post',
        dataType: 'json',
        cache: false,
        data: {
            id: id_value,
            "_token": token_search
        },
        success: function(data) {
            make_search();        
    },
        error: function(){
            alert("لم يتم الحذف من فضلك حاول مرة اخرى !".id);
        }
    });
});


//========================================================

});

