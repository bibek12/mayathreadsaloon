
        $(window).load(function(){
            $('#schoolTable').removeAttr('style');
        })
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
    // <!-- AJAX CRUD operations -->
   
        // add a new class
        $(document).on('click', '.add-school-Modal', function() {
            $('.modal-title').text('Add');
            $('#add-school-Modal').modal('show');
        });
        $('.school-modal-footer').on('click', '.add', function() {
            $.ajax({
                type: 'post',
                url: 'schools',
                // data: {
                //     '_token': $('input[name=_token]').val(),
                //     'name': $('#name').val(),
                //     'email': $('#email').val(),
                //     'phone1': $('#phone1').val(),
                //     'phone2': $('#phone2').val(),
                //     'address': $('#address').val(),
                //     'logo_name':$('#logo_name')[0].files[0]
                // },
                processData: false,
                contentType: false,
                enctype: 'multipart/form-data',
                data: new FormData($('#school-form')[0]),
               

                success: function(data) {
                    $('.errorTitle').addClass('hidden');
                    $('.errorContent').addClass('hidden');

                    if ((data.errors)) {
                        setTimeout(function () {
                            $('#add-school-Modal').modal('show');
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
                    } else {
                        toastr.success('Successfully added school!', 'Success Alert', {timeOut: 5000});
                        $('#schoolTable').append("<tr class='item" + data.id + "'><td>" + data.id + "</td><td>" + data.name + "</td><td>" + data.email + "</td><td>" + data.address + "</td><td>" + data.phone1 + "</td><td>" + data.phone2 + "</td><td class='text-center'><input type='checkbox' class='is_active_school' data-id='" + data.id + " '></td><td>Right now</td><td><button class='school-show-modal btn btn-success' data-id='" + data.id + "' data-class_name='" + data.class_name + "' data-class_id='" + data.class_id + "'><span class='glyphicon glyphicon-eye-open'></span> </button> <button class='school-edit-modal btn btn-info' data-id='" + data.id + "' data-class_name='" + data.class_name + "' data-class_id='" + data.class_id + "'><span class='glyphicon glyphicon-edit'></span> </button> <button class='school-delete-modal btn btn-danger' data-id='" + data.id + "' data-class_id='" + data.class_id + "' data-class_name='" + data.class_name + "'><span class='glyphicon glyphicon-trash'></span> </button></td></tr>");
                        $('.is_active_school').iCheck({
                            checkboxclass: 'icheckbox_square-yellow',
                            radioclass: 'iradio_square-yellow',
                            increaseArea: '20%'
                        });
                        $('.is_active_school').on('ifToggled', function(event){
                            $(this).closest('tr').toggleClass('warning');
                        });
                        $('.is_active_school').on('ifChanged', function(event){
                            id = $(this).data('id');
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
        $(document).on('click','.school-show-modal',function(){
            $('.modal-title').text('School Data');
            $('#id_show').val($(this).data('id'));
            $('#name_show').val($(this).data('name'));
            $('#email_show').val($(this).data('email'));
            $('#address_show').val($(this).data('address'));
            $('#phone1_show').val($(this).data('phone1'));
            $('#phone2_show').val($(this).data('phone2'));
            $('#school-show-modal img').attr('src',"/assets/school/"+$(this).data('logo_name'));
            $('#school-show-modal').modal('show');
        });
      


        // Edit a class
        $(document).on('click','.school-edit-modal',function(){
            $('.modal-title').text('Edit School Data');
            $('#id_edit').val($(this).data('id'));
            $('#name_edit').val($(this).data('name'));
            $('#email_edit').val($(this).data('email'));
            $('#address_edit').val($(this).data('address'));
            $('#phone1_edit').val($(this).data('phone1'));
            $('#phone2_edit').val($(this).data('phone2'));
            id = $('#id_edit').val();
            $('#school-edit-modal img').attr('src',"/assets/school/"+$(this).data('logo_name'));
            $('#school-edit-modal').modal('show');
        });

        $('.school-edit-modal-footer').on('click','.edit',function(){
            console.log( $("#id_edit").val());
            $.ajax({
                type:'put',
                url:'schools/' + id,
                // processData: false,
                // contentType: false,
                // enctype: 'multipart/form-data',
                // data:new FormData($('#school-edit-form')[0]),
                data:{
                    '_token': $('input[name=_token]').val(),
                    'name': $('#name_edit').val(),
                    'email': $('#email_edit').val(),
                    'phone1': $('#phone1_edit').val(),
                    'phone2': $('#phone2_edit').val(),
                    'address': $('#address_edit').val()
                    // 'logo_name':$('#logo_name_edit')[0].files[0]
                },

                success:function(data){
                    $('.errorName').addClass('hidden');
                    // $('.errorContent').addClass('hidden');
                    if((data.errors)){
                        setTimeout(function(){
                            $('#school-edit-modal').modal('show');
                            toastr.error('Validation Error','Error Alert',{timeOut:5000});
                        },500);
                        if((data.errors.name)){
                            $('.errorName').removeClass('hidden');
                            $('.errorName').text(data.errors.name);
                        }
                    }
                    else{
                        toastr.success('Successfully updated school data!','Success Alert',{timeOut:5000});
                        $('.item'+data.id).replaceWith("<tr class='item"+data.id+"'><td>"+data.id+"</td><td>"+data.name+"</td><td>"+data.email+"</td><td>"+data.address+"</td><td>"+data.phone1+"</td><td>"+data.phone2+"</td><td class='text-center'><input type='checkbox' class='is_active_school' data-id='" + data.id + "'></td><td>Right now</td><td><button class='school-show-modal btn btn-success' data-id='" + data.id + "' data-name='" + data.name + "' data-email='" + data.email + "' data-phone1='" + data.phone1 + "' data-phone2='" + data.phone2 + "' data-address='" + data.address + "' ><span class='glyphicon glyphicon-eye-open'></span> </button> <button class='school-edit-modal btn btn-info' data-id='" + data.id + "'  data-name='" + data.name + "' data-email='" + data.email + "' data-phone1='" + data.phone1 + "' data-phone2='" + data.phone2 + "' data-address='" + data.address + "' ><span class='glyphicon glyphicon-edit'></span> </button> <button class='school-delete-modal btn btn-danger' data-id='" + data.id + "'  data-name='" + data.name + "' data-email='" + data.email + "' data-phone1='" + data.phone1 + "' data-phone2='" + data.phone2 + "' data-address='" + data.address + "' ><span class='glyphicon glyphicon-trash'></span> </button></td></tr>");
                        $('.is_active_school').iCheck({
                            checkboxclass: 'icheckbox_square-yellow',
                            radioclass: 'iradio_square-yellow',
                            increaseArea: '20%'
                        });
                        $('.is_active_school').on('ifToggled', function(event){
                            $(this).closest('tr').toggleClass('warning');
                        });
                        $('.is_active_school').on('ifChanged', function(event){
                            id = $(this).data('id');
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

                }
            })
        });


        // delete a class
        $(document).on('click', '.school-delete-modal', function() {
            $('.modal-title').text('Delete');
            $('#id_delete').val($(this).data('id'));
            $('#name_delete').val($(this).data('name'));
            $('#delete-school-modal').modal('show');
            id = $('#id_delete').val();
        });
        $('.school-modal-footer').on('click', '.delete', function() {
            $.ajax({
                type: 'DELETE',
                url: 'schools/' + id,
                data: {
                    '_token': $('input[name=_token]').val(),
                },
                success: function(data) {
                    toastr.success('Successfully deleted School!', 'Success Alert', {timeOut: 5000});
                    $('.item' + data['id']).remove();
                }
            });
        });
    