$(window).load(function(){
    $('#bannerTable').removeAttr('style');
})
$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});
// <!-- AJAX CRUD operations -->

// add a new banner
$(document).on('click', '.add-banner-Modal', function() {
    $('.modal-title').text('Add');
    $('#add-banner-Modal').modal('show');
});

$('.banner-modal-footer').on('click', '.add', function() {
    // alert($('#banner_name').val());
    $.ajax({
        type: 'post',
        url: 'banners',
        processData: false,
        contentType: false,
        enctype: 'multipart/form-data',
        data: new FormData($('#banner-form')[0]),
  
        success: function(data) {
            // $('.errorTitle').addClass('hidden');
            // $('.errorContent').addClass('hidden');

            if ((data.errors)) {
                setTimeout(function () {
                    $('#add-banner-Modal').modal('show');
                    toastr.error('Validation error!', 'Error Alert', {timeOut: 5000});
                }, 500);

                if (data.errors.banner_name) {
                    $('.errorBannername').removeClass('hidden');
                    $('.errorBannername').text(data.errors.banner_name);
                }
                if (data.errors.banner_content) {
                    $('.errorBannercontent').removeClass('hidden');
                    $('.errorBannercontent').text(data.errors.banner_content);
                }
                if (data.errors.banner_moto) {
                    $('.errorBannermoto').removeClass('hidden');
                    $('.errorBannermoto').text(data.errors.banner_moto);
                }
                // if (data.errors.content) {
                //     $('.errorContent').removeClass('hidden');
                //     $('.errorContent').text(data.errors.content);
                // }
            } else {
                toastr.success('Successfully added banner!', 'Success Alert', {timeOut: 5000});
                $('#bannerTable').append("<tr class='item" + data.id + "'><td>" + data.id + "</td><td>" + data.banner_name + "</td><td>" + data.banner_content + "</td><td><img width=100 height=100 src="+"assets/banner/"+data.banner_image+" /></td><td class='text-center'><input type='checkbox' class='is_active_banner' data-id='" + data.id + " '></td><td>Right now</td><td><button class='banner-show-modal btn btn-success' data-id='" + data.id + "' data-banner_name='" + data.banner_name + "' data-banner_content='" + data.banner_content + "'><span class='glyphicon glyphicon-eye-open'></span> </button> <button class='banner-edit-modal btn btn-info' data-id='" + data.id + "' data-banner_name='" + data.banner_name + "' data-banner_content='" + data.banner_content + "'><span class='glyphicon glyphicon-edit'></span> </button> <button class='banner-delete-modal btn btn-danger' data-id='" + data.id + "' data-banner_name='" + data.banner_name + "' data-banner_content='" + data.banner_content + "'><span class='glyphicon glyphicon-trash'></span> </button></td></tr>");
                $('.is_active_banner').iCheck({
                    checkboxclass: 'icheckbox_square-yellow',
                    radioclass: 'iradio_square-yellow',
                    increaseArea: '20%'
                });
                $('.is_active_banner').on('ifToggled', function(event){
                    $(this).closest('tr').toggleClass('warning');
                });
                $('.is_active_banner').on('ifChanged', function(event){
                    id = $(this).data('id');
                    alert(id);
                    $.ajax({
                        type: 'post',
                        url: "{{ URL::route('changeStatus') }}",
                        data: {
                            '_token': $('input[name=_token]').val(),
                            'id': id
                        },
                        success: function(data) {
                            // empty
                        },
                    });
                });
            }
        },
    });
});

// Show a class
$(document).on('click','.banner-show-modal',function(){
    $('.modal-title').text('banner Data');
    $('#id_show').val($(this).data('id'));
    $('#banner_name_show').val($(this).data('banner_name'));
    $('#banner_content_show').val($(this).data('banner_content'));
    
    $('#banner-show-modal img').attr('src',"/assets/banner/"+$(this).data('banner_image'));
    $('#banner-show-modal').modal('show');
});



// Edit a class
$(document).on('click','.banner-edit-modal',function(){
    $('.modal-title').text('Edit banner Data');
    $('#id_edit').val($(this).data('id'));
    $('#banner_name_edit').val($(this).data('banner_name'));
    $('#banner_content_edit').val($(this).data('banner_content'));
    id = $('#id_edit').val();
    $('#banner-edit-modal img').attr('src',"/assets/banner/"+$(this).data('banner_image'));
    $('#banner-edit-modal').modal('show');
});

$('.banner-edit-modal-footer').on('click','.edit',function(){
    console.log( $("#id_edit").val());
    $.ajax({
        type:'post',
        url:'banner_edit',
        processData: false,
        contentType: false,
        enctype: 'multipart/form-data',
        data: new FormData($('#banner-edit-form')[0]),
        success:function(data){
            $('.errorName').addClass('hidden');
            // $('.errorContent').addClass('hidden');
            if((data.errors)){
                setTimeout(function(){
                    $('#banner-edit-modal').modal('show');
                    toastr.error('Validation Error','Error Alert',{timeOut:5000});
                },500);
                if((data.errors.name)){
                    $('.errorName').removeClass('hidden');
                    $('.errorName').text(data.errors.name);
                }
            }
            else{
                toastr.success('Successfully updated banner data!','Success Alert',{timeOut:5000});
                $('.item'+data.id).replaceWith("<tr class='item"+data.id+"'><td>"+data.id+"</td><td>"+data.banner_name+"</td><td>"+data.banner_content+"</td><td><img width=100 height=100 src="+"assets/banner/"+data.banner_image+" /></td><td class='text-center'><input type='checkbox' class='is_active_banner' data-id='" + data.id + "'></td><td>Right now</td><td><button class='banner-show-modal btn btn-success' data-id='" + data.id + "' data-banner_name='" + data.banner_name + "' data-banner_content='" + data.banner_content + "' ><span class='glyphicon glyphicon-eye-open'></span> </button> <button class='banner-edit-modal btn btn-info' data-id='" + data.id + "'  data-banner_name='" + data.banner_name + "' data-banner_content='" + data.banner_content + "' ><span class='glyphicon glyphicon-edit'></span> </button> <button class='banner-delete-modal btn btn-danger' data-id='" + data.id + "'  data-banner_name='" + data.banner_name + "' data-banner_content='" + data.banner_content + "' ><span class='glyphicon glyphicon-trash'></span> </button></td></tr>");
                // $('.is_active_banner').iCheck({
                //     checkboxclass: 'icheckbox_square-yellow',
                //     radioclass: 'iradio_square-yellow',
                //     increaseArea: '20%'
                // });
                $('.is_active_banner').on('ifToggled', function(event){
                    $(this).closest('tr').toggleClass('warning');
                });
                $('.is_active_banner').on('ifChanged', function(event){
                    id = $(this).data('id');
                    alert(id);
                    $.ajax({
                        type: 'post',
                        url: "{{ URL::route('change_banner_status') }}",
                        data: {
                            '_token': $('input[name=_token]').val(),
                            'id': id
                        },
                        success: function(data) {
                            // empty
                        },
                    });
                });
            }

        }
    })
});
// delete a banner
$(document).on('click','.banner-delete-modal',function(){
$('.modal-title').text('Delete banner');
$('#id_delete').val($(this).data('id'));
$('#banner_name_delete').val($(this).data('banner_name'));
$('#banner-delete-modal').modal('show');
id = $('#id_delete').val();
});
$('.banner-delete-modal-footer').on('click', '.delete', function() {
    $.ajax({
        type: 'DELETE',
        url: 'banners/' + id,
        data: {
            '_token': $('input[name=_token]').val(),
        },
        success: function(data) {
            toastr.success('Successfully deleted banner!', 'Success Alert', {timeOut: 5000});
            $('.item' + data['id']).remove();
        }
    });
});
