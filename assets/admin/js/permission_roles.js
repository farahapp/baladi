$(document).ready(function(){

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
$(document).on('click','.load_add_permission_roles_sub_menues_actions', function(e){
    var id_value=$(this).data('id');
    var token_search = $("#token_search").val();
    var ajax_url = $("#ajax_search_load_add_permission_roles_sub_menues_action").val();
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
            $("#load_add_permission_roles_sub_menues_actionModalBody").html(data);
           $("#load_add_permission_roles_sub_menues_actionModal").modal("show");
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


});

