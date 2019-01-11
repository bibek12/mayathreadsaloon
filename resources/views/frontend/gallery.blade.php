@extends('frontend.master')
@section('content')
	<!--gallery-->
	<div class="gallery">
		<div class="container">	
		<div class="wthree_head_section">
				<h3 class="w3l_header">Our <span>Gallery</span></h3>
				<p>Treat yourself to a facial or celebrating a special occasion, aromatherapy, our beauty 
and skin care services will suit every beauty need.</p>
			</div>
			<div class="gallery-info">
				@foreach($gallerydata as $gallery_data)
				<div class="col-md-3 gallery-grids">
					<a href=" /assets/gallery/{{$gallery_data->gallery_image}}" class="gallery-box" data-lightbox="example-set" data-title="">
						<img src=" /assets/gallery/{{$gallery_data->gallery_image}}" alt="" class="img-responsive zoom-img">
					</a>
				</div>
				@endforeach
				<!-- <div class="col-md-3 gallery-grids">
					<a href="{{asset('/img/p2.jpg')}}" class="gallery-box" data-lightbox="example-set" data-title="">
						<img src="{{asset('/img/p2.jpg')}}" alt="" class="img-responsive zoom-img">
					</a>
				</div>
				<div class="col-md-3 gallery-grids">
					<a href="{{asset('/img/p3.jpg')}}" class="gallery-box" data-lightbox="example-set" data-title="">
						<img src="{{asset('/img/p3.jpg')}}" alt="" class="img-responsive zoom-img">
					</a>
				</div>
				<div class="col-md-3 gallery-grids">
					<a href="{{asset('/img/p4.jpg')}}" class="gallery-box" data-lightbox="example-set" data-title="">
						<img src="{{asset('/img/p4.jpg')}}" alt="" class="img-responsive zoom-img">
					</a>
				</div>
				<div class="col-md-3 gallery-grids">
					<a href="{{asset('/img/p5.jpg')}}" class="gallery-box" data-lightbox="example-set" data-title="">
						<img src="{{asset('/img/p5.jpg')}}" alt="" class="img-responsive zoom-img">
					</a>
				</div>
				<div class="col-md-3 gallery-grids">
					<a href="{{asset('/img/p6.jpg')}}" class="gallery-box" data-lightbox="example-set" data-title="">
						<img src="{{asset('/img/p6.jpg')}}" alt="" class="img-responsive zoom-img">
					</a>
				</div>
				<div class="col-md-3 gallery-grids">
					<a href="{{asset('/img/p7.jpg')}}" class="gallery-box" data-lightbox="example-set" data-title="">
						<img src="{{asset('/img/p7.jpg')}}" alt="" class="img-responsive zoom-img">
					</a>
				</div>
				<div class="col-md-3 gallery-grids">
					<a href="{{asset('/img/p8.jpg')}}" class="gallery-box" data-lightbox="example-set" data-title="">
						<img src="{{asset('/img/p8.jpg')}}" alt="" class="img-responsive zoom-img">
					</a>
				</div>
				<div class="col-md-3 gallery-grids">
					<a href="{{asset('/img/p9.jpg')}}" class="gallery-box" data-lightbox="example-set" data-title="">
						<img src="{{asset('/img/p9.jpg')}}" alt="" class="img-responsive zoom-img">
					</a>
				</div>
				<div class="col-md-3 gallery-grids">
					<a href="{{asset('/img/p10.jpg')}}" class="gallery-box" data-lightbox="example-set" data-title="">
						<img src="{{asset('/img/p10.jpg')}}" alt="" class="img-responsive zoom-img">
					</a>
				</div>
				<div class="col-md-3 gallery-grids">
					<a href="{{asset('/img/p11.jpg')}}" class="gallery-box" data-lightbox="example-set" data-title="">
						<img src="{{asset('/img/p11.jpg')}}" alt="" class="img-responsive zoom-img">
					</a>
				</div>
				<div class="col-md-3 gallery-grids">
					<a href="{{asset('/img/p12.jpg')}}" class="gallery-box" data-lightbox="example-set" data-title="">
						<img src="{{asset('/img/p12.jpg')}}" alt="" class="img-responsive zoom-img">
					</a>
				</div> -->
				<div class="clearfix"> </div>	
			</div>
			
		</div>
</div>
<!--//gallery-->

@endsection