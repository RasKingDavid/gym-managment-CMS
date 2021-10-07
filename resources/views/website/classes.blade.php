@extends('layouts.frontEnd.app')
@section('content')
    

	<!-- Page top section -->
	<section class="page-top-section set-bg" data-setbg="{{ asset ('website/img/header-bg/2.jpg') }}">
		<div class="container">
			<h2>Classes</h2>
		</div>
	</section>
	<!-- Page top section end -->


	<!-- Service section -->
	<section class="service-section">
		<div class="container">
			<div class="row">
				@foreach (App\Service::all() as $service) 
					<div class="col-lg-4 col-sm-6">
						<div class="icon-box-item">
							<div class="ib-icon">
								<i class="">
									<img src="{{ asset('media/service/' .$service->service_thumbnail) }}"/>
								</i>
							</div>
							<h4>{{ $service->name }}</h4>
							<p>{{ $service->description }}</p>
						</div>
					</div>
				@endforeach
				{{-- <div class="col-lg-4 col-sm-6">
					<div class="icon-box-item">
						<div class="ib-icon">
							<i class="flaticon-045-fitness"></i>
						</div>
						<h4>Finess</h4>
						<p>Vivamus libero mauris, bibendum eget sapien ac, ultrices rhoncus ipsum. Donec nec sapien in urna fermentum ornare.</p>
					</div>
				</div>
				<div class="col-lg-4 col-sm-6">
					<div class="icon-box-item">
						<div class="ib-icon">
							<i class="flaticon-033-pump"></i>
						</div>
						<h4>Aerobics</h4>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi at vulputate est. Donec tempor felis at nibh eleifend malesuada.  </p>
					</div>
				</div>
				<div class="col-lg-4 col-sm-6">
					<div class="icon-box-item">
						<div class="ib-icon">
							<i class="flaticon-017-weightlifting-1"></i>
						</div>
						<h4>Pilates</h4>
						<p>Donec nec sapien in urna fermentum ornare. Morbi vel ultrices leo. Sed eu turpis eu arcu vehicula fringilla ut vitae orci. </p>
					</div>
				</div>
				<div class="col-lg-4 col-sm-6">
					<div class="icon-box-item">
						<div class="ib-icon">
							<i class="flaticon-004-dumbbell"></i>
						</div>
						<h4>Wheight Lifting</h4>
						<p>Donec nec sapien in urna fermentum ornare. Morbi vel ultrices leo. Sed eu turpis eu arcu vehicula fringilla ut vitae orci. </p>
					</div>
				</div>
				<div class="col-lg-4 col-sm-6">
					<div class="icon-box-item">
						<div class="ib-icon">
							<i class="flaticon-038-vitamins"></i>
						</div>
						<h4>Nutrition</h4>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi at vulputate est. Donec tempor felis at nibh eleifend malesuada. </p>
					</div>
				</div> --}}
			</div>
		</div>
	</section>
	<!-- Service section end -->

	<!-- Pricing section end -->
	<section class="pricing-section set-bg" data-setbg="{{ asset ('website/img/pricing-bg.jpg') }}">
		<div class="container">
			<div class="section-title text-white text-center">
				<h2>Prices for <span>everybody</span></h2>
			</div>
			<div class="row">
				@foreach ($plans as $plan)
					<div class="col-lg-3 col-sm-6">
					<div class="pricing-box">
						<h2>{{ $plan->plan_name }}</h2>
						<h3>${{ $plan->amount }}</h3>
						<p>/month</p>
						<ul>
							 @foreach (App\Plan_Service::where('plan_id', $plan->id)->get() as $service) 
							<li>{{ $service->service->name }}</li>
							@endforeach
						</ul>
						<a href="{{ route('website.planseleted', $plan->id) }}" class="site-btn">Choose Plan</a>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</section>
	<!-- Pricing section  -->

	<!-- Classes section -->
	<section class="classes-section">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<div class="section-title">
					<h2>Do you need a <span>Personal Trainer?</span><br> Get in touch with us now. </h2>
				</div>
				</div>
				<div class="col-lg-6">
					<div class="classes-text">
						<p>Donec nec sapien in urna fermentum ornare. Morbi vel ultrices leo. Sed eu turpis eu arcu vehicula fringilla ut vitae orci. Donec eget efficitur ex. Donec eget dolor vitae eros feugiat tristique id vitae massa. Proin vulputate congue rutrum. Fusce lobortis a enim eget tempus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. </p>
						<a href="{{ url('contact-us') }}" class="site-btn">Send us a message</a>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Trainers section end -->

@endsection