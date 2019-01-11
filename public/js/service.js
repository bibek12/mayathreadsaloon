$(window).load(function(){
            $('#serviceTable').removeAttr('style');
        })
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
    // <!-- AJAX CRUD operations -->
   
        // add a new service
        $(document).on('click', '.add-service-Modal', function() {
            $('.modal-title').text('Add');
            $('#add-service-Modal').modal('show');
        });

        $('.service-modal-footer').on('click', '.add', function() {
            // alert($('#service_name').val());
            $.ajax({
                type: 'post',
                url: 'services',
                processData: false,
                contentType: false,
                enctype: 'multipart/form-data',
                data: new FormData($('#service-form')[0]),
          
                success: function(data) {
                    // $('.errorTitle').addClass('hidden');
                    // $('.errorContent').addClass('hidden');

                    if ((data.errors)) {
                        setTimeout(function () {
                            $('#add-service-Modal').modal('show');
                            toastr.error('Validation error!', 'Error Alert', {timeOut: 5000});
                        }, 500);

                        if (data.errors.service_name) {
                            $('.errorName').removeClass('hidden');
                            $('.errorName').text(data.errors.service_name);
                        }
                        if (data.errors.service_content) {
                            $('.errorContent').removeClass('hidden');
                            $('.errorContent').text(data.errors.service_content);
                        }
                        if (data.errors.service_image) {
                            $('.errorImage').removeClass('hidden');
                            $('.errorImage').text(data.errors.service_image);
                        }
                    } else {
                        toastr.success('Successfully added service!', 'Success Alert', {timeOut: 5000});
                        $('#serviceTable').append("<tr class='item" + data.id + "'><td>" + data.id + "</td><td>" + data.service_name + "</td><td>" + data.service_content + "</td><td><img width=100 height=100 src="+"assets/service/"+data.service_image+" /></td><td class='text-center'><input type='checkbox' class='is_active_service' data-id='" + data.id + " '></td><td>Right now</td><td><button class='service-show-modal btn btn-success' data-id='" + data.id + "' data-service_name='" + data.service_name + "' data-service_content='" + data.service_content + "' data-service_image='" + data.service_image + "' ><span class='glyphicon glyphicon-eye-open'></span> </button> <button class='service-edit-modal btn btn-info' data-id='" + data.id + "' data-service_name='" + data.service_name + "' data-service_content='" + data.service_content+ "' data-service_image='" + data.service_image + "'><span class='glyphicon glyphicon-edit'></span> </button> <button class='service-delete-modal btn btn-danger' data-id='" + data.id + "' data-service_name='" + data.service_name + "' data-service_content='" + data.service_content+ "' data-service_image='" + data.service_image + "'><span class='glyphicon glyphicon-trash'></span> </button></td></tr>");
                        // $('.is_active_service').iCheck({
                        //     checkboxclass: 'icheckbox_square-yellow',
                        //     radioclass: 'iradio_square-yellow',
                        //     increaseArea: '20%'
                        // });
                        $('.is_active_service').on('ifToggled', function(event){
                            $(this).closest('tr').toggleClass('warning');
                        });
                        $('.is_active_service').on('ifChanged', function(event){
                            id = $(this).data('id');
                            $.ajax({
                                type: 'post',
                                url: "{{ URL::route('change_service_status') }}",
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
        $(document).on('click','.service-show-modal',function(){
            $('.modal-title').text('service Data');
            $('#id_show').val($(this).data('id'));
            $('#service_name_show').val($(this).data('service_name'));
            $('#service_content_show').val($(this).data('service_content'));
            
            $('#service-show-modal img').attr('src',"public/assets/service/"+$(this).data('service_image'));
            $('#service-show-modal').modal('show');
        });
      


        // Edit a class
        $(document).on('click','.service-edit-modal',function(){
            $('.modal-title').text('Edit service Data');
            $('#id_edit').val($(this).data('id'));
            $('#service_name_edit').val($(this).data('service_name'));
            $('#service_content_edit').val($(this).data('service_content'));
            id = $('#id_edit').val();
            $('#service-edit-modal img').attr('src',"public/assets/service/"+$(this).data('service_image'));
            $('#service-edit-modal').modal('show');
        });

        $('.service-edit-modal-footer').on('click','.edit',function(){
            console.log( $("#id_edit").val());
            $.ajax({
                type:'post',
                url:'service_edit',
                processData: false,
                contentType: false,
                enctype: 'multipart/form-data',
                data: new FormData($('#service-edit-form')[0]),
                success:function(data){
                    $('.errorName').addClass('hidden');
                    // $('.errorContent').addClass('hidden');
                    if((data.errors)){
                        setTimeout(function(){
                            $('#service-edit-modal').modal('show');
                            toastr.error('Validation Error','Error Alert',{timeOut:5000});
                        },500);
                        if((data.errors.name)){
                            $('.errorName').removeClass('hidden');
                            $('.errorName').text(data.errors.name);
                        }
                    }
                    else{
                        toastr.success('Successfully updated service data!','Success Alert',{timeOut:5000});
                        $('.item'+data.id).replaceWith("<tr class='item"+data.id+"'><td>"+data.id+"</td><td>"+data.service_name+"</td><td>"+data.service_content+"</td><td><img width=100 height=100 src="+"assets/service/"+data.service_image+" /></td><td class='text-center'><input type='checkbox' class='is_active_service' data-id='" + data.id + "'></td><td>Right now</td><td><button class='service-show-modal btn btn-success' data-id='" + data.id + "' data-service_name='" + data.service_name + "' data-service_content='" + data.service_content + "' data-service_image='" + data.service_image + "' ><span class='glyphicon glyphicon-eye-open'></span> </button> <button class='service-edit-modal btn btn-info' data-id='" + data.id + "'  data-service_name='" + data.service_name + "' data-service_content='" + data.service_content + "' data-service_image='" + data.service_image + "'><span class='glyphicon glyphicon-edit'></span> </button> <button class='service-delete-modal btn btn-danger' data-id='" + data.id + "'  data-service_name='" + data.service_name + "' data-service_content='" + data.service_content + "' data-service_image='" + data.service_image + "' ><span class='glyphicon glyphicon-trash'></span> </button></td></tr>");
                        // $('.is_active_service').iCheck({
                        //     checkboxclass: 'icheckbox_square-yellow',
                        //     radioclass: 'iradio_square-yellow',
                        //     increaseArea: '20%'
                        // });
                        $('.is_active_service').on('ifToggled', function(event){
                            $(this).closest('tr').toggleClass('warning');
                        });
                        $('.is_active_service').on('ifChanged', function(event){
                            id = $(this).data('id');
                            $.ajax({
                                type: 'post',
                                url: "{{ URL::route('change_service_status') }}",
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
// delete a service
    $(document).on('click','.service-delete-modal',function(){
        $('.modal-title').text('Delete service');
        $('#id_delete').val($(this).data('id'));
        $('#service_name_delete').val($(this).data('service_name'));
        $('#service-delete-modal').modal('show');
        id = $('#id_delete').val();
    });
    $('.service-delete-modal-footer').on('click', '.delete', function() {
            $.ajax({
                type: 'DELETE',
                url: 'services/' + id,
                data: {
                    '_token': $('input[name=_token]').val(),
                },
                success: function(data) {
                    toastr.success('Successfully deleted service!', 'Success Alert', {timeOut: 5000});
                    $('.item' + data['id']).remove();
                }
            });
    });
    