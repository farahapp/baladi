$(document).ready(function(){

    $(document).on('input','#search_by_name', function(e){
        make_search();
    });
    $(document).on('change','#permission_roles_id', function(e){
        make_search();
    });


    $(document).on('change','#checkForUpdatePassword', function(e){
        if($(this).val()==1){
            $("#PasswordDIV").show();
        }else{
            $("#PasswordDIV").hide();
        }
    });

 

$(document).on('click','.load_add_permission_roles_sub_menu', function(e){
    var id_value=$(this).data('id');
    var token_search = $("#token_search").val();
    var ajax_url = $("#ajax_search_load_add_permission_roles_sub_menu").val();
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
            $("#load_add_permission_roles_sub_menuModalBody").html(data);
           $("#load_add_permission_roles_sub_menuModal").modal("show");
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
// ======================================================
function make_search() {
    var search_by_name = $("#search_by_name").val();
    var permission_roles_id = $("#permission_roles_id").val();
    var token_search = $("#token_search").val();
    var ajax_search_url = $("#ajax_search_url").val();
    jQuery.ajax({
        url: ajax_search_url,
        type: 'post',
        dataType: 'html',
        cache: false,
        data: {
            search_by_name: search_by_name,
            permission_roles_id: permission_roles_id,
            "_token": token_search
        },
        success: function(data) {
            $("#Admin_account_ajax_serachDiv").html(data);
        },
        error: function(){
        }
    });
}
// ======================================================
function make_search_forPagenation(urlV) {
    var search_by_name = $("#search_by_name").val();
    var permission_roles_id = $("#permission_roles_id").val();
    var token_search = $("#token_search").val();
    jQuery.ajax({
        url: urlV,
        type: 'post',
        dataType: 'html',
        cache: false,
        data: {
            search_by_name: search_by_name,
            permission_roles_id: permission_roles_id,
            "_token": token_search
        },
        success: function(data) {
            $("#Admin_account_ajax_serachDiv").html(data);
        },
        error: function(){
        }
    });
}
// ======================================================
$(document).on('click','#Admin_account_ajax_pagination_in_search a', function(e){
    e.preventDefault();
     var search_by_text = $("#search_by_text").val();
    var permission_main_menues_id_search = $("#permission_main_menues_id_search").val();
    

    
     var maneUrl=$(this).attr("href");
    
     make_search_forPagenation(maneUrl);

    });
    // ======================================================
});

