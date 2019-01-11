@extends('frontend.master')
@section('content')
	<!-- contact -->
<div class="contact">
	<div class="container">
		<div class="wthree_head_section">
			<h3 class="w3l_header">Contact <span>Us</span></h3>
			<p>Treat yourself to a facial or celebrating a special occasion, aromatherapy, our beauty 
				and skin care services will suit every beauty need.</p>
			</div>		
		<div class="gal-btm">
			<div class="map-home">
				<div class="col-md-4 drop-pad sign-gd-two">
					<h3>Contact Us</h3>
					<ul>
						<li><i class="glyphicon glyphicon-map-marker" aria-hidden="true"></i> {{$contactdata->contact_address}}</li>
						<li><i class="glyphicon glyphicon-earphone" aria-hidden="true"></i> {{$contactdata->contact_phone}}</li>
						<li><i class="glyphicon glyphicon-envelope" aria-hidden="true"></i><a href="mailto:info@example.com">{{$contactdata->contact_email}}</a></li>
					</ul>
					<h3 class="connect">Get Connected</h3>
					<ul class="top-links">
						<li><a href="#"><i class="fa fa-facebook"></i></a></li>
						<li><a href="#"><i class="fa fa-twitter"></i></a></li>
						<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
						<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
					</ul>
				</div>
				<div class="col-md-8 contact-w3ls">
					<form action="#" method="post">
					<div class="col-md-5 col-sm-5 contact-left agileits-w3layouts">
					
						<div class="f-control"> 
							<label class="header">Full Name <span>:</span></label>
							<input type="text" name="First Name" placeholder="Name" required="">
						</div>
						
						<div class="f-control"> 
							<label class="header">Email <span>:</span></label>
							<input type="email" class="email" name="Email" placeholder="Email" required="">
						</div>
						
						<div class="f-control">
							<label class="header">Mobile Number <span>:</span></label>
							<input type="text" name="Number" placeholder="Mobile Number" required="">
						</div>	
						<!-- <input type="text" class="email" name="Last Name" placeholder="Last Name" required=""> -->
					</div> 
					<div class="col-md-7 col-sm-7 contact-right agileits-w3layouts">
						
							<label class="header">Message <span>:</span></label>
							<textarea name="Message" placeholder="Message" required=""></textarea>
						
						
					</div>
					<div class="clearfix"> </div> 
					<input type="submit" value="Send">
				</form>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
</div>
<!-- //contact -->
<!-- map -->
	<div class="frame">
		<iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d96704.53970617482!2d-74.05317380152253!3d40.76165377918555!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1sNew+York+City+beauty+salon!5e0!3m2!1sen!2sin!4v1512820386082" allowfullscreen></iframe>
	</div>
<!-- //map -->
	@endsection