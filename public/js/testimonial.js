$(window).load(function(){
    $('#testimonialTable').removeAttr('style');
})
$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});
// <!-- AJAX CRUD operations -->

// add a new testimonial
$(document).on('click', '.add-testimonial-Modal', function() {
    $('.modal-title').text('Add');
    $('#add-testimonial-Modal').modal('show');
});

$('.testimonial-modal-footer').on('click', '.add', function() {
    // alert($('#testimonial_name').val());
    $.ajax({
        type: 'post',
        url: 'testimonials',
        processData: false,
        contentType: false,
        enctype: 'multipart/form-data',
        data: new FormData($('#testimonial-form')[0]),
  
        success: function(data) {
            // $('.errorTitle').addClass('hidden');
            // $('.errorContent').addClass('hidden');

            if ((data.errors)) {
                setTimeout(function () {
                    $('#add-testimonial-Modal').modal('show');
                    toastr.error('Validation error!', 'Error Alert', {timeOut: 5000});
                }, 500);

                if (data.errors.testimonial_name) {
                    $('.errorName').removeClass('hidden');
                    $('.errorName').text(data.errors.testimonial_name);
                }
                if (data.errors.testimonial_conent) {
                    $('.errorContent').removeClass('hidden');
                    $('.errorContent').text(data.errors.testimonial_conent);
                }
                if (data.errors.testimonial_post) {
                    $('.errorPost').removeClass('hidden');
                    $('.errorPost').text(data.errors.testimonial_post);
                }
                if (data.errors.testimonial_image) {
                    $('.errorImage').removeClass('hidden');
                    $('.errorImage').text(data.errors.testimonial_image);
                }
            } else {
                toastr.success('Successfully added testimonial!', 'Success Alert', {timeOut: 5000});
                $('#testimonialTable').append("<tr class='item" + data.id + "'><td>" + data.id + "</td><td>" + data.testimonial_name + "</td><td>" + data.testimonial_post +"</td><td>" + data.testimonial_conent + "</td><td><img width=100 height=100 src="+"assets/testimonial/"+data.testimonial_image+" /></td><td class='text-center'><input type='checkbox' class='is_active_testimonial' data-id='" + data.id + " '></td><td>Right now</td><td><button class='testimonial-show-modal btn btn-success' data-id='" + data.id + "' data-testimonial_name='" + data.testimonial_name + "' data-testimonial_post='" + data.testimonial_post + "' data-testimonial_content='" + data.testimonial_content + "' data-testimonial_image='" + data.testimonial_image + "' ><span class='glyphicon glyphicon-eye-open'></span> </button> <button class='testimonial-edit-modal btn btn-info' data-id='" + data.id + "' data-testimonial_name='" + data.testimonial_name + "' data-testimonial_post='" + data.testimonial_post+ "' data-testimonial_content='" + data.testimonial_content+ "' data-testimonial_image='" + data.testimonial_image + "'><span class='glyphicon glyphicon-edit'></span> </button> <button class='testimonial-delete-modal btn btn-danger' data-id='" + data.id + "' data-testimonial_name='" + data.testimonial_name + "' data-testimonial_post='" + data.testimonial_post+ "' data-testimonial_content='" + data.testimonial_content+ "' data-testimonial_image='" + data.testimonial_image + "'><span class='glyphicon glyphicon-trash'></span> </button></td></tr>");
                // $('.is_active_testimonial').iCheck({
                //     checkboxclass: 'icheckbox_square-yellow',
                //     radioclass: 'iradio_square-yellow',
                //     increaseArea: '20%'
                // });
                $('.is_active_testimonial').on('ifToggled', function(event){
                    $(this).closest('tr').toggleClass('warning');
                });
                $('.is_active_testimonial').on('ifChanged', function(event){
                    id = $(this).data('id');
                    $.ajax({
                        type: 'post',
                        url: "{{ URL::route('change_testimonial_status') }}",
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
$(document).on('click','.testimonial-show-modal',function(){
    $('.modal-title').text('testimonial Data');
    $('#id_show').val($(this).data('id'));
    $('#testimonial_name_show').val($(this).data('testimonial_name'));
    $('#testimonial_post_show').val($(this).data('testimonial_post'));
    $('#testimonial_content_show').val($(this).data('testimonial_content'));
    $('#testimonial-show-modal img').attr('src',"/assets/testimonial/"+$(this).data('testimonial_image'));
    $('#testimonial-show-modal').modal('show');
});



// Edit a class
$(document).on('click','.testimonial-edit-modal',function(){
    $('.modal-title').text('Edit testimonial Data');
    $('#id_edit').val($(this).data('id'));
    $('#testimonial_name_edit').val($(this).data('testimonial_name'));
    $('#testimonial_post_edit').val($(this).data('testimonial_post'));
    $('#testimonial_content_edit').val($(this).data('testimonial_content'));
    id = $('#id_edit').val();
    $('#testimonial-edit-modal img').attr('src',"/assets/testimonial/"+$(this).data('testimonial_image'));
    $('#testimonial-edit-modal').modal('show');
});

$('.testimonial-edit-modal-footer').on('click','.edit',function(){
    console.log( $("#id_edit").val());
    $.ajax({
        type:'post',
        url:'testimonial_edit',
        processData: false,
        contentType: false,
        enctype: 'multipart/form-data',
        data: new FormData($('#testimonial-edit-form')[0]),
        success:function(data){
            $('.errorName').addClass('hidden');
            // $('.errorContent').addClass('hidden');
            if((data.errors)){
                setTimeout(function(){
                    $('#testimonial-edit-modal').modal('show');
                    toastr.error('Validation Error','Error Alert',{timeOut:5000});
                },500);
                if((data.errors.name)){
                    $('.errorName').removeClass('hidden');
                    $('.errorName').text(data.errors.name);
                }
            }
            else{
                toastr.success('Successfully updated testimonial data!','Success Alert',{timeOut:5000});
                $('.item'+data.id).replaceWith("<tr class='item"+data.id+"'><td>"+data.id+"</td><td>"+data.testimonial_name+"</td><td>"+data.testimonial_post+"</td><td>"+data.testimonial_content+"</td><td><img width=100 height=100 src="+"assets/testimonial/"+data.testimonial_image+" /></td><td class='text-center'><input type='checkbox' class='is_active_testimonial' data-id='" + data.id + "'></td><td>Right now</td><td><button class='testimonial-show-modal btn btn-success' data-id='" + data.id + "' data-testimonial_name='" + data.testimonial_name + "' data-testimonial_post='" + data.testimonial_post+ "' data-testimonial_content='"+ data.testimonial_content + "' data-testimonial_image='" + data.testimonial_image + "' ><span class='glyphicon glyphicon-eye-open'></span> </button> <button class='testimonial-edit-modal btn btn-info' data-id='" + data.id + "'  data-testimonial_name='" + data.testimonial_name + "' data-testimonial_post='" + data.testimonial_post+ "' data-testimonial_content='" + data.testimonial_content + "' data-testimonial_image='" + data.testimonial_image + "'><span class='glyphicon glyphicon-edit'></span> </button> <button class='testimonial-delete-modal btn btn-danger' data-id='" + data.id + "'  data-testimonial_name='" + data.testimonial_name + "' data-testimonial_post='" + data.testimonial_post+ "' data-testimonial_content='" + data.testimonial_content + "' data-testimonial_image='" + data.testimonial_image + "' ><span class='glyphicon glyphicon-trash'></span> </button></td></tr>");
                // $('.is_active_testimonial').iCheck({
                //     checkboxclass: 'icheckbox_square-yellow',
                //     radioclass: 'iradio_square-yellow',
                //     increaseArea: '20%'
                // });
                $('.is_active_testimonial').on('ifToggled', function(event){
                    $(this).closest('tr').toggleClass('warning');
                });
                $('.is_active_testimonial').on('ifChanged', function(event){
                    id = $(this).data('id');
                    $.ajax({
                        type: 'post',
                        url: "{{ URL::route('change_testimonial_status') }}",
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
// delete a testimonial
$(document).on('click','.testimonial-delete-modal',function(){
$('.modal-title').text('Delete testimonial');
$('#id_delete').val($(this).data('id'));
$('#testimonial_name_delete').val($(this).data('testimonial_name'));
$('#testimonial-delete-modal').modal('show');
id = $('#id_delete').val();
});
$('.testimonial-delete-modal-footer').on('click', '.delete', function() {
    $.ajax({
        type: 'DELETE',
        url: 'testimonials/' + id,
        data: {
            '_token': $('input[name=_token]').val(),
        },
        success: function(data) {
            toastr.success('Successfully deleted testimonial!', 'Success Alert', {timeOut: 5000});
            $('.item' + data['id']).remove();
        }
    });
});
