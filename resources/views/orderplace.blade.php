
@extends('masterlayout')

@section('titlename') Order @endsection

@section('maincontent')
	

		<!-- Section -->
		<section class="bg-section ysuccess pt-10 pb-10" data-black-overlay="8" style="background-image: url({{ asset('public/images/background/bg-2.jpg') }})">
			<div class="container">
				<div class="row align-items-center">
					<div class="col-lg-7">
						<i class="fa fa-home white"></i> <span> / Order</span>	
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



			  <div id="formpanelprescriptionload" style="display: none;">
				 
			    <div class="row">
				  <div class="col-12 col-md-4 ">
						<select id="langsel" style="display:none">
							<option value='eng' selected> English </option>
						</select>
				  </div>
				  <div class="col-12 col-md-4 mt-3 mt-md-0">
						<div class="box">
							<input type="file" name="file-1[]" id="file-1" class="inputfile inputfile-1" data-multiple-caption="{count} files selected" multiple />
							<label for="file-1"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>Prescription&hellip;</span></label>
						</div>
				  </div>
			  </div>
			  <div class="row">
				  <div class="col-12 col-md-5">
					<div class="image-container">
						<img id="selected-image"  src="{{URL::asset('/public/Tesseract-OCR-master/images/Funny-Minion-Quotes.jpg')}}" alt="Convert" height="200" width="400">
					</div>

				  </div>
				  <div class="col-12 col-md-1">

					<i id="arrow-right" class="fas fa-arrow-right d-none d-md-block"></i>
					<i id="arrow-down" class="fas fa-arrow-down d-block d-md-none"></i>
				  </div>
				  <div class="col-12 col-md-6">
					<div id="log">
							<!--<span id="startPre">	
								<a id="startLink" href="#">Click here to recognize text in the demo</a>
								<br/> or choose your own image
							</span>-->
					</div>
				</div>
			  </div>
			<br/>
 			<div class="row">
			  <div class="col-lg-12 form-group">
					<div class="pull-right">
						<button onClick="generteOrder()" class="btn btn-info" id="btnNext"><i class="fa fa-arrow-right"></i> Confirm</button>
					</div>
				</div>
 			</div>

					 
              </div>

<!--
 			<div id="formpanelprescriptionprocess" >
				
			  <div class="row">
				  <div class="col-12 col-md-6">
					<div>
						<div class="col-md-8">
							<div class="form-group">
								<label>Blog Title<span class="red">*</span></label>
								<input type="text" class="form-control parsley-validated" name="BlogTitle" id="BlogTitle" data-required="true" placeholder="Enter Blog Title">
							</div>
						</div>	
					</div>
				</div>
			  </div>
					 
              </div>
-->
















				<div id="listpanel">
				
					<div class="row">
						<label class="col-lg-1 col-form-label"></label>
						<div class="col-lg-3 form-group">
							<div class="form-group">												
								
							</div>
						</div>
						<div class="col-lg-8 form-group">
							<div class="pull-right">
								<button class="btn btn-primary" id="btnAdd"><i class="fa fa-plus"></i> New Order</button>
								<!--<button class="btn btn-success" id="btnExport" onclick="exportExcel();"><i class="fa fa-file-excel-o"></i> Excel</button>-->
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-12">	
							<!-- <table id="tableMain" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th style="display:none;">BlogId</th>
										<th>Serial</th>
										<th>Type</th>
										<th>Date</th>
										<th>Blog Title</th>
										<th>Content</th>
										<th>Action</th>
										<th style="display:none;">Thumbnail</th>
									</tr>
								</thead>
								<tbody>
								</tbody>				
							</table> -->
							<table id="tableMain" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th style="display:none;">OrdersId</th>
										<th>Sl</th>
										<th>Date</th>
										<th>Total Price</th>
										<th>Payment</th>
										<th>Status</th>
										<th>Action</th>

									</tr>
								</thead>
								<tbody>
								</tbody>				
							</table>
						</div>
					</div>
				</div>
				

				<div id="formpanel" style="display:none;">
					<div class="row">
						<div class="col-lg-12 mb-10">
							<button class="btn btn-info btn-sm pull-right" type="button" id="btnBack"><i class="fa fa-mail-reply"></i>&nbsp;&nbsp;<span class="bold">Back</span></button>
						</div>
					</div>
					
					<div class="row">
						<div class="col-lg-12">
							<div class="card">
								<div class="card-body">

									<form role="form" id="addeditform">
									{{ csrf_field() }}
										<div class="row">

											<div class="col-md-3">
												<div class="form-group">
													<label>Order Date</label>
													<input disabled type="text" class="form-control parsley-validated" name="OrderDate" id="OrderDate">
												</div>
											</div>

											<div class="col-md-4">
												<div class="form-group">
													<label>Customer Name</label>
													<input disabled type="text" class="form-control parsley-validated" name="CustomerName" id="CustomerName">
												</div>
											</div>

											<div class="col-md-3">
												<div class="form-group">
													<label>Phone</label>
													<input disabled type="text" class="form-control parsley-validated" name="Phone" id="Phone">
												</div>
											</div>

											<div class="col-md-2">
												<div class="form-group">
													<label>Payment</label>
													<input disabled type="text" class="form-control" name="Payment" id="Payment">
												</div>
											</div>
											
										</div>

										<div class="row">
											
											<div class="col-md-3">
												<div class="form-group">
													<label>Total Price</label>
													<input disabled type="text" class="form-control" name="TotalPrice" id="TotalPrice">
												</div>
											</div>
											
											<div class="col-md-9">
												<div class="form-group">
													<label>Address</label>
													<input disabled type="text" class="form-control" name="Address" id="Address">
												</div>
											</div>
										</div>


										<div class="row">
											<div class="col-lg-12">	
												<table id="tableSub" class="table table-striped table-bordered" style="width:100%">
													<thead>
														<!--<tr>
															<th style="display:none;">OrdersItemId</th>
															<th>Sl</th>
															<th>Medicine Name</th>
															<th>Qty</th>
															<th>Unit Price</th>
															<th>Total Price</th>

														</tr>-->
													</thead>
													<tbody>
													</tbody>				
												</table>
											</div>
										</div>


<!--
										<div class="form-group row">
											<div class="col align-self-center">
												<input type="text" id="recordId" name="recordId" style="display:none;">
												<a href="javascript:void(0)" class="btn btn-primary btn-sm" id="btnSubmit"><i class="fa fa-save"></i> Save</a>
												<a href="javascript:void(0)" class="btn btn-danger btn-sm" onClick="onListPanel();"><i class="fa fa-times"></i> Cancel</a>
											</div>
										</div>-->

									</form>

								</div>
							</div>
					
					</div>
				</div>
              </div>
				
				

				<div id="formpanelpayment" style="display:none;">
					<div class="row">
						<div class="col-lg-12 mb-10">
							<button class="btn btn-info btn-sm pull-right" type="button" id="btnBack"><i class="fa fa-mail-reply"></i>&nbsp;&nbsp;<span class="bold">Back</span></button>
						</div>
					</div>
					
					<div class="row">
						<div class="col-lg-12">
							<div class="card">
								<div class="card-body">

									<form role="form" id="addeditformPayement">
									{{ csrf_field() }}
										<div class="row">
 
											<div class="col-md-6">
												<div class="form-group">
													<label>Order Date</label>
													<input disabled type="text" class="form-control parsley-validated" name="OrderDatePayment" id="OrderDatePayment">
												</div>
											</div>

											<div class="col-md-6">
												<div class="form-group">
													<label>Total Price</label>
													<input disabled type="text" class="form-control parsley-validated" name="TotalPricePayment" id="TotalPricePayment">
												</div>
											</div>
											
										</div>

										<div class="row">
 
											
											<div class="col-md-6">
												<div class="form-group">
													<img src="{{URL::asset('/public/images/bkash.png')}}" alt="Bkash" height="200" width="400">
												</div>
											</div>
											
										</div>

										
										<div class="form-group row">
											<div class="col align-self-center">
												<input type="text" id="recordIdPayment" name="recordIdPayment" style="display:none;">
												<a href="javascript:void(0)" class="btn btn-primary btn-sm" id="btnSubmitPayment"><i class="fa fa-save"></i> Payment</a>
												<a href="javascript:void(0)" class="btn btn-danger btn-sm" onClick="onListPanel();"><i class="fa fa-times"></i> Cancel</a>
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

 
		<!-- Modal -->
		<div class="popupModal" id="FileUploadModal">
		  <div class="modal-dialog" role="document">

			<form id="fileUploadForm" method="post" enctype="multipart/form-data"> @csrf
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLabel">Blog Image</h5>
			        <button type="button" class="close" onClick="hidePopupFileUploadModal()" href="javascript:void(0);"><i class="fa fa-times"></i></button>
			      </div>
			      <div class="modal-body">
					<input type="file" name="file">
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-secondary" onClick="hidePopupFileUploadModal()" href="javascript:void(0);">Close</button>
					<button type="submit" class="btn btn-primary">Save</button>
					<input type="hidden" id="idFileUp" name="idFileUp"  value=""/>
			      </div>
			    </div>
			</form>

		  </div>

		</div>
		<!-- /Testimonial Section -->
		

 @endsection


@section('customjs')
<script>
	var tableMain, tableSub;
 	var SITEURL = '{{URL::to('')}}';

	/***Hide all and show table***/
	function onListPanel(){
		$("#formpanel").hide();
		$("#formpanelpayment").hide();
		$("#formpanelprescriptionload").hide();		
		$("#listpanel").show();
	}
	/***Hide all and show order view form***/
	function onFormPanel(){
		$("#formpanelpayment").hide();
		$("#formpanelprescriptionload").hide();		
		$("#listpanel").hide();
		$("#formpanel").show();
	}

	/***Hide all and show payment form***/
	function onFormPanelPayment(){
		$("#listpanel").hide();
		$("#formpanelprescriptionload").hide();
		$("#formpanel").hide();
		$("#formpanelpayment").show();
	}

	/***Hide table and show new order form***/
	function onFormPanelNewOrder(){
		$("#listpanel").hide();
		$("#formpanelpayment").hide();
		$("#formpanel").hide();
		$("#formpanelprescriptionload").show();
	}
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

	var PopupFileUploadModal = document.getElementById('FileUploadModal');

	function showPopupFileUploadModal() {
		PopupFileUploadModal.style.display = "block";	
	}

	function hidePopupFileUploadModal() {
		PopupFileUploadModal.style.display = "none";	
	}

	/***Data Insert or update***/
	function onConfirmWhenAddEdit() {

	    $.ajax({
	        type: "post",
	        url: SITEURL+"/addEditBlogRoute",
	        data: $("#addeditform").serialize(),
	        success:function(response){
	            //alert("success");
				
				var msg="";
	            if($("#recordId").val() == "") {
	           	    msg = "Data added successfully.";
	            } else {
	           	    msg = "Data updated successfully.";
	            }
				setTimeout(function() {
					toastr.options = {
						closeButton: true,
						progressBar: true,
						showMethod: 'slideDown',
						timeOut: 4000
					};
					toastr.success(msg);

				}, 1300);
	            onListPanel();

	            $("#tableMain").dataTable().fnDraw();
				//return Redirect::to("booktypeentry")->withSuccess('Great! Todo has been inserted');
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



	/***Data Delete***/
	function onConfirmWhenDelete(recordId) {

		$.ajax({
            type: "post",
            url: SITEURL+"/deleteOrderRoute",
            
            datatype:"json",
            data: {
            	"id":recordId,
        		"_token":$('meta[name="csrf-token"]').attr('content')
    		},
            success:function(response){
                //alert("success");
				//console.log(response);
				//$("#tableMain").dataTable().fnDraw();

				var msg = "Data removed successfully.";
				setTimeout(function() {
					toastr.options = {
						closeButton: true,
						progressBar: true,
						showMethod: 'slideDown',
						timeOut: 4000
					};
					toastr.success(msg);

				}, 1300);
                onListPanel();
                $("#tableMain").dataTable().fnDraw();
			},
            error:function(error){
                //alert("fail");
                //console.log(error.responseJSON.message);

                setTimeout(function() {
					toastr.options = {
						closeButton: true,
						progressBar: true,
						showMethod: 'slideDown',
						timeOut: 4000
					};
				toastr.error(error.responseJSON.message);

				}, 1300);

            }

        });
	}

	/***generteOrder***/
	function generteOrder() {

var prescriptiontextdata = $("#log").html();

// console.log(prescriptiontextdata);
// console.log(prescriptiontextdata.search("Rx"));
var TotalLength = prescriptiontextdata.length - 13; //13 minus for remove </pre></div>
var RxPosition = prescriptiontextdata.search("Rx")+3; //3 plus for remove Rx

/*
Rx
Geston 5mg
1+0+1 3 months
Zifolet 20mg
0+1+0 1 month
Sergel 20mg
1+0+1 1 month
</pre></div>*/

var MedicineText = prescriptiontextdata.substring(RxPosition,TotalLength);

const MedicineTextList = MedicineText.split('\n');
// console.log(MedicineTextList);
// console.log(MedicineText);

		 $.ajax({
	        type: "post",
	        url: SITEURL+"/orderGenerateRoute",
	        // data: MedicineTextList,
	         datatype:"json",
            data: {
            	"MedicineTextList":MedicineTextList,
        		"_token":$('meta[name="csrf-token"]').attr('content')
    		},
	        success:function(response){
	        	console.log(response);
				
				var msg="";
	            // if($("#recordId").val() == "") {
	           	//     msg = "Data added successfully.";
	            // } else {
	           	    msg = "Order complete successfully.";
	            // }
				setTimeout(function() {
					toastr.options = {
						closeButton: true,
						progressBar: true,
						showMethod: 'slideDown',
						timeOut: 4000
					};
					toastr.success(msg);

				}, 1300);
	   			
	   			onListPanel();

	            $("#tableMain").dataTable().fnDraw();
				//////return Redirect::to("booktypeentry")->withSuccess('Great! Todo has been inserted');
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


/***  Payment confirm ***/
	function onConfirmWhenPayment() {

		var recordIdPayment = $("#recordIdPayment").val();
		$.ajax({
            type: "post",
            url: SITEURL+"/orderPaymentConfirmRoute",
            
            datatype:"json",
            data: {
            	"id":recordIdPayment,
        		"_token":$('meta[name="csrf-token"]').attr('content')
    		},
            success:function(response){

				var msg = "Payment complete successfully.";
				setTimeout(function() {
					toastr.options = {
						closeButton: true,
						progressBar: true,
						showMethod: 'slideDown',
						timeOut: 4000
					};
					toastr.success(msg);

				}, 1300);
				onListPanel();
                $("#tableMain").dataTable().fnDraw();
			},
            error:function(error){

                setTimeout(function() {
					toastr.options = {
						closeButton: true,
						progressBar: true,
						showMethod: 'slideDown',
						timeOut: 4000
					};
				toastr.error(error.responseJSON.message);

				}, 1300);

            }

        });
	}

 
	$(document).ready(function() {
		
		$('.chosen-select').chosen({width: "100%"});
		

		$('#btnAdd').on('click', function(){
			// resetForm("addeditform");
			recordId="";
			// $('#BlogType').val('').trigger("chosen:updated");
			// $('#Thumbnailrow').show();

			onFormPanelNewOrder();
		});
		
 


		$('#btnBack').on('click', function(){
			onListPanel();
		}); 
		
		$("#btnSubmit").click(function () {
	        $("#addeditform").submit();
	    });


	    $("#btnSubmitPayment").click(function () {
	        onConfirmWhenPayment();
	    });
 
 

	 	$("#fileUploadForm").on('submit',(function(e) {
			  e.preventDefault();
			  $.ajax({
			   url: SITEURL+"/fileUploadBlogRoute",
			   type: "POST",
			   data:  new FormData(this),
			   contentType: false,
			   cache: false,
			   processData:false,
			   beforeSend : function()
			   {
			   		//$("#err").fadeOut();
			   },
			   success: function(data)
			      {
					setTimeout(function() {
						toastr.options = {
							closeButton: true,
							progressBar: true,
							showMethod: 'slideDown',
							timeOut: 4000
						};
						toastr.success('Image uploaded successfully.');

					}, 1300);
					hidePopupFileUploadModal();
	                $("#tableMain").dataTable().fnDraw();

					$("#fileUploadForm")[0].reset(); 
			      },
			     error: function(e) 
			      {
		    	    setTimeout(function() {
						toastr.options = {
							closeButton: true,
							progressBar: true,
							showMethod: 'slideDown',
							timeOut: 4000
						};
					toastr.error("File cann't upload");

					}, 1300);
			      }          
			    });
		 }));



	getTableMainData();

	} );







    function getTableMainData(){
    	
		tableMain = $("#tableMain").dataTable({
		    "bFilter" : false,
		    "bDestroy": true,
			"bAutoWidth": false,
		    "bJQueryUI": true,      
		    "bSort" : false,
		    "bInfo" : false,
		    "bPaginate" : false,
		    "bSortClasses" : true,
		    "bProcessing" : true,
		    "bServerSide" : true,
		    "aaSorting" : [[2, 'asc']],
		    "aLengthMenu" : [[10, 25, 50, 100], [10, 25, 50, 100]],
		    "iDisplayLength" : 10,
		    "ajax":{
		        "url": "<?php route('orderplacetabledatafetch') ?>",
		        "datatype": "json",
		        "type": "post",
		        "data": {
		        	"_token":$('meta[name="csrf-token"]').attr('content')
		        }
		    },
		    "fnDrawCallback" : function(oSettings) {
	
		            if (oSettings.aiDisplay.length == 0) {
		                return;
		            }
		     

					$('a.itmPayment', tableMain.fnGetNodes()).each(function() {
		               
		                $(this).click(function() {

		                    var nTr = this.parentNode.parentNode;
		                    var aData = tableMain.fnGetData(nTr);
		                    
		                    $.confirm({
		                        title: 'Are you sure?!',
		                        content: 'Do you really want to payment?',
		                        icon: 'fa fa-question',
		                        theme: 'bootstrap',
		                        closeIcon: true,
		                        animation: 'scale',
		                        type: 'orange',
		                        buttons: {
		                            confirm: function () {
		                                
		                                resetForm("addeditformPayement");
		                                $('#recordIdPayment').val(aData['OrdersId']);
		                                $('#OrderDatePayment').val(aData['OrderDate']);
		                                $('#TotalPricePayment').val(aData['TotalPrice']);
		                             
		                                onFormPanelPayment();
		                            },
		                            cancel: function () {
		                            }
		                        }
		                    });
		                    
		                });
		            });









		            $('a.itmEdit', tableMain.fnGetNodes()).each(function() {
		               
		                $(this).click(function() {

		                    var nTr = this.parentNode.parentNode;
		                    var aData = tableMain.fnGetData(nTr);
		                    
		                    $.confirm({
		                        title: 'Are you sure?!',
		                        content: 'Do you really want to edit this data?',
		                        icon: 'fa fa-question',
		                        theme: 'bootstrap',
		                        closeIcon: true,
		                        animation: 'scale',
		                        type: 'orange',
		                        buttons: {
		                            confirm: function () {
		                                
		                               resetForm("addeditform");
		                                $('#recordId').val(aData['OrdersId']);
		                                $('#OrderDate').val(aData['OrderDate']);
		                                $('#CustomerName').val(aData['UserName']);
		                                $('#Phone').val(aData['Phone']);
		                                $('#TotalPrice').val(aData['TotalPrice']);
		                                $('#Payment').val(aData['IsPayment']);
		                                $('#Address').val(aData['Address']);
		                              
		                                onFormPanel();
		                                getTableSubData(aData['OrdersId']);
		                            },
		                            cancel: function () {
		                            }
		                        }
		                    });
		                    
		                });
		            });

					// $('a.fileUpload', tableMain.fnGetNodes()).each(function() {
		               
		   //              $(this).click(function() {
							
					// 		var nTr = this.parentNode.parentNode;
		   //                  var aData = tableMain.fnGetData(nTr);

					// 		$('#idFileUp').val(aData['BlogId']);
					// 		showPopupFileUploadModal();
		                    
		   //              });
		   //          });
		            $('a.itmDrop', tableMain.fnGetNodes()).each(function() {

		                $(this).click(function() {

		                    var nTr = this.parentNode.parentNode;
		                    var aData = tableMain.fnGetData(nTr);

		                    $.confirm({
		                    title: 'Are you sure?!',
		                    content: 'Do you really want to delete this data?',
		                    icon: 'fa fa-question',
		                    theme: 'bootstrap',
		                    closeIcon: true,
		                    animation: 'scale',
		                    type: 'red',
		                    buttons: {
		                        confirm: function () {
		                            onConfirmWhenDelete(aData['OrdersId']);
		                        },
		                        cancel: function () {
		                            //$.alert('Canceled!');
		                        }
		                    }
		                });

		                });
		            });
		        },
		    "columns":[
		        {"data":"OrdersId","bVisible" : false},
		        {"data":"Serial","sWidth": "5%", "sClass": "align-center", "bSortable": false},
		        {"data":"OrderDate","sWidth": "25%"},
		        {"data":"TotalPrice","sWidth": "15%", "sClass": "align-right"},
		        {"data":"IsPayment","sWidth": "15%", "sClass": "align-center"},
		        {"data":"Status","sWidth": "20%"},
		        {"data":"action","sWidth": "20%", "sClass": "align-center", "bSortable": false},
		        // {"data":"Thumbnail", "bVisible": false}
		    ]
		});
    }





    function getTableSubData(pOrderId){
    	// alert(pOrderId);

		$.ajax({
	        type: "post",
	        url: SITEURL+"/ordersItems",
	        data: {
	        	"OrdersId":pOrderId,
	    		"_token":$('meta[name="csrf-token"]').attr('content')
	    	},
	        success:function(response){
					response = JSON.parse(response);
					console.log(response);
					$('#tableSub').DataTable( {
						bDestroy: true,
						colReorder: true,
						bPaginate : false,
						bInfo : false,
						bSort: false,
						order: [],
						colReorder: true,
						lengthChange: true,
						aLengthMenu : [[25, 50, 100,-1], [25, 50, 100,"All"]],
						iDisplayLength : 25,
						searching: false,
						aoColumns:[{"title":"Sl","className": "align-center"},{"title":"Medicine Name"},{"title":"Unit"},{"title":"Qty","className": "align-right"},{"title":"Unit Price","className": "align-right"},{"title":"Total Price","className": "align-right"}],
						data: response
						// data: [["11",22,33,44,55],["11",22,33,44,55]]
					});


	        }

	    });

    }

function exportExcel(){
	//window.open("./custom_script/report/booklist_excel.php?fDepartmentId="+$("#fDepartmentId").val());
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



/* start Modal css*/
.popupModal {
	display: none; 
	position: fixed; 
	z-index: 999; 
	padding-top: 100px;
	left: 0;
	top: 0;
	width: 100%; 
	height: 100%; 
	overflow: auto; 
	background-color: rgb(0,0,0); 
	background-color: rgba(0,0,0,0.4);
}
.modal-header{
	background: #c6da89;
}
.font-white {
    color: white !important;
}
</style>


 @endsection