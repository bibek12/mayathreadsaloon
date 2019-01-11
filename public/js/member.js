$(window).load(function(){
            $('#memberTable').removeAttr('style');
        })
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
    // <!-- AJAX CRUD operations -->
   
        // add a new member
        $(document).on('click', '.add-member-Modal', function() {
            $('.modal-title').text('Add');
            $('#add-member-Modal').modal('show');
        });

        $('.member-modal-footer').on('click', '.add', function() {
            // alert($('#member_name').val());
            $.ajax({
                type: 'post',
                url: 'members',
                processData: false,
                contentType: false,
                enctype: 'multipart/form-data',
                data: new FormData($('#member-form')[0]),
          
                success: function(data) {
                    // $('.errorTitle').addClass('hidden');
                    // $('.errorContent').addClass('hidden');

                    if ((data.errors)) {
                        setTimeout(function () {
                            $('#add-member-Modal').modal('show');
                            toastr.error('Validation error!', 'Error Alert', {timeOut: 5000});
                        }, 500);

                        if (data.errors.member_name) {
                            $('.errorName').removeClass('hidden');
                            $('.errorName').text(data.errors.member_name);
                        }
                        if (data.errors.member_post) {
                            $('.errorPost').removeClass('hidden');
                            $('.errorPost').text(data.errors.member_post);
                        }
                        if (data.errors.member_image) {
                            $('.errorImage').removeClass('hidden');
                            $('.errorImage').text(data.errors.member_image);
                        }
                    } else {
                        toastr.success('Successfully added member!', 'Success Alert', {timeOut: 5000});
                        $('#memberTable').append("<tr class='item" + data.id + "'><td>" + data.id + "</td><td>" + data.member_name + "</td><td>" + data.member_post + "</td><td><img width=100 height=100 src="+"assets/member/"+data.member_image+" /></td><td class='text-center'><input type='checkbox' class='is_active_member' data-id='" + data.id + " '></td><td>Right now</td><td><button class='member-show-modal btn btn-success' data-id='" + data.id + "' data-member_name='" + data.member_name + "' data-member_post='" + data.member_post + "'><span class='glyphicon glyphicon-eye-open'></span> </button> <button class='member-edit-modal btn btn-info' data-id='" + data.id + "' data-member_name='" + data.member_name + "' data-member_post='" + data.member_post + "'><span class='glyphicon glyphicon-edit'></span> </button> <button class='member-delete-modal btn btn-danger' data-id='" + data.id + "' data-member_name='" + data.member_name + "' data-member_post='" + data.member_post + "'><span class='glyphicon glyphicon-trash'></span> </button></td></tr>");
                        // $('.is_active_member').iCheck({
                        //     checkboxclass: 'icheckbox_square-yellow',
                        //     radioclass: 'iradio_square-yellow',
                        //     increaseArea: '20%'
                        // });
                        $('.is_active_member').on('ifToggled', function(event){
                            $(this).closest('tr').toggleClass('warning');
                        });
                        $('.is_active_member').on('ifChanged', function(event){
                            id = $(this).data('id');
                            $.ajax({
                                type: 'post',
                                url: "{{ URL::route('change_member_status') }}",
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
        $(document).on('click','.member-show-modal',function(){
            $('.modal-title').text('member Data');
            $('#id_show').val($(this).data('id'));
            $('#member_name_show').val($(this).data('member_name'));
            $('#member_post_show').val($(this).data('member_post'));
            
            $('#member-show-modal img').attr('src',"/assets/member/"+$(this).data('member_image'));
            $('#member-show-modal').modal('show');
        });
      


        // Edit a class
        $(document).on('click','.member-edit-modal',function(){
            $('.modal-title').text('Edit member Data');
            $('#id_edit').val($(this).data('id'));
            $('#member_name_edit').val($(this).data('member_name'));
            $('#member_post_edit').val($(this).data('member_post'));
            id = $('#id_edit').val();
            $('#member-edit-modal img').attr('src',"/assets/member/"+$(this).data('member_image'));
            $('#member-edit-modal').modal('show');
        });

        $('.member-edit-modal-footer').on('click','.edit',function(){
            console.log( $("#id_edit").val());
            $.ajax({
                type:'post',
                url:'member_edit',
                processData: false,
                contentType: false,
                enctype: 'multipart/form-data',
                data: new FormData($('#member-edit-form')[0]),
                success:function(data){
                    alert(data.member_id);
                    $('.errorName').addClass('hidden');
                    // $('.errorContent').addClass('hidden');
                    if((data.errors)){
                        setTimeout(function(){
                            $('#member-edit-modal').modal('show');
                            toastr.error('Validation Error','Error Alert',{timeOut:5000});
                        },500);
                        if((data.errors.name)){
                            $('.errorName').removeClass('hidden');
                            $('.errorName').text(data.errors.name);
                        }
                    }
                    else{
                        toastr.success('Successfully updated member data!','Success Alert',{timeOut:5000});
                        $('.item'+data.id).replaceWith("<tr class='item"+data.id+"'><td>"+data.id+"</td><td>"+data.member_name+"</td><td>"+data.member_post+"</td><td><img width=100 height=100 src="+"assets/member/"+data.member_image+" /></td><td class='text-center'><input type='checkbox' class='is_active_member' data-id='" + data.id + "'></td><td>Right now</td><td><button class='member-show-modal btn btn-success' data-id='" + data.id + "' data-member_name='" + data.member_name + "' data-member_post='" + data.member_post + "' ><span class='glyphicon glyphicon-eye-open'></span> </button> <button class='member-edit-modal btn btn-info' data-id='" + data.id + "'  data-member_name='" + data.member_name + "' data-member_post='" + data.member_post + "' ><span class='glyphicon glyphicon-edit'></span> </button> <button class='member-delete-modal btn btn-danger' data-id='" + data.id + "'  data-member_name='" + data.member_name + "' data-member_post='" + data.member_post + "' ><span class='glyphicon glyphicon-trash'></span> </button></td></tr>");
                        // $('.is_active_member').iCheck({
                        //     checkboxclass: 'icheckbox_square-yellow',
                        //     radioclass: 'iradio_square-yellow',
                        //     increaseArea: '20%'
                        // });
                        $('.is_active_member').on('ifToggled', function(event){
                            $(this).closest('tr').toggleClass('warning');
                        });
                        $('.is_active_member').on('ifChanged', function(event){
                            id = $(this).data('id');
                            $.ajax({
                                type: 'post',
                                url: "{{ URL::route('change_member_status') }}",
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
// delete a member
    $(document).on('click','.member-delete-modal',function(){
        $('.modal-title').text('Delete member');
        $('#id_delete').val($(this).data('id'));
        $('#member_name_delete').val($(this).data('member_name'));
        $('#member-delete-modal').modal('show');
        id = $('#id_delete').val();
    });
    $('.member-delete-modal-footer').on('click', '.delete', function() {
            $.ajax({
                type: 'DELETE',
                url: 'members/' + id,
                data: {
                    '_token': $('input[name=_token]').val(),
                },
                success: function(data) {
                    toastr.success('Successfully deleted member!', 'Success Alert', {timeOut: 5000});
                    $('.item' + data['id']).remove();
                }
            });
    });
    