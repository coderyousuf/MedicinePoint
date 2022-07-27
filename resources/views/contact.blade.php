
@extends('masterlayout')

@section('titlename') Contact @endsection

@section('maincontent')
	

		<!-- Section -->
		<section class="bg-section ysuccess pt-10 pb-10" data-black-overlay="8" style="background-image: url({{ asset('public/images/background/bg-2.jpg') }})">
			<div class="container">
				<div class="row align-items-center">
					<div class="col-lg-7">
						<i class="fa fa-home white"></i> <span> / Contact</span>	
					</div>
					<div class="col-lg-5 align-right">

                   		@if (Route::has('login'))
	                        <div class="top-right links">
	                            @auth
	                                <span>Hi,</span> <a href="{{ url('profile') }}" <span class="font-white"><u>{{ Auth::user()->name }}</u></span> </a>
	                                <a class="btn btn-primary mb-0" href="{{ url('logout') }}"><i class="fa fa-lock"></i> {{ __('Logout') }}</a>
	                            @else
	                                <a class="btn btn-info mb-0" href="{{ route('login') }}"><i class="fa fa-unlock"></i> {{ __('Login') }}</a>

	                                @if (Route::has('register'))
	                                   <a class="btn btn-success mb-0" href="{{ route('register') }}"><i class="fa fa-user-plus"></i> {{ __('Register') }}</a>
	                                @endif
	                            @endauth
	                        </div>
	                    @endif
	                    
					</div>
				</div>
			</div>
		</section>
		<!-- /Section -->	

		<!-- Contact info Section -->
		<section class="contact style-1">
			<div class="container " >
				<div class="row">

					<div class="col-lg-4" style="background: rgba(120, 140, 107, 0.9)">
						<div class="contact-address">
							<h2>Contact Info</h2>
							<ul class="contact-info">
								<li>
									<span class="con-icon">
										<i class="fa fa-map-marker"></i>
									</span>
									<div class="con-desc">
										Saver<br/>Dhaka
									</div>
								</li>
								<li>
									<span class="con-icon">
										<i class="fa fa-envelope-o"></i>
									</span>
									<div class="con-desc">
										pronob@gmail.com <br/>chan@gmail.com
									</div>
								</li>
								<li>
									<span class="con-icon">
										<i class="fa fa-phone"></i>
									</span>
									<div class="con-desc">
										01689xxxxxx <br/>01692xxxxxx
									</div>
								</li>
								<li>
									<span class="con-icon">
										<i class="fa fa-clock-o"></i>
									</span>
									<div class="con-desc">
										Working Hours<br>9.00 AM - 10.00 PM
									</div>
								</li>
							</ul>
						</div>
					</div>
					<div class="col-lg-8">
						<!-- Google Map Section -->
						<div id="map" class="google-map"></div>
						<!-- /Google Map Section -->
					</div>



				</div>
			</div>
		</section>
		<!-- /Contact info Section -->


		
 @endsection

@section('extralibincludefooter')
   <!-- Highchart -->
	<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD7tvmKDI1rNPxCezId3lorKS5n4fI7oOM&callback=initMap"></script>
@endsection


@section('customjs')
	
<script>

	function initMap() {
		//var latlng = {lat: Your Latitude, lng: Your Longitude};
		var latlng = {lat: 23.859489145919607, lng: 90.264379091007};
		var map = new google.maps.Map(document.getElementById('map'), {
			zoom: 12,
			center: latlng,
			zoomControl: true,
			scaleControl: false,
			scrollwheel: false,
			disableDoubleClickZoom: true
		});
		//Tooltip info
		var contentString = '<div class="map-tooltip">'+
				'<div class="map-tooltip-content">'+
					'<ul class="map-tooltip-info">'+
						'<li>'+
								'<h2>Office Loaction</h2>'+
								'<p>Saver, Dhaka</p>'+
						'</li>'+
					'</ul>'+
				'</div>' +
		'</div>';
		var infowindow = new google.maps.InfoWindow({
		  content: contentString
		});
		var marker = new google.maps.Marker({
		  position: latlng,
		  map: map
		});
		marker.addListener('click', function() {
		  infowindow.open(map, marker);
		});
	}

     
</script>
@endsection