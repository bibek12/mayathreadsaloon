
<script src="{{ url ('/js/app.js') }}" type="text/javascript"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twbs-pagination/1.3.1/jquery.twbsPagination.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.5/validator.min.js"></script>
	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
	<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
	
 <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>

    <!-- Bootstrap JavaScript -->
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.1/js/bootstrap.min.js"></script>

    <!-- toastr notifications -->
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <!-- icheck checkboxes -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/icheck.min.js"></script>

<script src="/js/about.js"></script> 
<script src="/js/member.js"></script> 
<script src="/js/gallery.js"></script> 
<script src="/js/service.js"></script> 
<script src="/js/contact.js"></script> 
<script src="/js/banner.js"></script> 
<script src="/js/price.js"></script> 
<script src="/js/custom.js"></script>
<script src="/js/testimonial.js"></script> 

<!-- datatable -->
<script src="{{asset('/js/datatables.min.js')}}"></script> 
<script src="{{ asset('/js/nepali.datepicker.v2.2.min.js') }}" ></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('#aboutTable').DataTable();
    $('#memberTable').DataTable();
    $('#galleryTable').DataTable();
    $('#serviceTable').DataTable();
    $('#bannerTable').DataTable();
    $('#contactTable').DataTable();
    $('#priceTable').DataTable();
    $('#testimonialTable').DataTable();

  });
// change is active of class
 $(document).ready(function(){
        // $('.is_active_about').iCheck({
        //                 checkboxClass: 'icheckbox_square-yellow',
        //                 radioClass: 'iradio_square-yellow',
        //                 increaseArea: '20%'
        //     });
        $('.is_active_about').on('click', function(event){
          
            id = $(this).data('id');
            $.ajax({
                  type: 'POST',
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
        $('.is_active_about').on('ifToggled', function(event) {
              $(this).closest('tr').toggleClass('warning');
        });

       
});
 // change is member of class
 $(document).ready(function(){
        // $('.is_active_about').iCheck({
        //                 checkboxClass: 'icheckbox_square-yellow',
        //                 radioClass: 'iradio_square-yellow',
        //                 increaseArea: '20%'
        //     });
        $('.is_active_member').on('click', function(event){
          
            id = $(this).data('id');
            $.ajax({
                  type: 'POST',
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
        $('.is_active_member').on('ifToggled', function(event) {
              $(this).closest('tr').toggleClass('warning');
        });
         });
//
 // change is member of class
 $(document).ready(function(){
        // $('.is_active_about').iCheck({
        //                 checkboxClass: 'icheckbox_square-yellow',
        //                 radioClass: 'iradio_square-yellow',
        //                 increaseArea: '20%'
        //     });
        $('.is_active_service').on('click', function(event){
          
            id = $(this).data('id');
            $.ajax({
                  type: 'POST',
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
        $('.is_active_service').on('ifToggled', function(event) {
              $(this).closest('tr').toggleClass('warning');
        });
        });
//
 // change is member of class
 $(document).ready(function(){
        // $('.is_active_about').iCheck({
        //                 checkboxClass: 'icheckbox_square-yellow',
        //                 radioClass: 'iradio_square-yellow',
        //                 increaseArea: '20%'
        //     });
        $('.is_active_gallery').on('click', function(event){
          
            id = $(this).data('id');
            $.ajax({
                  type: 'POST',
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
        $('.is_active_gallery').on('ifToggled', function(event) {
              $(this).closest('tr').toggleClass('warning');
        });   
});
 //
 // change is contact of class
 $(document).ready(function(){
        // $('.is_active_about').iCheck({
        //                 checkboxClass: 'icheckbox_square-yellow',
        //                 radioClass: 'iradio_square-yellow',
        //                 increaseArea: '20%'
        //     });
        $('.is_active_contact').on('click', function(event){
          
            id = $(this).data('id');
            $.ajax({
                  type: 'POST',
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
        $('.is_active_contact').on('ifToggled', function(event) {
              $(this).closest('tr').toggleClass('warning');
        });   
});
 //
 // change is price of class
 $(document).ready(function(){
        // $('.is_active_about').iCheck({
        //                 checkboxClass: 'icheckbox_square-yellow',
        //                 radioClass: 'iradio_square-yellow',
        //                 increaseArea: '20%'
        //     });
        $('.is_active_price').on('click', function(event){
          
            id = $(this).data('id');
            $.ajax({
                  type: 'POST',
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
        $('.is_active_price').on('ifToggled', function(event) {
              $(this).closest('tr').toggleClass('warning');
        });   
});
 //
 // change is member of class
 $(document).ready(function(){
        // $('.is_active_about').iCheck({
        //                 checkboxClass: 'icheckbox_square-yellow',
        //                 radioClass: 'iradio_square-yellow',
        //                 increaseArea: '20%'
        //     });
        $('.is_active_banner').on('click', function(event){
          
            id = $(this).data('id');
            $.ajax({
                  type: 'POST',
                  url: "{{ URL::route('change_banner_status') }}",
                  data: {
                      '_token': $('input[name=_token]').val(),
                      'id': id
                  },
                  success: function(data) {
                      // empty
                  },
              });
        });
        $('.is_active_banner').on('ifToggled', function(event) {
              $(this).closest('tr').toggleClass('warning');
        });   
});
 //
 // change is testimonial of class
 $(document).ready(function(){
        // $('.is_active_about').iCheck({
        //                 checkboxClass: 'icheckbox_square-yellow',
        //                 radioClass: 'iradio_square-yellow',
        //                 increaseArea: '20%'
        //     });
        $('.is_active_testimonial').on('click', function(event){
          
            id = $(this).data('id');
            $.ajax({
                  type: 'POST',
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
        $('.is_active_testimonial').on('ifToggled', function(event) {
              $(this).closest('tr').toggleClass('warning');
        });   
});
 //

</script>
