<!DOCTYPE html>
<html lang="en">
@section('header')
	@include('frontend.partials.header')
@show

<body>
	<!-- Banner and Navbar for all pages -->
	@include('frontend.partials.navbar')
	
				
	<!-- Content -->
	@yield('content')

	<!-- footer -->
	@include('frontend.partials.footer')
	<!-- //footer -->

	<a href="#home" class="scroll" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
	<!-- //smooth scrolling -->
	@include('frontend.partials.scripts')
</body>
</html>