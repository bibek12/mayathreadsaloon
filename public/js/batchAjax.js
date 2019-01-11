
        $(window).load(function(){
            $('#batchTable').removeAttr('style');
        })

    // <!-- AJAX CRUD operations -->
   
        // add a new class
        $(document).on('click', '.add-batch-Modal', function() {
            $('.modal-title').text('Add Batch');
            $('#add-batch-Modal').modal('show');
        });
        $('.batch-modal-footer').on('click', '.add', function() {
            $.ajax({
                type: 'post',
                url: 'batches',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'batch_name': $('#batch_name').val(),
                    'class_id': $('#class_id').val(),
                    'school_id': $('#school_id').val()                    
                },
               
               

                success: function(data) {
                    $('.errorTitle').addClass('hidden');
                    $('.errorContent').addClass('hidden');

                    if ((data.errors)) {
                        setTimeout(function () {
                            $('#add-batch-Modal').modal('show');
                            toastr.error('Validation error!', 'Error Alert', {timeOut: 5000});
                        }, 500);

                        // if (data.errors.title) {
                        //     $('.errorTitle').removeClass('hidden');
                        //     $('.errorTitle').text(data.errors.title);
                        // }
                        // if (data.errors.content) {
                        //     $('.errorContent').removeClass('hidden');
                        //     $('.errorContent').text(data.errors.content);
                        // }
                    } else {
                        toastr.success('Successfully added batch!', 'Success Alert', {timeOut: 5000});
                        $('#batchTable').append("<tr class='item" + data.id + "'><td>" + data.id + "</td><td>" + data.batch_name + "</td><td>" + data.class_id + "</td><td>" + data.school_id +"</td><td class='text-center'><input type='checkbox' class='is_active_batch' data-id='" + data.id + " '></td><td>Right now</td><td><button class='batch-show-modal btn btn-success' data-id='" + data.id + "' data-batch_name='" + data.batch_name + "' data-class_id='" + data.class_id + "'><span class='glyphicon glyphicon-eye-open'></span> </button> <button class='batch-edit-modal btn btn-info' data-id='" + data.id + "' data-batch_name='" + data.batch_name + "' data-class_id='" + data.class_id + "'><span class='glyphicon glyphicon-edit'></span> </button> <button class='batch-delete-modal btn btn-danger' data-id='" + data.id + "' data-class_id='" + data.class_id + "' data-batch_name='" + data.batch_name + "'><span class='glyphicon glyphicon-trash'></span> </button></td></tr>");
                        $('.is_active_batch').iCheck({
                            checkboxclass: 'icheckbox_square-yellow',
                            radioclass: 'iradio_square-yellow',
                            increaseArea: '20%'
                        });
                        $('.is_active_batch').on('ifToggled', function(event){
                            $(this).closest('tr').toggleClass('warning');
                        });
                        $('.is_active_batch').on('ifChanged', function(event){
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
        $(document).on('click','.batch-show-modal',function(){
            $('.modal-title').text('batch Data');
            $('#id_show').val($(this).data('id'));
            $('#batch_name_show').val($(this).data('batch_name'));
            $('#class_id_show').val($(this).data('class_id'));
           
            $('#batch-show-modal').modal('show');
        });
      


        // Edit a class
        $(document).on('click','.batch-edit-modal',function(){
            $('.modal-title').text('Edit batch Data');
            $('#id_edit').val($(this).data('id'));
            $('#batch_name_edit').val($(this).data('batch_name'));
            $('#class_edit').val($(this).data('class_id'));
            
            id=$('#id_edit').val();
            $('#batch-edit-modal').modal('show');
        });

        $('.batch-edit-modal-footer').on('click','.edit',function(){
            // console.log( $("#id_edit").val());
            $.ajax({
                type:'PUT',
                url:'batches/' + id,
                data:{
                    '_token': $('input[name=_token]').val(),
                    'batch_name': $('#batch_name_edit').val(),
                    'class_id': $('#class_id_edit').val(),
                    'school_id': $('#school_id_edit').val()
                   
                },

                success:function(data){
                    // $('.errorName').addClass('hidden');
                    // $('.errorContent').addClass('hidden');
                    if((data.errors)){
                        setTimeout(function(){
                            $('#batch-edit-modal').modal('show');
                            toastr.error('Validation Error','Error Alert',{timeOut:5000});
                        },500);
                        // if((data.errors.name)){
                        //     $('.errorName').removeClass('hidden');
                        //     $('.errorName').text(data.errors.name);
                        // }
                    }
                    else{
                        toastr.success('Successfully updated batch data!','Success Alert',{timeOut:5000});
                        $('.item'+data.id).replaceWith("<tr class='item"+data.id+"'><td>"+data.id+"</td><td>"+data.batch_name+"</td><td>"+data.class_id+"</td><td>"+data.school_id+"</td><td class='text-center'><input type='checkbox' class='is_active_batch' data-id='" + data.id + "'></td><td>Right now</td><td><button class='batch-show-modal btn btn-success' data-id='" + data.id + "' data-batch_name='" + data.batch_name + "' data-class_id='" + data.class_id + "' data-school_id='" + data.school_id + "' ><span class='glyphicon glyphicon-eye-open'></span> </button> <button class='batch-edit-modal btn btn-info' data-id='" + data.id + "'  data-name='" + data.name + "' data-batch_name='" + data.batch_name + "' data-class_id='" + data.class_id + "' data-school_id='" + data.school_id + "' ><span class='glyphicon glyphicon-edit'></span> </button> <button class='batch-delete-modal btn btn-danger' data-id='" + data.id + "'  data-batch_name='" + data.batch_name + "' data-class_id='" + data.class_id + "' data-school_id='" + data.school_id +"' ><span class='glyphicon glyphicon-trash'></span> </button></td></tr>");
                        $('.is_active_batch').iCheck({
                            checkboxclass: 'icheckbox_square-yellow',
                            radioclass: 'iradio_square-yellow',
                            increaseArea: '20%'
                        });
                        $('.is_active_batch').on('ifToggled', function(event){
                            $(this).closest('tr').toggleClass('warning');
                        });
                        $('.is_active_batch').on('ifChanged', function(event){
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
        $(document).on('click', '.batch-delete-modal', function() {
            $('.modal-title').text('Delete');
            $('#id_delete').val($(this).data('id'));
            $('#batch_name_delete').val($(this).data('batch_name'));
            $('#delete-batch-modal').modal('show');
            id = $('#id_delete').val();
        });
        $('.batch-modal-footer').on('click', '.delete', function() {
            $.ajax({
                type: 'DELETE',
                url: 'batches/' + id,
                data: {
                    '_token': $('input[name=_token]').val(),
                },
                success: function(data) {
                    toastr.success('Successfully deleted batch!', 'Success Alert', {timeOut: 5000});
                    $('.item' + data['id']).remove();
                }
            });
        });
    