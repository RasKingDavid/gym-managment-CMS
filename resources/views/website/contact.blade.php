@extends('layouts.frontEnd.app')
@section('content')
    
	<!-- Page top section -->
	<section class="page-top-section set-bg" data-setbg="{{ asset ('website/img/header-bg/4.jpg') }}">
		<div class="container">
			<h2>Contact</h2>
		</div>
	</section>
	<!-- Page top section end -->

	<!-- Contact section -->
	<section class="contact-section">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					@include('flash::message')
				</div>
				<div class="col-lg-4">
					<h2 class="contact-title">Contact Info</h2>
					<div class="contact-info-warp">
						<h4>Location</h4>
						<div class="contact-info">
							<img src="img/icons/1-dark.png" alt="">
							<div class="cf-text">
								<p>1525  Awesome Lane, Los Angeles, CA</p>
							</div>
						</div>
					</div>
					<div class="contact-info-warp">
						<h4>Subscriptions</h4>
						<div class="contact-info">
							<img src="{{ asset('img/icons/2-dark.png') }}" alt="">
							<div class="cf-text">
								<p>+1 (603)535-4592</p>
								<p>+1 (603)535-4556</p>
							</div>
						</div>
					</div>
					<div class="contact-info-warp">
						<h4>E-mail</h4>
						<div class="contact-info">
							<img src="{{ asset ('website/img/icons/3-dark.png') }}" alt="">
							<div class="cf-text">
								<p>Contact@xgym.com</p>
								<p>www.xgym.com</p>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-8">
					<h2 class="contact-title">Get in touch</h2>
					<form class="contact-form" action="{{ url('website/send/enquries') }}" method="post" enctype="multipart/form-data">
						<input type="hidden" name="_token" value="{{csrf_token()}}"/>
						<div class="form-row">
							<div class="form-group col-md-6">
								<input type="text" class="form-control" name="name" placeholder="Your name">
							</div>
							<div class="form-group col-md-6">
								<input type="email" class="form-control" name="email" placeholder="Your e-mail">
							</div>
							<div class="form-group col-md-12">
								<input type="text" placeholder="Subject" class="form-control" name="subject">
								<textarea class="form-control" placeholder="Message" name="message"></textarea>
								<button class="site-btn" type="submit">Send Message</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="map"><iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d14376.077865872314!2d-73.879277264103!3d40.757667781624285!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sbd!4v1546528920522" style="border:0" allowfullscreen></iframe></div>
	</section>
	<!-- Contact section end -->

@endsection