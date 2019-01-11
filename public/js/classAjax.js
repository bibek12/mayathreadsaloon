
        $(window).load(function(){
            $('#classTable').removeAttr('style');
        })

    // <!-- AJAX CRUD operations -->
   
        // add a new class
        $(document).on('click', '.add-class-Modal', function() {
            $('.modal-title').text('Add');
            $('#add-class-Modal').modal('show');
        });
        $('.class-modal-footer').on('click', '.add', function() {
            $.ajax({
                type: 'post',
                url: 'classes',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'class_name': $('#class_name').val(),
                    'school_id': $('#school_id').val()
                },
                success: function(data) {
                    $('.errorTitle').addClass('hidden');
                    $('.errorContent').addClass('hidden');

                    if ((data.errors)) {
                        setTimeout(function () {
                            $('#add-class-Modal').modal('show');
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
                        toastr.success('Successfully added Class!', 'Success Alert', {timeOut: 5000});
                        $('#classTable').append("<tr class='item" + data.id + "'><td>" + data.id + "</td><td>" + data.class_name + "</td><td>" + data.school_id + "</td><td class='text-center'><input type='checkbox' class='is_active' data-id='" + data.id + " '></td><td>Right now</td><td><button class='show-modal btn btn-success' data-id='" + data.id + "' data-class_name='" + data.class_name + "' data-school_id='" + data.school_id + "'><span class='glyphicon glyphicon-eye-open'></span> Show</button> <button class='edit-modal btn btn-info' data-id='" + data.id + "' data-class_name='" + data.class_name + "' data-school_id='" + data.school_id + "'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='class-delete-modal btn btn-danger' data-id='" + data.id + "' data-school_id='" + data.school_id + "' data-class_name='" + data.class_name + "'><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");
                       
                        $('.is_active').iCheck({
                            checkboxClass: 'icheckbox_square-yellow',
                            radioClass: 'iradio_square-yellow',
                            increaseArea: '20%'
                        });
                        $('.is_active').on('ifToggled', function(event){
                            $(this).closest('tr').toggleClass('warning');
                        });
                        $('.is_active').on('ifChanged', function(event){
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
        $(document).on('click', '.class-show-modal', function() {
            // console.log($(this).data('class_name'));
            $('.modal-title').text('Show');
            $('#id_show').val($(this).data('id'));
            $('#class_name_show').val($(this).data('class_name'));
            $('#school_id_show').val($(this).data('school_id'));
            $('#class-show-modal').modal('show');
        });


        // Edit a class
        $(document).on('click', '.class-edit-modal', function() {
            $('.modal-title').text('Edit');
            $('#id_edit').val($(this).data('id'));
            $('#class_name_edit').val($(this).data('class_name'));
            $('#school_id_edit').val($(this).data('school_id'));
            id = $('#id_edit').val();
            $('#class_edit_modal').modal('show');
        });
        $('.class-edit-modal-footer').on('click', '.edit', function() {
            $.ajax({
                type: 'PUT',
                url: 'classes/' + id,
                data: {
                    '_token': $('input[name=_token]').val(),
                    'id': $("#id_edit").val(),
                    'class_name': $('#class_name_edit').val(),
                    'school_id': $('#school_id_edit').val()
                },
                success: function(data) {
                    $('.errorTitle').addClass('hidden');
                    $('.errorContent').addClass('hidden');

                    if ((data.errors)) {
                        setTimeout(function () {
                            $('#class_edit_modal').modal('show');
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
                        toastr.success('Successfully updated class!', 'Success Alert', {timeOut: 5000});
                        $('.item' + data.id).replaceWith("<tr class='item" + data.id + "'><td>" + data.id + "</td><td>" + data.class_name + "</td><td>" + data.school_id + "</td><td class='text-center'><input type='checkbox' class='is_active' data-id='" + data.id + "'></td><td>Right now</td><td><button class='class-show-modal btn btn-success' data-id='" + data.id + "' data-class_name='" + data.class_name + "' data-school_id='" + data.school_id + "'><span class='glyphicon glyphicon-eye-open'></span> Show</button> <button class='class-edit-modal btn btn-info' data-id='" + data.id + "' data-class_name='" + data.class_name + "' data-school_id='" + data.school_id + "'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='class-delete-modal btn btn-danger' data-id='" + data.id + "' data-class_name='" + data.class_name + "' data-school_id='" + data.school_id + "'><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");

                        if (data.is_active) {
                            $('.is_active').prop('checked', true);
                            $('.is_active').closest('tr').addClass('warning');
                        }
                        $('.is_active').iCheck({
                            checkboxClass: 'icheckbox_square-yellow',
                            radioClass: 'iradio_square-yellow',
                            increaseArea: '20%'
                        });
                        $('.is_active').on('ifToggled', function(event) {
                            $(this).closest('tr').toggleClass('warning');
                        });
                        $('.is_active').on('ifChanged', function(event){
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
            });
        });

        // delete a class
        $(document).on('click', '.class-delete-modal', function() {
            $('.modal-title').text('Delete');
            $('#id_delete').val($(this).data('id'));
            $('#class_name_delete').val($(this).data('class_name'));
            $('#deleteClassModal').modal('show');
            id = $('#id_delete').val();
        });
        $('.class-modal-footer').on('click', '.delete', function() {
            $.ajax({
                type: 'DELETE',
                url: 'classes/' + id,
                data: {
                    '_token': $('input[name=_token]').val(),
                },
                success: function(data) {
                    toastr.success('Successfully deleted class!', 'Success Alert', {timeOut: 5000});
                    $('.item' + data['id']).remove();
                }
            });
        });
    