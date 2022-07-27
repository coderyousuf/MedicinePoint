
@extends('masterlayout')

@section('titlename') Payment Success @endsection

@section('maincontent')
	

		<!-- Section -->
		<section class="bg-section ysuccess pt-10 pb-10" data-black-overlay="8" style="background-image: url({{ asset('public/images/background/bg-2.jpg') }})">
			<div class="container">
				<div class="row align-items-center">
					<div class="col-lg-7">
						<i class="fa fa-home white"></i> <span> / Payment Success</span>	
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
	                                   <!-- <a class="btn btn-success mb-0" href="{{ route('register') }}"><i class="fa fa-user-plus"></i> {{ __('Register') }}</a>-->
	                                @endif
	                            @endauth
	                        </div>
                   		@endif

					</div>
				</div>
			</div>
		</section>
		<!-- /Section -->	

<div style="display:none">
	<label>Orders Id</label>
	<input type="text"  name="OrdersId" id="OrdersId" value={{$OrdersId}}>
</div>


<!-- Blog Section -->
		<div class="blog-area ptb-30">
			<div class="container">
				<div class="row" id="bloglist">
					<span style="font-size: 20px; color:brown; padding-bottom:180px;">Paid Successfully</span>					
				</div>
			</div>
		</div>
		<!-- /Blog Section -->

		
 @endsection


@section('customjs')

<script>
	var tableMain;
 	var SITEURL = '{{URL::to('')}}';


 

function SetPaymentSuccessFlag() {

	    $.ajax({
	        type: "post",
	        url: SITEURL+"/paymentSuccessFlagRoute",
	        data: {
	        	"OrdersId":$("#OrdersId").val(),
        		"_token":$('meta[name="csrf-token"]').attr('content')
        	},
	        success:function(response){		
	        	//console.log(response);
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
				toastr.error("Error");

				}, 1300);

	        }

	    });
	}
 

	$(document).ready(function() {
		SetPaymentSuccessFlag();
	} );

function clearForm() {
	
}

</script>

<style>
iframe{
	height: 100%;
	width: 100%;
}
</style>

 @endsection