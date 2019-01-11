$(window).load(function(){
            $('#priceTable').removeAttr('style');
        })
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
    // <!-- AJAX CRUD operations -->
   
        // add a new price
        $(document).on('click', '.add-price-Modal', function() {
            $('.modal-title').text('Add');
            $('#add-price-Modal').modal('show');
        });

        $('.price-modal-footer').on('click', '.add', function() {
            // alert($('#price_name').val());
            $.ajax({
                type: 'post',
                url: 'prices',
                processData: false,
                contentType: false,
                enctype: 'multipart/form-data',
                data: new FormData($('#price-form')[0]),
          
                success: function(data) {
                    // $('.errorTitle').addClass('hidden');
                    // $('.errorContent').addClass('hidden');

                    if ((data.errors)) {
                        setTimeout(function () {
                            $('#add-price-Modal').modal('show');
                            toastr.error('Validation error!', 'Error Alert', {timeOut: 5000});
                        }, 500);

                        if (data.errors.title) {
                            $('.errorTitle').removeClass('hidden');
                            $('.errorTitle').text(data.errors.title);
                        }
                        // if (data.errors.content) {
                        //     $('.errorContent').removeClass('hidden');
                        //     $('.errorContent').text(data.errors.content);
                        // }
                    } else {
                        toastr.success('Successfully added price!', 'Success Alert', {timeOut: 5000});
                        $('#priceTable').append("<tr class='item" + data.id + "'><td>" + data.id + "</td><td>" + data.title + "</td><td>"+ data.cost +  "</td><td class='text-center'><input type='checkbox' class='is_active_price' data-id='" + data.id + " '></td><td>Right now</td><td><button class='price-show-modal btn btn-success' data-id='" + data.id + "' data-title='" + data.title + "' data-cost='" + data.cost + "'><span class='glyphicon glyphicon-eye-open'></span> </button> <button class='price-edit-modal btn btn-info' data-id='" + data.id + "' data-title='" + data.title + "' data-cost='" + data.cost + "' ><span class='glyphicon glyphicon-edit'></span> </button> <button class='price-delete-modal btn btn-danger' data-id='" + data.id + "' data-title='" + data.title + "' data-cost='" + data.cost + "'><span class='glyphicon glyphicon-trash'></span> </button></td></tr>");
                        // $('.is_active_price').iCheck({
                        //     checkboxclass: 'icheckbox_square-yellow',
                        //     radioclass: 'iradio_square-yellow',
                        //     increaseArea: '20%'
                        // });
                        $('.is_active_price').on('ifToggled', function(event){
                            $(this).closest('tr').toggleClass('warning');
                        });
                        $('.is_active_price').on('ifChanged', function(event){
                            id = $(this).data('id');
                            $.ajax({
                                type: 'post',
                                url: "{{ URL::route('change_price_status') }}",
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
        $(document).on('click','.price-show-modal',function(){
            $('.modal-title').text('price Data');
            $('#id_show').val($(this).data('id'));
            $('#title_show').val($(this).data('title'));
            $('#cost_show').val($(this).data('cost'));
            
            // $('#price-show-modal img').attr('src',"/assets/price/"+$(this).data('price_image'));
            $('#price-show-modal').modal('show');
        });
      


        // Edit a class
        $(document).on('click','.price-edit-modal',function(){
            $('.modal-title').text('Edit price Data');
            $('#id_edit').val($(this).data('id'));
            $('#title_edit').val($(this).data('title'));
            $('#cost_edit').val($(this).data('cost'));

            id = $('#id_edit').val();
            // $('#price-edit-modal img').attr('src',"/assets/price/"+$(this).data('price_image'));
            $('#price-edit-modal').modal('show');
        });

        $('.price-edit-modal-footer').on('click','.edit',function(){
            console.log( $("#id_edit").val());
            $.ajax({
                type:'post',
                url:'price_edit',
                processData: false,
                contentType: false,
                enctype: 'multipart/form-data',
                data: new FormData($('#price-edit-form')[0]),
                success:function(data){
                    $('.errorName').addClass('hidden');
                    // $('.errorContent').addClass('hidden');
                    if((data.errors)){
                        setTimeout(function(){
                            $('#price-edit-modal').modal('show');
                            toastr.error('Validation Error','Error Alert',{timeOut:5000});
                        },500);
                        if((data.errors.name)){
                            $('.errorName').removeClass('hidden');
                            $('.errorName').text(data.errors.name);
                        }
                    }
                    else{
                        toastr.success('Successfully updated price data!','Success Alert',{timeOut:5000});
                        $('.item'+data.id).replaceWith("<tr class='item"+data.id+"'><td>"+data.id+"</td><td>"+data.title+"</td><td>"+data.cost+"</td><td class='text-center'><input type='checkbox' class='is_active_price' data-id='" + data.id + "'></td><td>Right now</td><td><button class='price-show-modal btn btn-success' data-id='" + data.id + "' data-title='" + data.title + "' data-cost='" + data.cost +  "' ><span class='glyphicon glyphicon-eye-open'></span> </button> <button class='price-edit-modal btn btn-info' data-id='" + data.id + "'  data-title='" + data.title + "'   data-cost='" + data.cost + "'  ><span class='glyphicon glyphicon-edit'></span> </button> <button class='price-delete-modal btn btn-danger' data-id='" + data.id + "'  data-title='" + data.title + "' data-cost='" + data.cost + "' ><span class='glyphicon glyphicon-trash'></span> </button></td></tr>");
                        // $('.is_active_price').iCheck({
                        //     checkboxclass: 'icheckbox_square-yellow',
                        //     radioclass: 'iradio_square-yellow',
                        //     increaseArea: '20%'
                        // });
                        $('.is_active_price').on('ifToggled', function(event){
                            $(this).closest('tr').toggleClass('warning');
                        });
                        $('.is_active_price').on('ifChanged', function(event){
                            id = $(this).data('id');
                            $.ajax({
                                type: 'post',
                                url: "{{ URL::route('change_price_status') }}",
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
// delete a price
    $(document).on('click','.price-delete-modal',function(){
        $('.modal-title').text('Delete price');
        $('#id_delete').val($(this).data('id'));
        $('#title_delete').val($(this).data('price_name'));
        $('#price-delete-modal').modal('show');
        id = $('#id_delete').val();
    });
    $('.price-delete-modal-footer').on('click', '.delete', function() {
            $.ajax({
                type: 'DELETE',
                url: 'prices/' + id,
                data: {
                    '_token': $('input[name=_token]').val(),
                },
                success: function(data) {
                    toastr.success('Successfully deleted price!', 'Success Alert', {timeOut: 5000});
                    $('.item' + data['id']).remove();
                }
            });
    });
    