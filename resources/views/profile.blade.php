
@extends('masterlayout')

@section('titlename') My Profile @endsection

@section('maincontent')
	

		<!-- Section -->
		<section class="bg-section ysuccess pt-10 pb-10" data-black-overlay="8" style="background-image: url({{ asset('public/images/background/bg-2.jpg') }})">
			<div class="container">
				<div class="row align-items-center">
					<div class="col-lg-7">
						<i class="fa fa-home white"></i> <span> / My Profile</span>	
					</div>
					<div class="col-lg-5 align-right">
						<span>Hi,</span> <a href="{{ url('profile') }}" <span class="font-white"><u>{{ Auth::user()->name }}</u></span> </a>
						<a class="btn btn-primary mb-0" href="{{ url('logout') }}"><i class="fa fa-lock"></i> {{ __('Logout') }}</a>
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
						<div class="col-lg-12">
							<div class="card" style="margin-bottom:130px;">
								<div class="card-body">

									<form role="form" id="addeditform">
									{{ csrf_field() }}
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label>ID</label>
													<input disabled="disabled" type="text" class="form-control" name="usercode" id="usercode">
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>Name<span class="red">*</span></label>
													<input type="text" class="form-control parsley-validated" name="name" id="name" data-required="true" placeholder="Enter Your Name">
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>Phone<span class="red">*</span></label>
													<input type="text" class="form-control parsley-validated" name="phone" id="phone" data-required="true" placeholder="Enter Your Phone">
												</div>
											</div>
										</div>
										
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label>E-mail<span class="red">*</span></label>
													<input disabled type="text" class="form-control parsley-validated" name="email" id="email" data-required="true" placeholder="Enter Your E-mail">
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>Password<span class="red">*</span>   <i class="fa fa-info-circle" title="Enter strong password. At least 8 charecture with small letter, capital letter, number and special charecture."></i></label>
													<input type="text" class="form-control parsley-validated" name="password" id="password" data-required="true" placeholder="Enter Your Password">
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>Role</label>
													<input  disabled="disabled" type="text" class="form-control" name="userrole" id="userrole">
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label>NID<span class="red">*</span></label>
													<input type="text" class="form-control" name="nid" id="nid"  data-required="true" placeholder="Enter Your NID">
												</div>
											</div>
											<div class="col-md-8">
												<div class="form-group">
													<label>Address<span class="red">*</span></label>
													<input type="text" class="form-control" name="address" id="address" data-required="true">
												</div>
											</div>
										</div>

										<div class="form-group row">
											<div class="col align-self-center">
												<input type="text" id="recordId" name="recordId" style="display:none;">
												<a href="javascript:void(0)" class="btn btn-primary btn-sm" id="btnSubmit"><i class="fa fa-save"></i> Save</a>
												<a href="javascript:void(0)" class="btn btn-danger btn-sm" onClick="getProfileData();"><i class="fa fa-times"></i> Cancel</a>
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
		
		if(!validatePhone($('#phone').val())){
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

		if(!validateNid($('#nid').val())){
			 setTimeout(function() {
				toastr.options = {
					closeButton: true,
					progressBar: true,
					showMethod: 'slideDown',
					timeOut: 4000
				};
			toastr.error("Please enter valid NID");

			}, 1300);

			return;
		}


		if(!validateEmail( $('#email').val())){
			 setTimeout(function() {
				toastr.options = {
					closeButton: true,
					progressBar: true,
					showMethod: 'slideDown',
					timeOut: 4000
				};
			toastr.error("Please enter valid E-mail");

			}, 1300);

			return;
		}


		if(!validatePassword( $('#password').val())){
			 setTimeout(function() {
				toastr.options = {
					closeButton: true,
					progressBar: true,
					showMethod: 'slideDown',
					timeOut: 4000
				};
			toastr.error("Please enter valid password");

			}, 1300);

			return;
		}

	    $.ajax({
	        type: "post",
	        //url: "http://localhost/olms/addEditBookTypeRoute",
	        url: SITEURL+"/editProfileRoute",
	        data: $("#addeditform").serialize(),
	        success:function(response){
	            //alert("success");
	           	var msg = "Profile updated successfully.";
				setTimeout(function() {
					toastr.options = {
						closeButton: true,
						progressBar: true,
						showMethod: 'slideDown',
						timeOut: 4000
					};
					toastr.success(msg);

				}, 1300);
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
				toastr.error("Operation fail");

				}, 1300);

	        }

	    });
	}

	$(document).ready(function() {

		$("#btnSubmit").click(function () {
	        $("#addeditform").submit();
	    });

		
		getProfileData();
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


function validateNid(nid) {
	if(nid.length < 10 || nid.length > 17){
		return false;
	}else{
			return true;
		}
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

function validateEmail(email) {
    const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

function validatePassword(password) {
	if(password.length >= 8){
		//return true;
		const re = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/;
    	return re.test(password);
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