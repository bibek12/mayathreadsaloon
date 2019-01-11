$(window).load(function(){
            $('#aboutTable').removeAttr('style');
        })
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
    // <!-- AJAX CRUD operations -->
   
        // add a new about
        $(document).on('click', '.add-about-Modal', function() {
            $('.modal-title').text('Add');
            $('#add-about-Modal').modal('show');
        });

        $('.about-modal-footer').on('click', '.add', function() {
            // alert($('#about_name').val());
            $.ajax({
                type: 'post',
                url: 'abouts',
                processData: false,
                contentType: false,
                enctype: 'multipart/form-data',
                data: new FormData($('#about-form')[0]),
          
                success: function(data) {
                    // $('.errorTitle').addClass('hidden');
                    // $('.errorContent').addClass('hidden');

                    if ((data.errors)) {
                        setTimeout(function () {
                            $('#add-about-Modal').modal('show');
                            toastr.error('Validation error!', 'Error Alert', {timeOut: 5000});
                        }, 500);

                        if (data.errors.title) {
                            $('.errorTitle').removeClass('hidden');
                            $('.errorTitle').text(data.errors.title);
                        }
                        if (data.errors.content) {
                            $('.errorContent').removeClass('hidden');
                            $('.errorContent').text(data.errors.content);
                        }
                        if (data.errors.image) {
                            $('.errorImage').removeClass('hidden');
                            $('.errorImage').text(data.errors.image);
                        }
                    } else {
                        toastr.success('Successfully added about!', 'Success Alert', {timeOut: 5000});
                        $('#aboutTable').append("<tr class='item" + data.id + "'><td>" + data.id + "</td><td>" + data.title + "</td><td>" + data.content + "</td><td><img width=100 height=100 src="+"assets/about/"+data.image+" /></td><td class='text-center'><input type='checkbox' class='is_active_about' data-id='" + data.id + " '></td><td>Right now</td><td><button class='about-show-modal btn btn-success' data-id='" + data.id + "' data-title='" + data.title + "' data-content='" + data.content + "'><span class='glyphicon glyphicon-eye-open'></span> </button> <button class='about-edit-modal btn btn-info' data-id='" + data.id + "' data-title='" + data.title + "' data-content='" + data.content + "'><span class='glyphicon glyphicon-edit'></span> </button> <button class='about-delete-modal btn btn-danger' data-id='" + data.id + "' data-title='" + data.title + "' data-content='" + data.content + "'><span class='glyphicon glyphicon-trash'></span> </button></td></tr>");
                        $('.is_active_about').iCheck({
                            checkboxclass: 'icheckbox_square-yellow',
                            radioclass: 'iradio_square-yellow',
                            increaseArea: '20%'
                        });
                        $('.is_active_about').on('ifToggled', function(event){
                            $(this).closest('tr').toggleClass('warning');
                        });
                        $('.is_active_about').on('ifChanged', function(event){
                            id = $(this).data('id');
                            $.ajax({
                                type: 'post',
                                url: "{{ URL::route('change_about_status') }}",
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
        $(document).on('click','.about-show-modal',function(){
            $('.modal-title').text('about Data');
            $('#id_show').val($(this).data('id'));
            $('#title_show').val($(this).data('title'));
            $('#content_show').val($(this).data('content'));
            
            $('#about-show-modal img').attr('src',"public/assets/about/"+$(this).data('image'));
            $('#about-show-modal').modal('show');
        });
      


        // Edit a class
        $(document).on('click','.about-edit-modal',function(){
            $('.modal-title').text('Edit about Data');
            $('#id_edit').val($(this).data('id'));
            $('#title_edit').val($(this).data('title'));
            $('#content_edit').val($(this).data('content'));
            id = $('#id_edit').val();
            $('#about-edit-modal img').attr('src',"public/assets/about/"+$(this).data('image'));
            $('#about-edit-modal').modal('show');
        });

        $('.about-edit-modal-footer').on('click','.edit',function(){
            console.log( $("#id_edit").val());
            $.ajax({
                type:'post',
                url:'about_edit',
                processData: false,
                contentType: false,
                enctype: 'multipart/form-data',
                data: new FormData($('#about-edit-form')[0]),
                success:function(data){
                    alert(data.about_id);
                    $('.errorName').addClass('hidden');
                    // $('.errorContent').addClass('hidden');
                    if((data.errors)){
                        setTimeout(function(){
                            $('#about-edit-modal').modal('show');
                            toastr.error('Validation Error','Error Alert',{timeOut:5000});
                        },500);
                        if((data.errors.name)){
                            $('.errorName').removeClass('hidden');
                            $('.errorName').text(data.errors.name);
                        }
                    }
                    else{
                        toastr.success('Successfully updated about data!','Success Alert',{timeOut:5000});
                        $('.item'+data.id).replaceWith("<tr class='item"+data.id+"'><td>"+data.id+"</td><td>"+data.title+"</td><td>"+data.content+"</td><td><img width=100 height=100 src="+"assets/about/"+data.image+" /></td><td class='text-center'><input type='checkbox' class='is_active_about' data-id='" + data.id + "'></td><td>Right now</td><td><button class='about-show-modal btn btn-success' data-id='" + data.id + "' data-name='" + data.name + "' data-email='" + data.email + "' data-phone1='" + data.phone1 + "' data-phone2='" + data.phone2 + "' data-address='" + data.address + "' ><span class='glyphicon glyphicon-eye-open'></span> </button> <button class='about-edit-modal btn btn-info' data-id='" + data.id + "'  data-name='" + data.name + "' data-email='" + data.email + "' data-phone1='" + data.phone1 + "' data-phone2='" + data.phone2 + "' data-address='" + data.address + "' ><span class='glyphicon glyphicon-edit'></span> </button> <button class='about-delete-modal btn btn-danger' data-id='" + data.id + "'  data-name='" + data.name + "' data-email='" + data.email + "' data-phone1='" + data.phone1 + "' data-phone2='" + data.phone2 + "' data-address='" + data.address + "' ><span class='glyphicon glyphicon-trash'></span> </button></td></tr>");
                        $('.is_active_about').iCheck({
                            checkboxclass: 'icheckbox_square-yellow',
                            radioclass: 'iradio_square-yellow',
                            increaseArea: '20%'
                        });
                        $('.is_active_about').on('ifToggled', function(event){
                            $(this).closest('tr').toggleClass('warning');
                        });
                        $('.is_active_about').on('ifChanged', function(event){
                            id = $(this).data('id');
                            $.ajax({
                                type: 'post',
                                url: "{{ URL::route('change_about_status') }}",
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
// delete a about
    $(document).on('click','.about-delete-modal',function(){
        $('.modal-title').text('Delete about');
        $('#id_delete').val($(this).data('id'));
        $('#title_delete').val($(this).data('title'));
        $('#about-delete-modal').modal('show');
        id = $('#id_delete').val();
    });
    $('.about-delete-modal-footer').on('click', '.delete', function() {
            $.ajax({
                type: 'DELETE',
                url: 'abouts/' + id,
                data: {
                    '_token': $('input[name=_token]').val(),
                },
                success: function(data) {
                    toastr.success('Successfully deleted about!', 'Success Alert', {timeOut: 5000});
                    $('.item' + data['id']).remove();
                }
            });
    });
    