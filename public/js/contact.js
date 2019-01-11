$(window).load(function(){
            $('#contactTable').removeAttr('style');
        })
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
    // <!-- AJAX CRUD operations -->
   
        // add a new contact
        $(document).on('click', '.add-contact-Modal', function() {
            $('.modal-title').text('Add');
            $('#add-contact-Modal').modal('show');
        });

        $('.contact-modal-footer').on('click', '.add', function() {
            // alert($('#contact_name').val());
            $.ajax({
                type: 'post',
                url: 'contacts',
                processData: false,
                contentType: false,
                enctype: 'multipart/form-data',
                data: new FormData($('#contact-form')[0]),
          
                success: function(data) {
                    // $('.errorTitle').addClass('hidden');
                    // $('.errorContent').addClass('hidden');

                    if ((data.errors)) {
                        setTimeout(function () {
                            $('#add-contact-Modal').modal('show');
                            toastr.error('Validation error!', 'Error Alert', {timeOut: 5000});
                        }, 500);

                        if (data.errors.contact_name) {
                            $('.errorName').removeClass('hidden');
                            $('.errorName').text(data.errors.contact_name);
                        }
                        if (data.errors.contact_address) {
                            $('.errorAddress').removeClass('hidden');
                            $('.errorAddress').text(data.errors.contact_address);
                        }
                        if (data.errors.contact_phone) {
                            $('.errorPhone').removeClass('hidden');
                            $('.errorPhone').text(data.errors.contact_phone);
                        }
                        if (data.errors.contact_email) {
                            $('.errorEmail').removeClass('hidden');
                            $('.errorEmail').text(data.errors.contact_email);
                        }
                        if (data.errors.contact_facebook) {
                            $('.errorFacebook').removeClass('hidden');
                            $('.errorFacebook').text(data.errors.contact_facebook);
                        }
                        if (data.errors.contact_twitter) {
                            $('.errorTwitter').removeClass('hidden');
                            $('.errorTwitter').text(data.errors.contact_twitter);
                        }
                    } else {
                        toastr.success('Successfully added contact!', 'Success Alert', {timeOut: 5000});
                        $('#contactTable').append("<tr class='item" + data.id + "'><td>" + data.id + "</td><td>" + data.contact_name + "</td><td>"+ data.contact_phone + "</td><td>"+ data.contact_email+ "</td><td>"+ data.contact_facebook + "</td><td>" + data.contact_twitter + "</td><td class='text-center'><input type='checkbox' class='is_active_contact' data-id='" + data.id + " '></td><td>Right now</td><td><button class='contact-show-modal btn btn-success' data-id='" + data.id + "' data-contact_name='" + data.contact_name + "' data-contact_phone='" + data.contact_phone + "' data-contact_email='" + data.contact_email + "' data-contact_facebook='" + data.contact_facebook + "' data-contact_twitter='" + data.contact_twitter + "'><span class='glyphicon glyphicon-eye-open'></span> </button> <button class='contact-edit-modal btn btn-info' data-id='" + data.id + "' data-contact_name='" + data.contact_name + "' data-contact_phone='" + data.contact_phone + "' data-contact_twitter='" + data.contact_twitter + "' data-contact_email='" + data.contact_email + "' data-contact_facebook='" + data.contact_facebook + "'><span class='glyphicon glyphicon-edit'></span> </button> <button class='contact-delete-modal btn btn-danger' data-id='" + data.id + "' data-contact_name='" + data.contact_name + "' data-contact_phone='" + data.contact_phone + "' data-contact_email='" + data.contact_email + "' data-contact_facebook='" + data.contact_facebook + "' data-contact_twitter='" + data.contact_twitter + "'><span class='glyphicon glyphicon-trash'></span> </button></td></tr>");
                        // $('.is_active_contact').iCheck({
                        //     checkboxclass: 'icheckbox_square-yellow',
                        //     radioclass: 'iradio_square-yellow',
                        //     increaseArea: '20%'
                        // });
                        $('.is_active_contact').on('ifToggled', function(event){
                            $(this).closest('tr').toggleClass('warning');
                        });
                        $('.is_active_contact').on('ifChanged', function(event){
                            id = $(this).data('id');
                            $.ajax({
                                type: 'post',
                                url: "{{ URL::route('change_contact_status') }}",
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
        $(document).on('click','.contact-show-modal',function(){
            $('.modal-title').text('contact Data');
            $('#id_show').val($(this).data('id'));
            $('#contact_name_show').val($(this).data('contact_name'));
            $('#contact_phone_show').val($(this).data('contact_phone'));
            $('#contact_email_show').val($(this).data('contact_email'));
            $('#contact_facebook_show').val($(this).data('contact_facebook'));
            $('#contact_twitter_show').val($(this).data('contact_twitter'));
            
            // $('#contact-show-modal img').attr('src',"/assets/contact/"+$(this).data('contact_image'));
            $('#contact-show-modal').modal('show');
        });
      


        // Edit a class
        $(document).on('click','.contact-edit-modal',function(){
            $('.modal-title').text('Edit contact Data');
            $('#id_edit').val($(this).data('id'));
            $('#contact_name_edit').val($(this).data('contact_name'));
            $('#contact_phone_edit').val($(this).data('contact_phone'));

            $('#contact_email_edit').val($(this).data('contact_email'));
            $('#contact_facebook_edit').val($(this).data('contact_facebook'));

            $('#contact_twitter_edit').val($(this).data('contact_twitter'));

            id = $('#id_edit').val();
            // $('#contact-edit-modal img').attr('src',"/assets/contact/"+$(this).data('contact_image'));
            $('#contact-edit-modal').modal('show');
        });

        $('.contact-edit-modal-footer').on('click','.edit',function(){
            console.log( $("#id_edit").val());
            $.ajax({
                type:'post',
                url:'contact_edit',
                processData: false,
                contentType: false,
                enctype: 'multipart/form-data',
                data: new FormData($('#contact-edit-form')[0]),
                success:function(data){
                    $('.errorName').addClass('hidden');
                    // $('.errorContent').addClass('hidden');
                    if((data.errors)){
                        setTimeout(function(){
                            $('#contact-edit-modal').modal('show');
                            toastr.error('Validation Error','Error Alert',{timeOut:5000});
                        },500);
                        if((data.errors.name)){
                            $('.errorName').removeClass('hidden');
                            $('.errorName').text(data.errors.name);
                        }
                    }
                    else{
                        toastr.success('Successfully updated contact data!','Success Alert',{timeOut:5000});
                        $('.item'+data.id).replaceWith("<tr class='item"+data.id+"'><td>"+data.id+"</td><td>"+data.contact_name+"</td><td>"+data.contact_phone+"</td><td>"+data.contact_email+"</td><td>"+data.contact_facebook+"</td><td>"+data.contact_twitter+"</td><td class='text-center'><input type='checkbox' class='is_active_contact' data-id='" + data.id + "'></td><td>Right now</td><td><button class='contact-show-modal btn btn-success' data-id='" + data.id + "' data-contact_name='" + data.contact_name + "' data-contact_phone='" + data.contact_phone + "' data-contact_email='" + data.contact_email + "' data-contact_facebook='" + data.contact_facebook + "' data-contact_twitter='" + data.contact_twitter + "' ><span class='glyphicon glyphicon-eye-open'></span> </button> <button class='contact-edit-modal btn btn-info' data-id='" + data.id + "'  data-contact_name='" + data.contact_name + "' data-contact_email='" + data.contact_email + "' data-contact_facebook='" + data.contact_facebook + "' data-contact_phone='" + data.contact_phone + "' data-contact_twitter='" + data.contact_twitter + "' ><span class='glyphicon glyphicon-edit'></span> </button> <button class='contact-delete-modal btn btn-danger' data-id='" + data.id + "'  data-contact_name='" + data.contact_name + "' data-contact_phone='" + data.contact_phone + "' ><span class='glyphicon glyphicon-trash'></span> </button></td></tr>");
                        // $('.is_active_contact').iCheck({
                        //     checkboxclass: 'icheckbox_square-yellow',
                        //     radioclass: 'iradio_square-yellow',
                        //     increaseArea: '20%'
                        // });
                        $('.is_active_contact').on('ifToggled', function(event){
                            $(this).closest('tr').toggleClass('warning');
                        });
                        $('.is_active_contact').on('ifChanged', function(event){
                            id = $(this).data('id');
                            $.ajax({
                                type: 'post',
                                url: "{{ URL::route('change_contact_status') }}",
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
// delete a contact
    $(document).on('click','.contact-delete-modal',function(){
        $('.modal-title').text('Delete contact');
        $('#id_delete').val($(this).data('id'));
        $('#contact_name_delete').val($(this).data('contact_name'));
        $('#contact-delete-modal').modal('show');
        id = $('#id_delete').val();
    });
    $('.contact-delete-modal-footer').on('click', '.delete', function() {
            $.ajax({
                type: 'DELETE',
                url: 'contacts/' + id,
                data: {
                    '_token': $('input[name=_token]').val(),
                },
                success: function(data) {
                    toastr.success('Successfully deleted contact!', 'Success Alert', {timeOut: 5000});
                    $('.item' + data['id']).remove();
                }
            });
    });
    