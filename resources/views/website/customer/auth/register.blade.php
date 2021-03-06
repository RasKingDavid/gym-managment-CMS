@extends('layouts.frontEnd.app')
@section('content')
    
	<!-- Page top section -->
	<section class="page-top-section set-bg" data-setbg="{{ asset ('website/img/header-bg/4.jpg') }}">
		<div class="container">
			<h2>Customer Registration</h2>
		</div>
	</section>
	<!-- Page top section end -->

	<!-- Contact section -->
	<section class="contact-section">
		<div class="container">
			<div class="row">
				<div class="col-md-4 col-lg-4">
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
					<h2 class="contact-title">Create a new account</h2>

                    @include('flash::message')
                    
					<form action="{{ route('customer.register-attempt') }}" method="post" enctype="multipart/form-data">
						<input type="hidden" name="_token" value="{{csrf_token()}}"/>
						<div class="form-row">
							<div class="form-group col-md-6">
                                <label for="">Full Name:</label>
								<input type="text" class="form-control" name="name" required>
							</div>
							<div class="form-group col-md-6">
                                <label for="">Email:</label>
								<input type="email" class="form-control" name="email" required>
							</div>
							<div class="form-group col-md-6">
                                <label for="">Password:</label>
								<input type="password" class="form-control" name="password" required>
							</div>
							<div class="form-group col-md-6">
                                <label for="">Confirm Password:</label>
								<input type="password" class="form-control" name="confirm_password" required>
							</div>
							<div class="form-group col-md-6">
                                <label for="">Phone:</label>
								<input type="text" class="form-control" name="phone" required>
							</div>
							<div class="form-group col-md-6">
                                <label for="">Address:</label>
								<input type="text" class="form-control" name="address" required>
							</div>
							<div class="form-group col-md-12">
								<button class="btn btn-warning btn-lg float-right" type="submit">Register</button>
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