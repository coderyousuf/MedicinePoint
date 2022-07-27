
@extends('masterlayout')

@section('titlename') About Us @endsection

@section('maincontent')
	

		<!-- Section -->
		<section class="bg-section ysuccess pt-10 pb-10" data-black-overlay="8" style="background-image: url({{ asset('public/images/background/bg-2.jpg') }})">
			<div class="container">
				<div class="row align-items-center">
					<div class="col-lg-7">
						<i class="fa fa-home white"></i> <span> / About Us</span>	
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

		<!-- Testimonial Section -->
		<section class="testimonial-area pt-10 pb-10">
			<div class="container">

				<div id="formpanel" >
					<div class="row">
						<div class="col-lg-12" style="margin-bottom:130px;">
						<br/>
						<p><b>Welcome to our site</b></p>
						<p><b>E-commerce System of Medicine</b> বা Medicine Point is a web platform to delivery the medicines based on your required</p>
					</div>
				</div>
              </div>
				
				
			</div>
		</section>
		<!-- /Testimonial Section -->
		
 @endsection


@section('customjs')

<script>
	var tableMain;
 	var SITEURL = '{{URL::to('')}}';

	$(document).ready(function() {

	
		
		//getProfileData();
	} );

function getProfileData() {

	    $.ajax({
	        type: "post",
	        url: SITEURL+"/profileviewRoute",
	        data: {
	        	"id":1,
        		"_token":$('meta[name="csrf-token"]').attr('content')
        	},
	        success:function(response){
				response = jQuery.parseJSON(response);

	        	$('#usercode').val(response[0]['usercode']);
	        	$('#name').val(response[0]['name']);
	        	$('#email').val(response[0]['email']);
	        	$('#phone').val(response[0]['phone']);
	        	$('#nid').val(response[0]['nid']);
	        	$('#address').val(response[0]['address']);
	        	//$('#password').val(response[0]['password']);
	        	$('#password').val('');
	        	$('#userrole').val(response[0]['userrole']);
	        },
	        error:function(error){
	            //alert("fail");
	            setTimeout(function() {
					toastr.options = {
						closeButton: true,
						progressBar: true,
						showMethod: 'slideDown',
						timeOut: 4000
					};
				toastr.error("Profile data can not fillup");

				}, 1300);

	        }

	    });
	}


</script>

<style>

</style>

 @endsection