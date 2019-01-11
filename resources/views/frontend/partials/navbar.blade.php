
<!-- banner -->

	<div class="banner jarallax" id="home" style="background: url('/img/22.jpg')no-repeat 0px 0px;">
		<header>
			<div class="container">
				<div class="header-bottom-agileits">
					<div class="w3-logo">
						<h1><a href="frontindex">Maya Thread</a></h1>
					</div>
					<div class="address">
						<p class="uppercase">{{$contactdata->contact_address}}</p>
						<p class="para-y"><a href="frontabout">Get more info</a></p>
					</div>
					<div class="nav-contact-w3ls">
						<p>+{{$contactdata->contact_phone}}<span class="fa fa-phone" aria-hidden="true"></span></p>
						<p class="para-y"><a href="mailto:{{$contactdata->contact_address}}">{{$contactdata->contact_email}}</a><span class="fa fa-envelope-o" aria-hidden="true"></span></p>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</header>
		<!-- navigation -->
<div class="nav-bg">
		<div class="container">
			<nav class="navbar navbar-default shift">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"
					    aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				  </button>

				</div>

				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav " id="my-menu">
						<li><a  class="menu "  href="frontindex">Home</a></li>
						<li><a  class="menu" id="menu1" href="frontabout">About</a></li>
						<li><a  class="menu" href="frontservice">Services</a></li>
						<li><a  class="menu" href="frontgallery">Gallery</a></li>
						<li><a  class="menu" href="frontcontact">Contact</a></li>
					</ul>

				</div>
				<!-- /.navbar-collapse -->

			</nav>
		</div>
	</div>
	<!-- //navigation -->
		<div class="container">
			<!-- header -->
			<!-- //header -->
			<div class="agileits_w3layouts_banner_info">
				<section class="slider">
						<div class="flexslider">
							<ul class="slides">
								@foreach($bannerdata as $banner_data)
								<li>
									<div class="banner-text-w3-agileits">
										<h5>{{$banner_data->banner_name}} </h5>
										<h2>{{$banner_data->banner_moto}}</h2>
										<p>P{{$banner_data->banner_content}}</p>
										<div class="botton">
											<a href="/frontcontact">Contact Now</a>
										</div>
									</div>
								</li>
								@endforeach
								<!-- <li>
									<div class="banner-text-w3-agileits">
										<h5>The best and fastest service</h5>
										<h2>Are You Planning to Pamper Yourself?</h2>
										<p>Providing expert skin care advice & beauty services using natural products to cater for any skin.</p>
										<div class="botton">
											<a href="contact.html">Contact Now</a>
										</div>
									</div>
								</li>
								<li>
									<div class="banner-text-w3-agileits">
										<h5>Experienced hair stylists </h5>
										<h2>Enjoy Professional Beauty Services!</h2>
										<p>Providing expert skin care advice & beauty services using natural products to cater for any skin.</p>
										<div class="botton">
											<a href="contact.html">Contact Now</a>
										</div>
									</div>
								</li> -->
							</ul>
						</div>
				</section>
			</div>
		</div>
	</div>
	<!-- //banner