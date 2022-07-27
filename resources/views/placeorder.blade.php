
@extends('masterlayout')

@section('titlename') Place Order @endsection

@section('maincontent')
	

		<!-- Section -->
		<section class="bg-section ysuccess pt-10 pb-10" data-black-overlay="8" style="background-image: url({{ asset('public/images/background/bg-2.jpg') }})">
			<div class="container">
				<div class="row align-items-center">
					<div class="col-lg-7">
						<i class="fa fa-home white"></i> <span> / Place Order</span>	
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
	<label>Product Id</label>
	<input type="text"  name="ProductId" id="ProductId" value={{$ProductId}}>
</div>

<div style="display:none">
	<label>Orders Id</label>
	<input type="text"  name="OrdersId" id="OrdersId">
</div>

<!-- Blog Section -->
		<div class="blog-area ptb-30">
			<div class="container">

					<div class="row" id="cardProducts">

						<div class="col-lg-12 col-md-12 col-sm-12">
							<article class="post style-2">
								<div class="post-contentx">
										<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
										Lorem Ipsum has been the industry's standard dummy</p>
								</div>

								<div style="width: 35%;" class="post-thumbnail height-blog" id="ImageURL">
									<!--<img src="{{ URL::asset('storage/app/blog/blog-2.jpg') }}" alt="" />-->
								</div>

								<div class="post-header">
									<h2 class="post-title" id="ProductName"></h2>
	           
	                                <div class="post-meta productprice">
	                                  <label style="width: 120px" for="UnitPrice">Price (Per KG)<span class="red">*</span></label>
	                                  <input type="text" id="UnitPrice" disabled>
	                                </div>

	                                <div class="post-meta productprice">
	                                  <label style="width: 120px" for="Quantity">Quantity (KG)<span class="red">*</span></label>
	                                  <input type="number" id="Quantity" value="1" min="1" max="20" onchange="calculateTotalPrice()">
	                                </div>

	                                <div class="post-meta totalprice">
	                                  <label style="width: 120px" for="TotalPrice">Total Price<span class="red">*</span></label>
	                                  <input type="text" id="TotalPrice" disabled>
	                                </div>


	                                <div class="post-meta productprice">
	                                  <label style="width: 120px" for="BuyerName">Your Name<span class="red">*</span></label>
	                                  <input type="text" id="BuyerName" placeholder="Enter your name">
	                                </div>

	                                <div class="post-meta productprice">
	                                  <label style="width: 120px" for="Phone">Phone<span class="red">*</span></label>
	                                  <input type="text" id="Phone" placeholder="Enter phone number">
	                                </div>


	                                <div class="post-meta productprice">
	                                  <label style="width: 120px" for="Address">Address<span class="red">*</span></label>
	                                  <input style="width: 600px" type="text" id="Address" placeholder="Enter delivery address">
	                                </div>

	                                
	                                
	                                <div class="post-meta">
	                               		<a class="btn blue-btn" id="btnsubmitorder" href="javascript:void(0)">Submit</a>
	                                </div>
								</div>
							</article>
						</div>

						
					</div>



					<div class="row" id="paymentprocess" style="display:none">

						<div class="col-lg-12 col-md-12 col-sm-12">
							<article class="post style-2">
								<div class="post-contentx">
										<p>Please, press on Confirm to continue your payment process.</p>
								</div>
<!--
								<div style="width: 35%;" class="post-thumbnail height-blog" id="ImageURL">
									 <img src="{{ URL::asset('storage/app/bookfile/bkash.png') }}" alt="" /> 
								</div>
-->
							

								<div class="post-header">
									<!--
									<h2 class="post-title" id="ProductName"></h2>
	           
	                                <div class="post-meta productprice">
	                                  <label style="width: 120px" for="UnitPrice">Price (Per KG)<span class="red">*</span></label>
	                                  <input type="text" id="UnitPrice" disabled>
	                                </div>

	                                <div class="post-meta productprice">
	                                  <label style="width: 120px" for="Quantity">Quantity<span class="red">*</span></label>
	                                  <input type="number" id="Quantity" value="1" min="1" max="20">
	                                </div>

	                                <div class="post-meta totalprice">
	                                  <label style="width: 120px" for="TotalPrice">Total Price<span class="red">*</span></label>
	                                  <input type="text" id="TotalPrice" disabled>
	                                </div>


	                                <div class="post-meta productprice">
	                                  <label style="width: 120px" for="BuyerName">Your Name<span class="red">*</span></label>
	                                  <input type="text" id="BuyerName" placeholder="Enter your name">
	                                </div>

	                                <div class="post-meta productprice">
	                                  <label style="width: 120px" for="Phone">Phone<span class="red">*</span></label>
	                                  <input type="text" id="Phone" placeholder="Enter phone number">
	                                </div>


	                                <div class="post-meta productprice">
	                                  <label style="width: 120px" for="Address">Address<span class="red">*</span></label>
	                                  <input style="width: 600px" type="text" id="Address" placeholder="Enter delivery address">
	                                </div>

	                                 -->
	                                
	                                <div class="post-meta" id="paymentconfirmbtn">
	                               		<!--<a class="btn blue-btn" id="btnconfirmorder" href="{{ url('paymentgetwayRouteTest') }}/100">Confirm</a>-->
	                                </div>

	                           
								</div>
							
							</article>
						</div>

						
					</div>



			</div>
		</div>
		<!-- /Blog Section -->

		
 @endsection


@section('customjs')

<script>
	var tableMain;
 	var SITEURL = '{{URL::to('')}}';
 

function calculateTotalPrice() {

	var UnitPrice = $("#UnitPrice").val();
	var Quantity = $("#Quantity").val();
	var TotalPrice = 0;

		TotalPrice = (UnitPrice*Quantity).toFixed(0);

	$("#TotalPrice").val(TotalPrice);
}

function getSingleProductForPlace() {

	    $.ajax({
	        type: "post",
	        url: SITEURL+"/getSingleProductForPlaceOrderRoute",
	        data: {
	        	"ProductId":$("#ProductId").val(),
        		"_token":$('meta[name="csrf-token"]').attr('content')
        	},
	        success:function(response){		

				$("#ImageURL").html('<img src="{{ URL::asset('storage/app') }}/'+response[0].ImageURL+'" alt="" />');

				$("#ProductName").html("<a javascript:void(0)>"+response[0].ProductName+"</a>");
				$("#UnitPrice").val(response[0].Price);
				$("#Quantity").val(1);
				$("#TotalPrice").val(response[0].Price);

				$("#BuyerName").val("");
				$("#Phone").val("");
				$("#Address").val("");
				 
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


	/***submit order***/
	function onSubmitOrder() {

		if(!validatePhone($('#Phone').val())){
			 setTimeout(function() {
				toastr.options = {
					closeButton: true,
					progressBar: true,
					showMethod: 'slideDown',
					timeOut: 4000
				};
			toastr.error("Please enter valid Phone No");

			}, 1300);

			return;
		}


		var UnitPrice = $("#UnitPrice").val();
		var Quantity = $("#Quantity").val();
		var TotalPrice = $("#TotalPrice").val();

		var BuyerName = $("#BuyerName").val();
		var Phone = $("#Phone").val();
		var Address = $("#Address").val();

		if(UnitPrice>0 && Quantity>0 && TotalPrice>0 && BuyerName != "" && Phone != "" && Address != ""){
			    $.ajax({
			        type: "post",
			        url: SITEURL+"/submitOrderRoute",
			        data: {
			        	"ProductId":$("#ProductId").val(),
			        	"UnitPrice":UnitPrice,
			        	"Quantity":Quantity,
			        	"TotalPrice":TotalPrice,
			        	"BuyerName":BuyerName,
			        	"Phone":Phone,
			        	"Address":Address,
		        		"_token":$('meta[name="csrf-token"]').attr('content')
		        	},
			        success:function(response){

						$("#OrdersId").val(response);

						$("#cardProducts").hide();

						var surl = "{{ url('paymentgetwayRoute') }}/"+$("#OrdersId").val();
						var confirmbtn ='<a class="btn blue-btn" id="btnconfirmorder" href="'+surl+' ">Confirm</a>';

						$("#paymentconfirmbtn").html(confirmbtn);



						$("#paymentprocess").show();

						clearForm();						
			        },
			        error:function(error){
			            setTimeout(function() {
							toastr.options = {
								closeButton: true,
								progressBar: true,
								showMethod: 'slideDown',
								timeOut: 4000
							};
						toastr.error("Operation fail");

						}, 1300);

			        }

			    });
			}
			else{
				setTimeout(function() {
						toastr.options = {
							closeButton: true,
							progressBar: true,
							showMethod: 'slideDown',
							timeOut: 4000
						};
					toastr.error("Please, fill-up all required informations.");

					}, 1300);
			}
	}




	/***confirm order***/
	function onConfirmOrder() {

		// var UnitPrice = $("#UnitPrice").val();
		// var Quantity = $("#Quantity").val();
		// var TotalPrice = $("#TotalPrice").val();

		// var BuyerName = $("#BuyerName").val();
		// var Phone = $("#Phone").val();
		// var Address = $("#Address").val();

		// if(UnitPrice>0 && Quantity>0 && TotalPrice>0 && BuyerName != "" && Phone != "" && Address != ""){
			    $.ajax({
			        type: "post",
			        url: SITEURL+"/confirmOrderRoute",
			        data: {
			        	"OrdersId":$("#OrdersId").val(),
			        	// "UnitPrice":UnitPrice,
			        	// "Quantity":Quantity,
			        	// "TotalPrice":TotalPrice,
			        	// "BuyerName":BuyerName,
			        	// "Phone":Phone,
			        	// "Address":Address,
		        		"_token":$('meta[name="csrf-token"]').attr('content')
		        	},
			        success:function(response){
						
						var msg="";
			           	    msg = "Order submitted successfully.";
			           
						setTimeout(function() {
							toastr.options = {
								closeButton: true,
								progressBar: true,
								showMethod: 'slideDown',
								timeOut: 4000
							};
							toastr.success(msg);

						}, 1300);
					
					//redirect to home page
			        

			        },
			        error:function(error){
			            setTimeout(function() {
							toastr.options = {
								closeButton: true,
								progressBar: true,
								showMethod: 'slideDown',
								timeOut: 4000
							};
						toastr.error("Operation fail");

						}, 1300);

			        }

			    });
			// }
			// else{
			// 	setTimeout(function() {
			// 			toastr.options = {
			// 				closeButton: true,
			// 				progressBar: true,
			// 				showMethod: 'slideDown',
			// 				timeOut: 4000
			// 			};
			// 		toastr.error("Please, fill-up all required informations.");

			// 		}, 1300);
			// }
	}




	/***show paymentgetway***/
	function paymentgetway() {

		// var UnitPrice = $("#UnitPrice").val();
		// var Quantity = $("#Quantity").val();
		// var TotalPrice = $("#TotalPrice").val();

		// var BuyerName = $("#BuyerName").val();
		// var Phone = $("#Phone").val();
		// var Address = $("#Address").val();

		// if(UnitPrice>0 && Quantity>0 && TotalPrice>0 && BuyerName != "" && Phone != "" && Address != ""){
			    $.ajax({
			        type: "post",
			        url: SITEURL+"/paymentgetwayRoute",
			        data: {
			        	"OrdersId":$("#OrdersId").val(),
		        		"_token":$('meta[name="csrf-token"]').attr('content')
		        	},
			        success:function(response){
						
						var msg="";
			           	    msg = "Order submitted successfully.";
			           
						setTimeout(function() {
							toastr.options = {
								closeButton: true,
								progressBar: true,
								showMethod: 'slideDown',
								timeOut: 4000
							};
							toastr.success(msg);

						}, 1300);
					
					//redirect to home page
			        

			        },
			        error:function(error){
			            setTimeout(function() {
							toastr.options = {
								closeButton: true,
								progressBar: true,
								showMethod: 'slideDown',
								timeOut: 4000
							};
						toastr.error("Operation fail");

						}, 1300);

			        }

			    });
	}

	$(document).ready(function() {

		$('#btnsubmitorder').on('click', function(){
			onSubmitOrder();
		});
/*
		$('#btnconfirmorder').on('click', function(){

			paymentgetway();
			//onConfirmOrder();
		});
*/

		getSingleProductForPlace();
	} );


function clearForm() {
	$("#ImageURL").html('<img style="height:100%" src="{{ URL::asset('storage/app/bookfile') }}/'+ "noimage.jpg" +'" alt="" />');

	$("#ProductName").html("<a javascript:void(0)> </a>");
	$("#UnitPrice").val(0);
	$("#Quantity").val(1);
	$("#TotalPrice").val(0);

	$("#BuyerName").val("");
	$("#Phone").val("");
	$("#Address").val("");
}

function validatePhone(phoneno) {
	if(phoneno.length == 11){
		var regExp = new RegExp("^\\d+$");
		var isValid = regExp.test(phoneno);
		if(isValid){
			if(phoneno>0){
				return true;
			}
			else{
				return false;
			}
		}else{
			return false;
		}
	}else{
			return false;
		}
}

</script>

<style>
iframe{
	height: 100%;
	width: 100%;
}
</style>

 @endsection