@extends('frontend.master')
@section('content')
	<!-- services -->
	<div class="agileits_banner_bottom_grid_three" style="    margin: 3em 3rem;">
			<div class="wthree_head_section">
				<h3 class="w3l_header">Our <span>Services</span></h3>
				<p>Treat yourself to a facial or celebrating a special occasion, aromatherapy, our beauty 
				and skin care services will suit every beauty need.</p>
			</div>
			<?php $ic=0; ?>
			@foreach($servicedata as $service_data)
			<?php $ic++; ?>
			@if($ic<=6)
			<div class="col-md-4 agileinfo_banner_bottom_grid_three_left">
				<div class="wthree_banner_bottom_grid_three_left1 grid">
					<figure class="effect-roxy">
						<img src="/assets/service/{{$service_data->service_image}}" alt=" " class="img-responsive" style="    height: 300px !important;" />
						<figcaption>
							<h3>{{$service_data->service_name}}</h3>
							<p>{!!strlen($service_data->service_content)>40 ? substr($service_data->service_content,0,40) : $service_data->service_content !!}</p>
						</figcaption>			
					</figure>
				</div>
				<p class="w3_agileits_para">{{$service_data->service_content}}</p>
			</div>
			@endif
			@endforeach
	
			<div class="clearfix"> </div>
		</div>
<!-- <div class="practice-areas">
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
	</div>	 -->
	<!-- //services -->
	

	<!-- about-top -->
	
	<!-- //about-top -->

	<!-- Modal1 -->
	<div class="modal fade" id="myModal4" tabindex="-1" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4>Beauty Salon</h4>
					<img src=" {{asset('/img/img/11.jpg')}}" alt=" " class="img-responsive">
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
	@endsection