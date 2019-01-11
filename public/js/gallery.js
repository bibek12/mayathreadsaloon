$(window).load(function(){
            $('#galleryTable').removeAttr('style');
        })
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
    // <!-- AJAX CRUD operations -->
   
        // add a new gallery
        $(document).on('click', '.add-gallery-Modal', function() {
            $('.modal-title').text('Add');
            $('#add-gallery-Modal').modal('show');
        });

        $('.gallery-modal-footer').on('click', '.add', function() {
            // alert($('#gallery_name').val());
            $.ajax({
                type: 'post',
                url: 'galleries',
                processData: false,
                contentType: false,
                enctype: 'multipart/form-data',
                data: new FormData($('#gallery-form')[0]),
          
                success: function(data) {
                    // $('.errorTitle').addClass('hidden');
                    // $('.errorContent').addClass('hidden');

                    if ((data.errors)) {
                        setTimeout(function () {
                            $('#add-gallery-Modal').modal('show');
                            toastr.error('Validation error!', 'Error Alert', {timeOut: 5000});
                        }, 500);

                        if (data.errors.gallery_title) {
                            $('.errorTitle').removeClass('hidden');
                            $('.errorTitle').text(data.errors.gallery_title);
                        }
                        if (data.errors.gallery_name) {
                            $('.errorName').removeClass('hidden');
                            $('.errorName').text(data.errors.gallery_name);
                        }
                        if (data.errors.gallery_image) {
                            $('.errorImage').removeClass('hidden');
                            $('.errorImage').text(data.errors.gallery_image);
                        }
                    } else {
                        toastr.success('Successfully added gallery!', 'Success Alert', {timeOut: 5000});
                        $('#galleryTable').append("<tr class='item" + data.id + "'><td>" + data.id + "</td><td>" + data.gallery_name + "</td><td>" + data.gallery_title + "</td><td><img width=100 height=100 src="+"assets/gallery/"+data.gallery_image+" /></td><td class='text-center'><input type='checkbox' class='is_active_gallery' data-id='" + data.id + " '></td><td>Right now</td><td><button class='gallery-show-modal btn btn-success' data-id='" + data.id + "' data-gallery_name='" + data.gallery_name + "' data-gallery_title='" + data.gallery_title + "'><span class='glyphicon glyphicon-eye-open'></span> </button> <button class='gallery-edit-modal btn btn-info' data-id='" + data.id + "' data-gallery_name='" + data.gallery_name + "' data-gallery_title='" + data.gallery_title + "'><span class='glyphicon glyphicon-edit'></span> </button> <button class='gallery-delete-modal btn btn-danger' data-id='" + data.id + "' data-gallery_name='" + data.gallery_name + "' data-gallery_title='" + data.gallery_title + "'><span class='glyphicon glyphicon-trash'></span> </button></td></tr>");
                        // $('.is_active_gallery').iCheck({
                        //     checkboxclass: 'icheckbox_square-yellow',
                        //     radioclass: 'iradio_square-yellow',
                        //     increaseArea: '20%'
                        // });
                        $('.is_active_gallery').on('ifToggled', function(event){
                            $(this).closest('tr').toggleClass('warning');
                        });
                        $('.is_active_gallery').on('ifChanged', function(event){
                            id = $(this).data('id');
                            $.ajax({
                                type: 'post',
                                url: "{{ URL::route('change_gallery_status') }}",
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
        $(document).on('click','.gallery-show-modal',function(){
            $('.modal-title').text('gallery Data');
            $('#id_show').val($(this).data('id'));
            $('#gallery_name_show').val($(this).data('gallery_name'));
            $('#gallery_title_show').val($(this).data('gallery_title'));
            
            $('#gallery-show-modal img').attr('src',"/assets/gallery/"+$(this).data('gallery_image'));
            $('#gallery-show-modal').modal('show');
        });
      


        // Edit a class
        $(document).on('click','.gallery-edit-modal',function(){
            $('.modal-title').text('Edit gallery Data');
            $('#id_edit').val($(this).data('id'));
            $('#gallery_name_edit').val($(this).data('gallery_name'));
            $('#gallery_post_title').val($(this).data('gallery_title'));
            id = $('#id_edit').val();
            $('#gallery-edit-modal img').attr('src',"/assets/gallery/"+$(this).data('gallery_image'));
            $('#gallery-edit-modal').modal('show');
        });

        $('.gallery-edit-modal-footer').on('click','.edit',function(){
            console.log( $("#id_edit").val());
            $.ajax({
                type:'post',
                url:'gallery_edit',
                processData: false,
                contentType: false,
                enctype: 'multipart/form-data',
                data: new FormData($('#gallery-edit-form')[0]),
                success:function(data){
                    $('.errorName').addClass('hidden');
                    // $('.errorContent').addClass('hidden');
                    if((data.errors)){
                        setTimeout(function(){
                            $('#gallery-edit-modal').modal('show');
                            toastr.error('Validation Error','Error Alert',{timeOut:5000});
                        },500);
                        if((data.errors.name)){
                            $('.errorName').removeClass('hidden');
                            $('.errorName').text(data.errors.name);
                        }
                    }
                    else{
                        toastr.success('Successfully updated gallery data!','Success Alert',{timeOut:5000});
                        $('.item'+data.id).replaceWith("<tr class='item"+data.id+"'><td>"+data.id+"</td><td>"+data.gallery_name+"</td><td>"+data.gallery_title+"</td><td><img width=100 height=100 src="+"assets/gallery/"+data.gallery_image+" /></td><td class='text-center'><input type='checkbox' class='is_active_gallery' data-id='" + data.id + "'></td><td>Right now</td><td><button class='gallery-show-modal btn btn-success' data-id='" + data.id + "' data-gallery_name='" + data.gallery_name + "' data-gallery_title='" + data.gallery_title + "' ><span class='glyphicon glyphicon-eye-open'></span> </button> <button class='gallery-edit-modal btn btn-info' data-id='" + data.id + "'  data-gallery_name='" + data.gallery_name + "' data-gallery_title='" + data.gallery_title + "' ><span class='glyphicon glyphicon-edit'></span> </button> <button class='gallery-delete-modal btn btn-danger' data-id='" + data.id + "'  data-gallery_name='" + data.gallery_name + "' data-gallery_title='" + data.gallery_title + "' ><span class='glyphicon glyphicon-trash'></span> </button></td></tr>");
                        // $('.is_active_gallery').iCheck({
                        //     checkboxclass: 'icheckbox_square-yellow',
                        //     radioclass: 'iradio_square-yellow',
                        //     increaseArea: '20%'
                        // });
                        $('.is_active_gallery').on('ifToggled', function(event){
                            $(this).closest('tr').toggleClass('warning');
                        });
                        $('.is_active_gallery').on('ifChanged', function(event){
                            id = $(this).data('id');
                            $.ajax({
                                type: 'post',
                                url: "{{ URL::route('change_gallery_status') }}",
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
// delete a gallery
    $(document).on('click','.gallery-delete-modal',function(){
        $('.modal-title').text('Delete gallery');
        $('#id_delete').val($(this).data('id'));
        $('#gallery_name_delete').val($(this).data('gallery_name'));
        $('#gallery-delete-modal').modal('show');
        id = $('#id_delete').val();
    });
    $('.gallery-delete-modal-footer').on('click', '.delete', function() {
            $.ajax({
                type: 'DELETE',
                url: 'galleries/' + id,
                data: {
                    '_token': $('input[name=_token]').val(),
                },
                success: function(data) {
                    toastr.success('Successfully deleted gallery!', 'Success Alert', {timeOut: 5000});
                    $('.item' + data['id']).remove();
                }
            });
    });
    