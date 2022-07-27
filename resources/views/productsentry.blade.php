
@extends('masterlayout')

@section('titlename') Medicine Entry @endsection

@section('maincontent')
	

		<!-- Section -->
		<section class="bg-section ysuccess pt-10 pb-10" data-black-overlay="8" style="background-image: url({{ asset('public/images/background/bg-2.jpg') }})">
			<div class="container">
				<div class="row align-items-center">
					<div class="col-lg-7">
						<i class="fa fa-home white"></i> <span> / Admin / Medicine Entry</span>	
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

				<div id="listpanel">
				
					<div class="row">
						<label class="col-lg-1 col-form-label"></label>
						<div class="col-lg-3 form-group">
							<div class="form-group">												
								
							</div>
						</div>
						<div class="col-lg-8 form-group">
							<div class="pull-right">
								<button class="btn btn-primary" id="btnAdd"><i class="fa fa-plus"></i> Add</button>
								<!--<button class="btn btn-success" id="btnExport" onclick="exportExcel();"><i class="fa fa-file-excel-o"></i> Excel</button>-->
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-12">	
							<table id="tableMain" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th style="display:none;">ProductId</th>
										<th>Serial</th>
										<th>Medicine Name</th>
										<th>Unit</th>
										<th>Price</th>
										<th>Stock</th>
										<th>Description</th>
										<th>Action</th>
										<th style="display:none;">ProdCatId</th>
										<th style="display:none;">ImageURL</th>
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

											

											<div class="col-md-8">
												<div class="form-group">
													<label>Medicine Name<span class="red">*</span></label>
													<input type="text" class="form-control parsley-validated" name="ProductName" id="ProductName" data-required="true" placeholder="Enter Medicine Name">
												</div>
											</div>

											<div class="col-md-4">
												<div class="form-group">
													<label>Medicine Unit<span class="red">*</span></label>													
													<select data-placeholder="Choose Medicine Unit..." class="chosen-select" id="ProdCatId" name="ProdCatId" required>
														<option value="">Select Unit</option>
													</select>
												</div>											
											</div>
											
										</div>

										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>Price (Per Unit)<span class="red">*</span></label>
													<input type="text" class="form-control" name="Price" id="Price" data-required="true" placeholder="Enter Price">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Stock<span class="red">*</span></label>
													<input type="text" class="form-control" name="Availability" id="Availability" data-required="true" placeholder="Enter Stock">
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<label>Description</label>
													<input type="text" class="form-control" name="Remarks" id="Remarks" placeholder="Enter Short Description">
												</div>
											</div>
										</div>

										<div class="form-group row">
											<div class="col align-self-center">
												<input type="text" id="recordId" name="recordId" style="display:none;">
												<a href="javascript:void(0)" class="btn btn-primary btn-sm" id="btnSubmit"><i class="fa fa-save"></i> Save</a>
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
			        <h5 class="modal-title" id="exampleModalLabel">Product Image</h5>
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
	var tableMain;
 	var SITEURL = '{{URL::to('')}}';

	/***Hide entry form and show table***/
	function onListPanel(){
		$("#formpanel").hide();
		$("#listpanel").show();
	}
	/***Hide table and show entry form***/
	function onFormPanel(){
		$("#listpanel").hide();
		$("#formpanel").show();
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
	        url: SITEURL+"/addEditProductsRoute",
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
            url: SITEURL+"/deleteProductsRoute",
            
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



function getProductCategoryList() {

	    $.ajax({
	        type: "post",
	        url: SITEURL+"/getProductCategoryListRoute",
	        data: {
	        	"id":1,
        		"_token":$('meta[name="csrf-token"]').attr('content')
        	},
	        success:function(response){				
				$.each(response, function(i, obj) {
					$("#ProdCatId").append($('<option></option>').val(obj.ProdCatId).html(obj.CategoryName));
					
				});
				$("#ProdCatId").trigger("chosen:updated");
				 
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
		
		getProductCategoryList();

		$('#btnAdd').on('click', function(){
			resetForm("addeditform");
			recordId="";
			$('#ProdCatId').val('').trigger("chosen:updated");

			onFormPanel();
		});
		
		$('#btnBack').on('click', function(){
			onListPanel();
		}); 
		
		$("#btnSubmit").click(function () {
	        $("#addeditform").submit();
	    });
 

	 	$("#fileUploadForm").on('submit',(function(e) {
			  e.preventDefault();
			  $.ajax({
			   url: SITEURL+"/fileUploadProductRoute",
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
		    "bFilter" : true,
		    "bDestroy": true,
			"bAutoWidth": false,
		    "bJQueryUI": true,      
		    "bSort" : false,
		    "bInfo" : true,
		    "bPaginate" : true,
		    "bSortClasses" : true,
		    "bProcessing" : true,
		    "bServerSide" : true,
		    "aaSorting" : [[2, 'asc']],
		    "aLengthMenu" : [[10, 25, 50, 100], [10, 25, 50, 100]],
		    "iDisplayLength" : 10,
		    "ajax":{
		        "url": "<?php route('productstabledatafetch') ?>",
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
		                                $('#recordId').val(aData['ProductId']);
		                                $('#CategoryName').val(aData['CategoryName']);
		                                $('#ProductName').val(aData['ProductName']);
		                                $('#Price').val(aData['Price']);
		                                $('#Availability').val(aData['Availability']);
		                                $('#Remarks').val(aData['Remarks']);
		                                
		                                $('#ProdCatId').val(aData['ProdCatId']).trigger("chosen:updated");
		                            
		                                onFormPanel();
		                                //$.alert('Confirmed!');
		                            },
		                            cancel: function () {
		                                //$.alert('Canceled!');
		                            }
		                        }
		                    });
		                    
		                });
		            });

					$('a.fileUpload', tableMain.fnGetNodes()).each(function() {
		               
		                $(this).click(function() {
							
							var nTr = this.parentNode.parentNode;
		                    var aData = tableMain.fnGetData(nTr);

							$('#idFileUp').val(aData['ProductId']);
							showPopupFileUploadModal();
		                    
		                });
		            });
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
		                            onConfirmWhenDelete(aData['ProductId']);
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
		        {"data":"ProductId","bVisible" : false},
		        {"data":"Serial","sWidth": "5%", "sClass": "align-center", "bSortable": false},
		        {"data":"ProductName","sWidth": "20%"},
		         {"data":"CategoryName","sWidth": "15%"},
		        {"data":"Price","sWidth": "10%", "sClass": "align-right"},
		        {"data":"Availability","sWidth": "10%", "sClass": "align-right"},
		        {"data":"Remarks","sWidth": "30%"},
		        {"data":"action","sWidth": "10%", "sClass": "align-center", "bSortable": false},
		        {"data":"ProdCatId", "bVisible": false},
		        {"data":"ImageURL", "bVisible": false}
		    ]
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