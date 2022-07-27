
@extends('masterlayout')

@section('titlename') Product Registration @endsection

@section('maincontent')
	

		<!-- Section -->
		<section class="bg-section ysuccess pt-10 pb-10" data-black-overlay="8" style="background-image: url({{ asset('public/images/background/bg-2.jpg') }})">
			<div class="container">
				<div class="row align-items-center">
					<div class="col-lg-7">
						<i class="fa fa-home white"></i> <span> / Product Registration Form</span>	
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

		<!-- Testimonial Section -->
		<section class="testimonial-area pt-10 pb-10">
			<div class="container">

				<div id="formpanel" style="padding-bottom: 110px;">
					<div class="row">
						<div class="col-lg-12">
							<div class="card">
								<div class="card-body">

									<form role="form" id="addeditform">
									{{ csrf_field() }}
										
										



										<div class="row">
											<div class="col-md-3">
												<div class="form-group">
													<label>ID</label>
													<input disabled="disabled" type="text" class="form-control" name="usercode" id="usercode">
												</div>
											</div>
											<div class="col-md-2">
												<div class="form-group">
													<label>Phone<span class="red">*</span></label>
													<input disabled="disabled" type="text" class="form-control parsley-validated" name="phone" id="phone">
												</div>
											</div>
											<div class="col-md-7">
												<div class="form-group">
													<label>Name<span class="red">*</span></label>
													<input disabled="disabled" type="text" class="form-control parsley-validated" name="name" id="name">
												</div>
											</div>
										</div>
										
										<div class="row">
											<div class="col-md-3">
												<div class="form-group">
													<label>E-mail<span class="red">*</span></label>
													<input disabled="disabled" type="text" class="form-control parsley-validated" name="email" id="email">
												</div>
											</div>
										
											<div class="col-md-2">
												<div class="form-group">
													<label>NID<span class="red">*</span></label>
													<input disabled="disabled" type="text" class="form-control" name="nid" id="nid">
												</div>
											</div>
											<div class="col-md-7">
												<div class="form-group">
													<label>Address<span class="red">*</span></label>
													<input disabled="disabled" type="text" class="form-control" name="address" id="address">
												</div>
											</div>
										</div>







										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>Product Name<span class="red">*</span></label>													
													<select data-placeholder="Choose Product Name..." class="chosen-select" id="ProductId" name="ProductId" required>
														<option value=0>Select Product Name</option>
													</select>
												</div>											
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Product Ability (Per day)<span class="red">*</span></label>
													<input type="text" class="form-control parsley-validated" name="productability" id="productability" data-required="true" placeholder="Enter Your Product Ability">
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<span  style="color:red">Condition –We sales you’re all product at cost of 10% percent. you must confirm your stock ability , after order you must delivered your product within 2 days .If you will not delivered you must be give us demerge money<span>										
												</div>											
											</div>
										</div>
<!--
										<div class="row">
											
											<div class="col-md-3">I agree on above condition</div>
											<div class="col-md-1">
												<div class="form-group">
													<input class="form-check-input" type="checkbox" name="agreecondition" id="agreecondition">
												</div>											
											</div>
											<div class="col-md-1">
																					
											</div>
										</div>-->

										<div class="form-group row">
											<div class="col align-self-center">
												<input type="text" id="recordId" name="recordId" style="display:none;">
												<a href="javascript:void(0)" class="btn btn-primary btn-sm" id="btnSubmit"><i class="fa fa-save"></i> Submit</a>
												<a href="javascript:void(0)" class="btn btn-danger btn-sm" onClick="clearForm();"><i class="fa fa-times"></i> Cancel</a>
											</div>
										</div>
									</form>

								</div>
							</div>
					
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

	/***Reset the control***/
	function resetForm(id) {
		$('#' + id).each(function() {
			this.reset();
		});
	}

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


/***Validation***/
jQuery("#addeditform").parsley({
	listeners : {
		onFieldValidate : function(elem) {
			if (!$(elem).is(":visible")) {
                return true;
            }
            else {
                return false;
            }
		},
		onFormSubmit : function(isFormValid, event) {
			if (isFormValid) {
				onConfirmWhenAddEdit();
				return false;
			}
		}
	}
});


	/***Data Insert or update***/
	function onConfirmWhenAddEdit() {
		
  
	    $.ajax({
	        type: "post",
	        url: SITEURL+"/farmerregistrationformRoute",
	        data: $("#addeditform").serialize(),
	        success:function(response){
	           	var msg = "Registration successfully complete. Please wait admin approval.";
				setTimeout(function() {
					toastr.options = {
						closeButton: true,
						progressBar: true,
						showMethod: 'slideDown',
						timeOut: 4000
					};
					toastr.success(msg);

				}, 1300);
				clearForm();
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
				toastr.error("Please fill-up valid information");

				}, 1300);

	        }

	    });
	}
 


function getProductNameList() {

	    $.ajax({
	        type: "post",
	        url: SITEURL+"/getProductNameListRoute",
	        data: {
	        	"id":1,
        		"_token":$('meta[name="csrf-token"]').attr('content')
        	},
	        success:function(response){				
				$.each(response, function(i, obj) {
					$("#ProductId").append($('<option></option>').val(obj.ProductId).html(obj.ProductName));
					
				});
				$("#ProductId").trigger("chosen:updated");
				 
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
				toastr.error("Dropdown can not fillup");

				}, 1300);

	        }

	    });
	}
 

	$(document).ready(function() {
		$('.chosen-select').chosen({width: "100%"});

		$("#btnSubmit").click(function () {
	        $("#addeditform").submit();
	    });

		getProfileData();
		
		getProductNameList();
	} );

function clearForm() {
	//resetForm("addeditform");
	recordId="";
	$('#ProductId').val(0).trigger("chosen:updated");
	$('#productability').val('');
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

	.align-left {
		text-align: left;
	}
	.align-center {
		text-align: center !important;
	}
	.align-right {
		text-align: right;
	}
.font-white {
    color: white !important;
}
</style>

 @endsection