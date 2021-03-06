<!DOCTYPE html>
<html lang="eng">
<head>
	<?php  $settings = Utilities::getSettings();
	?>
	<title>{{ $settings['gym_name'] }} </title>
	<meta charset="UTF-8">
	<meta name="description" content="{{ $settings['gym_name'] }} ">
	<meta name="keywords" content="fitness, html">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<!-- Favicon -->
	<link href="img/favicon.ico" rel="shortcut icon"/>

	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i&display=swap" rel="stylesheet">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&display=swap" rel="stylesheet">

	<!-- Stylesheets -->
	<link rel="stylesheet" href="{{ URL::asset('website/css/bootstrap.min.css') }}"/>
	<link rel="stylesheet" href="{{ URL::asset('website/css/font-awesome.min.css') }}"/>
	<link rel="stylesheet" href="{{ URL::asset('website/css/owl.carousel.min.css') }}"/>
	<link rel="stylesheet" href="{{ URL::asset('website/css/flaticon.css') }}"/>
	<link rel="stylesheet" href="{{ URL::asset('website/css/slicknav.min.css') }}"/>

	<!-- Main Stylesheets -->
	<link rel="stylesheet" href="{{ URL::asset('website/css/style.css') }}"/>


	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>
<body>
	<!-- Page Preloder -->
	<div id="preloder">
		<div class="loader"></div>
	</div>

	<!-- Header section -->
	<header class="header-section">
		<a href="{{ url('/') }}" class="site-logo">
			@if($settings['gym_logo'] != '')
			<img src="{{ asset('media/company_image/' .$settings['gym_logo'] ) }}"  alt="">
			@else 
			<h4>{{ $settings['gym_name'] }}</h4>
			@endif
		</a>
		<ul class="main-menu">
			<li><a  @if(Request::segment(1) == '') class=" active " @endif href="{{ url('/') }}">Home</a></li>
			<li><a @if(Request::segment(1) == 'about-us') class=" active " @endif href="{{ route('website.about-us') }}">About Us</a></li>
			<li><a @if(Request::segment(1) == 'classes') class=" active " @endif href="{{ route('website.classes') }}">Classes</a></li>
			<li><a @if(Request::segment(1) == 'news') class=" active " @endif href="{{ route('website.news') }}">News</a></li>
			<li><a @if(Request::segment(1) == 'contact-us') class=" active " @endif href="{{ route('website.contact') }}">Contact</a></li>
			<li><a href="{{ route('shop.index') }}">Shop</a></li>

			@if (Session::has('customer'))
				<li><a href="{{ route('customer.logout') }}">Logout ({{ Session::get('customer')['logo'] }}) </a></li>
				<li><a href="{{ route('customer.dashboard') }}">Dashboard ({{ Session::get('customer')['logo'] }}) </a></li>
			@else
				<li><a href="{{ route('customer.login') }}">Login</a></li>
			@endif
			<?php
				if(!\Cart::isEmpty()){
					$items = \Cart::getContent();
					$count = $items->count();
				}else {
					$count = 0;
				}
			?>
			<li>
				<a href="{{ route('cart.show') }}"><i class="fa fa-cart-arrow-down"></i> 
					Cart <span class="text-small text-danger">
						@if ($count != 0)
							({{ $count }})
						@endif
					</span>
				</a>
			</li>
			<li class="header-right">
				<div class="hr-box">
					<img src="{{ asset('website/img/location-icon.png') }}" alt="">
					<h6>{{ $settings['gym_address_1'] }}</h6>
				</div>
			</li>
		</ul>
	</header>
	<div class="clearfix"></div>
	<!-- Header section end -->

        @yield('content')
	<!-- Newsletter section  -->
	<section class="newsletter-section set-bg" data-setbg="{{ asset('website/img/newsletter-bg.jpg') }}">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<div class="section-title text-white mb-0">
						<h2>Subscribe to <span>newsletter</span></h2>
					</div>
				</div>
				<div class="col-lg-6">
					<form action="{{ url('newsletter') }}" method="POST" class="newsletter-form">
						<input type="text" placeholder="Your e-mail here" name="newsletter" id="newsletter">
						<button type="button" class="site-btn" id="subscribe_to">Subscribe</button>
					</form>
					
				</div>
				<span class="news_msg" id="msg" style="color: red;"></span>
				<span class="news_msg" id="success" style="color: green;"></span>
			</div>
			
{{-- Thank you mesage --}}
			

			{{-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#thankYou">Open Modal</button> --}}

<!-- Modal -->
<div id="thankYou" class="modal fade left" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <a class="close" href="#" data-dismiss="modal">&times;</a>
      <div class="page-body">
    <div class="head">  
      <h3 style="margin-top:7px;">News Letter</h3>
			<h4 class="modal-title">Thank you for subscribing to our newsletter</h4>
    </div>

  <h1 style="text-align:center;"><div class="checkmark-circle">
  <div class="background"></div>
  <div class="checkmark draw"></div>
</div><h1>

  </div>
</div>
</div>

</div>


		</div>
	</section>
	<!-- Newsletter section end -->
	




<style>

</style>

	<!-- Footer section -->
	<footer class="footer-section set-bg" data-setbg="{{ asset('website/img/footer-bg.jpg') }}">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-sm-6">
					<div class="footer-widget">
						<h4>Location</h4>
						<div class="fw-info-box">
							<img src="{{ asset('website/img/icons/1.png') }}" alt="">
							<div class="fw-info-text">
								<p>{{ $settings['gym_address_1'] }}</p>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6">
					<div class="footer-widget">
						<h4>Subscriptions</h4>
						<div class="fw-info-box">
							<img src="{{ asset('website/img/icons/2.png') }}" alt="">
							<div class="fw-info-text">
								<p>{{ $settings['primary_contact'] }}</p>
								<p></p>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6">
					<div class="footer-widget">
						<h4>E-mail</h4>
						<div class="fw-info-box">
							<img src="{{ asset('website/img/icons/3.png') }}" alt="">
							<div class="fw-info-text">
								<p>{{ $settings['gym_email'] }}</p>
								<p>www.xgym.com</p>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6">
					<div class="footer-widget">
						<h4>Social Media</h4>
						<div class="fw-info-box">
							<img src="{{ asset('website/img/icons/4.png') }}" alt="">
							<div class="social-links">
								<a href="#"><i class="fa fa-pinterest"></i></a>
								<a href="#"><i class="fa fa-facebook"></i></a>
								<a href="#"><i class="fa fa-twitter"></i></a>
								<a href="#"><i class="fa fa-dribbble"></i></a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 order-2 order-md-1">
					<div class="copyright"><p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | made with <i class="fa fa-heart" style="color: red" aria-hidden="true"></i> by <a href="#" target="_blank">{{ $settings['gym_name'] }}</a>
  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p></div>
				</div>
				<div class="col-md-6 order-1 order-md-2">
					<ul class="footer-menu">
						<li><a href="{{ url('/') }}">Home</a></li>
						<li><a href="{{ url('about-us') }}">About Us</a></li>
						<li><a href="{{ url('classes') }}">Classes</a></li>
						<li><a href="{{ url('news') }}">News</a></li>
						<li><a href="{{ url('contact-us') }}">Contact</a></li>
					</ul>
				</div>
			</div>
		</div>
	</footer>
	<!-- Footer section end -->
									
	<!--====== Javascripts & Jquery ======-->
	<script src="{{ URL::asset('website/js/jquery-3.2.1.min.js') }}"></script>
	<script src="{{ URL::asset('website/js/bootstrap.min.js') }}"></script>
	<script src="{{ URL::asset('website/js/jquery.slicknav.js') }}"></script>
	<script src="{{ URL::asset('website/js/owl.carousel.min.js') }}"></script>
	<script src="{{ URL::asset('website/js/circle-progress.min.js') }}"></script>
	<script src="{{ URL::asset('website/js/main.js') }}"></script>

	@yield('script')
<script>

$(document).ready(function(){
	
	// refresh();

	$('#newsletter').on('keyup', function(){
			$('#msg').text('');
	})
	$('#success').fadeOut(2000);

	$('#subscribe_to').click(function(){
		var newsletter = $('#newsletter').val();
		if (newsletter == "") {
			// alert(newsletter)
			$('#msg').text('email is required');
			$('#newsletter').focus();
			refresh();
			return false;
	}


	 $.ajax({
		 			 "type": "POST",
            "headers": {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
            "url": "/newsletter",
						"data": {
											'newsletter': newsletter,
										},
							"success": function (response) {
								if (response.success == 'Thank you for subscribing to our newsletter') {
									// alert('Thank you for subscribing to our newsletter')
								$("#success").html('Thank you for subscribing to our newsletter');
								$('#newsletter').val("");
								$('#thankYou').modal().show();
								$('#newsletter').focus();
								refresh();
								return false

								}else{

								$("#msg").html(response.error);
								$('#newsletter').focus();
								// $('#msg').fadeOut(3000);
								refresh();
								return false

								}

								return false
            }
      });
		});
		
	
	function refresh(){
		setTimeout(() => {
			$.ajax({
				'url': 'url'
			})
		$('#msg').text('');
		$('#thankYou').modal('hide');
		// $('#success').text('');
		// refresh();
		}, 5000);
	}
	})
</script>


	</body>
</html>
