@extends('frontend.master')
@section('content')
				
<!-- banner-bottom -->
<div id="about" class="banner-bottom">
	<div class="container">
		<div class="w3_banner_bottom_grid_pos">
			<div class="w3_banner_bottom_grid">
				<h3>Maya Thread</h3>
			</div>
		</div>
		<div class="w3ls_banner_bottom_grid1">
			<div class="col-md-6 w3l_banner_bottom_left">	
				<img src="{{asset('img/welcome1.jpg')}}" alt=" " class="img-responsive" />
			</div>
			<div class="col-md-6 w3l_banner_bottom_right">
				<h3>Welcome to <span><i>Maya</i> Thread</span></h3>
				<p>Praesent lobortis, ligula vitae scelerisque condimentum, 
					risus orci lobortis nibh, at gravida justo magna in metus.</p>
					{{$contactdata}}
				<ul>
					<li><i class="fa fa-table" aria-hidden="true"></i>10 years experience</li>
					<li><i class="fa fa-certificate" aria-hidden="true"></i>Certified Salon</li>
					<li><i class="fa fa-usd" aria-hidden="true"></i>Low Prices</li>
				</ul>
			</div>
			<div class="clearfix"> </div>
		</div>
		<div class="agileits_banner_bottom_grid_three">
			<div class="col-md-4 agileinfo_banner_bottom_grid_three_left">
				<div class="wthree_banner_bottom_grid_three_left1 grid">
					<figure class="effect-roxy">
						<img src="{{asset('/img/welcome2.jpg')}}" alt=" " class="img-responsive" />
						<figcaption>
							<h3>Hair <span>Dressing</span></h3>
							<p>Vestibulum pulvinar lobortis lorem lectus pretium non.</p>
						</figcaption>			
					</figure>
				</div>
				<p class="w3_agileits_para">Pellentesque vehicula augue eget nisl ullamcorper, 
					molestie blandit ipsum auctor. Mauris volutpat augue dolor.</p>
			</div>
			<div class="col-md-4 agileinfo_banner_bottom_grid_three_left">
				<div class="wthree_banner_bottom_grid_three_left1 grid">
					<figure class="effect-roxy">
						<img src="{{asset('/img/welcome3.jpg')}}" alt=" " class="img-responsive" />
						<figcaption>
							<h3>Hair <span>Dressing</span></h3>
							<p>Vestibulum pulvinar lobortis lorem lectus pretium non.</p>
						</figcaption>			
					</figure>
				</div>
				<p class="w3_agileits_para">Pellentesque vehicula augue eget nisl ullamcorper, 
					molestie blandit ipsum auctor. Mauris volutpat augue dolor.</p>
			</div>
			<div class="col-md-4 agileinfo_banner_bottom_grid_three_left">
				<div class="wthree_banner_bottom_grid_three_left1 grid">
					<figure class="effect-roxy">
						<img src="{{asset('/img/welcome4.jpg')}}" alt=" " class="img-responsive" />
						<figcaption>
							<h3>Hair <span>Dressing</span></h3>
							<p>Vestibulum pulvinar lobortis lorem lectus pretium non.</p>
						</figcaption>			
					</figure>
				</div>
				<p class="w3_agileits_para">Pellentesque vehicula augue eget nisl ullamcorper, 
					molestie blandit ipsum auctor. Mauris volutpat augue dolor.</p>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
</div>
	<!-- Modal1 -->
	<div class="modal fade" id="myModal4" tabindex="-1" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4>Beauty Salon</h4>
					<img src="{{asset('/img/11.jpg')}}" alt=" " class="img-responsive">
					<h5>Neque porro quisquam est qui dolorem </h5>
					<p>Ut in ligula sollicitudin, auctor elit vel, mollis tortor. Nullam id magna in eros mollis porttitor vel et eros.Phasellus
						sed iaculis nibh, non suscipit tortor. Aenean ante massa, lobortis et dolor eget, sollicitudin luctus arcu. Donec eros
						tortor, ultrices in lectus quis, aliquet commodo lectus.Donec eros tortor, ultrices in lectus quis, aliquet commodo
						lectus.</p>
				</div>
			</div>
		</div>
	</div>
	<!-- //Modal1 -->
	<!-- Latest News -->
	<div class="practice-areas">
		<div class="container">
			<div class="wthree_head_section">
				<h3 class="w3l_header">Our <span>Services</span></h3>
				<p>Treat yourself to a facial or celebrating a special occasion, aromatherapy, our beauty 
and skin care services will suit every beauty need.</p>
			</div>
			<div class="area-main">
				<div class="col-md-6 area-inner">
					<div class="area-img1">
					</div>
					<div class="area-right p1">
						<h5>FACIAL</h5>
						<p class="para-w3-agile">Phasellus sed iaculis nibh, non suscipit tortor. Aenean ante massa, lobortis et dolor eget, sollicitudin luctus arcu.
							Donec eros tortor, ultrices in lectus quis, aliquet commodo lectus.</p>
					</div>
				</div>
				<div class="col-md-6 area-inner">
					<div class="area-img2">
					</div>
					<div class="area-right p2">
						<h5>MAKEUP</h5>
						<p class="para-w3-agile">Phasellus sed iaculis nibh, non suscipit tortor. Aenean ante massa, lobortis et dolor eget, sollicitudin luctus arcu.
							Donec eros tortor, ultrices in lectus quis, aliquet commodo lectus.</p>
					</div>
				</div>
			</div>
			<div class="area-main">
				<div class="col-md-6 area-inner">
					<div class="area-right p3">
						<h5>NAIL CARE</h5>
						<p class="para-w3-agile">Phasellus sed iaculis nibh, non suscipit tortor. Aenean ante massa, lobortis et dolor eget, sollicitudin luctus arcu.
							Donec eros tortor, ultrices in lectus quis, aliquet commodo lectus.</p>
					</div>
					<div class="area-img3">
					</div>
				</div>
				<div class="col-md-6 area-inner">
					<div class="area-right p4">
						<h5>HAIR CARE</h5>
						<p class="para-w3-agile">Phasellus sed iaculis nibh, non suscipit tortor. Aenean ante massa, lobortis et dolor eget, sollicitudin luctus arcu.
							Donec eros tortor, ultrices in lectus quis, aliquet commodo lectus.</p>
					</div>
					<div class="area-img4">
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- //Latest News -->
	
	<!-- Price-section -->
	<div class="price" id="price">
		<div class="col-md-6 w3l_about_bottom_left" 
		
		> 
		</div>
	    <div class="col-md-6 w3l_about_bottom_right">
			<div class="title-agileits1">
                    <h3>Our Pricing List</h3> 
			   </div>
			<p>Suspendisse bibendum est ac pellentesque pretium. Etiam congue ante eros, sit amet gravida.</p>
					<div class="price-list">
								<div class="wthree-grids-price">
									<h4>Haircut</h4>
									<h5> $12</h5>
									<div class="clearfix"> </div>
								</div>
									<div class="wthree-grids-price">
									<h4> Beard Grooming</h4>
									<h5> $30</h5>
									<div class="clearfix"> </div>
								</div>
								<div class="wthree-grids-price">
									<h4>Haircut + Beard style</h4>
									<h5> $38</h5>
									<div class="clearfix"> </div>
								</div>
								<div class="wthree-grids-price">
									<h4>Straightening(Hair + Beard)</h4>
									<h5> $40</h5>
									<div class="clearfix"> </div>
								</div>
								<div class="wthree-grids-price">
									<h4>Beard Shaping</h4>
									<h5> $11</h5>
									<div class="clearfix"> </div>
								</div>
								<div class="wthree-grids-price">
									<h4>Combo Pack</h4>
									<h5> $60</h5>
									<div class="clearfix"> </div>
								</div>
							</div>
		</div>
		
		<div class="clearfix"> </div>
	</div>
<!-- //Price-section -->

	<!-- Clients -->
	<div class="clients-main" id="clients">
		<div class="container">
			<!-- Owl-Carousel -->
			<div class="wthree_head_section">
				<h3 class="w3l_header">What <span>People Say</span></h3>
				<p>Treat yourself to a facial or celebrating a special occasion, aromatherapy, our beauty 
and skin care services will suit every beauty need.</p>
			</div>
			<div id="owl-demo" class="owl-carousel text-center clients-right">
				<div class="item g1">
					<div class="agile-dish-caption">
						<h4>John Smith</h4>
						<span>Lorem Ipsum</span>
					</div>
					<img class="lazyOwl" src="{{asset('/img/c1.jpg')}}" alt="" />
					<div class="clearfix"></div>
					<p class="para-w3-agile"><span class="fa fa-quote-left" aria-hidden="true"></span>Duis nulla nulla, faucibus id diam ac, luctus sodales purus.
						Quisque nibh ipsum,Ut accumsan.</p>
				</div>
				<div class="item g1">
					<div class="agile-dish-caption">
						<h4>Jecy Deoco</h4>
						<span>Lorem Ipsum</span>
					</div>
					<img class="lazyOwl" src="{{asset('/img/c2.jpg')}}" alt="" />
					<div class="clearfix"></div>
					<p class="para-w3-agile"><span class="fa fa-quote-left" aria-hidden="true"></span>Duis nulla nulla, faucibus id diam ac, luctus sodales purus.
						Quisque nibh ipsum,Ut accumsan.</p>
				</div>
				<div class="item g1">
					<div class="agile-dish-caption">
						<h4>Devid Fahim</h4>
						<span>Lorem Ipsum</span>
					</div>
					<img class="lazyOwl" src="{{asset('/img/c3.jpg')}}" alt="" />
					<div class="clearfix"></div>
					<p class="para-w3-agile"><span class="fa fa-quote-left" aria-hidden="true"></span>Duis nulla nulla, faucibus id diam ac, luctus sodales purus.
						Quisque nibh ipsum,Ut accumsan.</p>
				</div>
				<div class="item g1">
					<div class="agile-dish-caption">
						<h4>Honey Jisa</h4>
						<span>Lorem Ipsum</span>
					</div>
					<img class="lazyOwl" src="{{asset('/img/c1.jpg')}}" alt="" />
					<div class="clearfix"></div>
					<p class="para-w3-agile"><span class="fa fa-quote-left" aria-hidden="true"></span>Duis nulla nulla, faucibus id diam ac, luctus sodales purus.
						Quisque nibh ipsum,Ut accumsan.</p>
				</div>
				<div class="item g1">
					<div class="agile-dish-caption">
						<h4>Jecy Deoco</h4>
						<span>Lorem Ipsum</span>
					</div>
					<img class="lazyOwl" src="{{asset('/img/c2.jpg')}}" alt="" />
					<div class="clearfix"></div>
					<p class="para-w3-agile"><span class="fa fa-quote-left" aria-hidden="true"></span>Duis nulla nulla, faucibus id diam ac, luctus sodales purus.
						Quisque nibh ipsum,Ut accumsan.</p>
				</div>
				<div class="item g1">
					<div class="agile-dish-caption">
						<h4>Devid Fahim</h4>
						<span>Lorem Ipsum</span>
					</div>
					<img class="lazyOwl" src="{{asset('/img/c3.jpg')}}" alt="" />
					<div class="clearfix"></div>
					<p class="para-w3-agile"><span class="fa fa-quote-left" aria-hidden="true"></span>Duis nulla nulla, faucibus id diam ac, luctus sodales purus.
						Quisque nibh ipsum,Ut accumsan.</p>
				</div>
			</div>
			<!--// Owl-Carousel -->
		</div>
	</div>
	<!--// Clients -->
	@endsection