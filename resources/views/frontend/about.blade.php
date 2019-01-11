@extends('frontend.master')
@section('content')
	<!-- about -->
<div class="about">
	<div class="container">
	<div class="wthree_head_section">
				<h3 class="w3l_header">About <span>Us</span></h3>
				<p>Treat yourself to a facial or celebrating a special occasion, aromatherapy, our beauty 
and skin care services will suit every beauty need.</p>
			</div>
		<div class="ab-agile">
			<div class="col-md-6 aboutleft">
				<h3>Welcome to Maya</h3>
				@if(!$aboutdata->isEmpty())
				<p class="para1">{{$aboutdata[0]->content}} </p>
				@endif
				<?php $serc=0; ?>
				@foreach($servicedata as $service_data)
				<?php $serc++; ?>
				@if($serc<=3)
				<p><i class="fa fa-check" aria-hidden="true"></i> {{$service_data->service_name}} </p>
				@endif
				@endforeach
				<!-- <p><i class="fa fa-check" aria-hidden="true"></i> Proin tempor pulvinar Vivamus nisi hendrerit et. </p>
				<p><i class="fa fa-check" aria-hidden="true"></i> Proin tempor pulvinar Vivamus nisi hendrerit et. </p> -->
				</div>
			<div class="col-md-6 aboutright">
				<img src="/assets/about/{{$aboutdata[0]->image}}" class="img-responsive" alt="" />
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
</div>




	
	@endsection