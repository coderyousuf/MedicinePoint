
@extends('masterlayout')

@section('titlename') Order List @endsection

@section('maincontent')
	

		<!-- Section -->
		<section class="bg-section ysuccess pt-10 pb-10" data-black-overlay="8" style="background-image: url({{ asset('public/images/background/bg-2.jpg') }})">
			<div class="container">
				<div class="row align-items-center">
					<div class="col-lg-7">
						<i class="fa fa-home white"></i> <span> / Admin / Order List</span>	
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
								<!--<button class="btn btn-success" id="btnExport" onclick="exportExcel();"><i class="fa fa-file-excel-o"></i> Excel</button>-->
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-12">	
							<table id="tableMain" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th style="display:none;">OrdersId</th>
										<th>Sl</th>
										<th>Date</th>
										<th>Total Price</th>
										<th>Customer Name</th>
										<th>Phone</th>
										<th>Address</th>
										<th>Payment</th>
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
				 
			</div>
		</section>

 @endsection


@section('customjs')
<script>
	var tableMain, tableSub;
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

/***  Request accept***/
	function onConfirmWhenOrderAccpet(recordId) {

		$.ajax({
            type: "post",
            url: SITEURL+"/orderRequestAcceptRoute",
            
            datatype:"json",
            data: {
            	"id":recordId,
        		"_token":$('meta[name="csrf-token"]').attr('content')
    		},
            success:function(response){

				var msg = "Order accepted successfully.";
				setTimeout(function() {
					toastr.options = {
						closeButton: true,
						progressBar: true,
						showMethod: 'slideDown',
						timeOut: 4000
					};
					toastr.success(msg);

				}, 1300);
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


/***  Request Delivery***/
	function onConfirmWhenOrderDelivery(recordId) {

		$.ajax({
            type: "post",
            url: SITEURL+"/orderRequestDeliveryRoute",
            
            datatype:"json",
            data: {
            	"id":recordId,
        		"_token":$('meta[name="csrf-token"]').attr('content')
    		},
            success:function(response){

				var msg = "Order delivery successfully.";
				setTimeout(function() {
					toastr.options = {
						closeButton: true,
						progressBar: true,
						showMethod: 'slideDown',
						timeOut: 4000
					};
					toastr.success(msg);

				}, 1300);
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

/***  Order Cancel***/
	function onConfirmWhenOrderCancel(recordId) {

		$.ajax({
            type: "post",
            url: SITEURL+"/orderRequestCancelRoute",
            
            datatype:"json",
            data: {
            	"id":recordId,
        		"_token":$('meta[name="csrf-token"]').attr('content')
    		},
            success:function(response){

				var msg = "Order cancelled successfully.";
				setTimeout(function() {
					toastr.options = {
						closeButton: true,
						progressBar: true,
						showMethod: 'slideDown',
						timeOut: 4000
					};
					toastr.success(msg);

				}, 1300);
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
		
		getTableMainData();

		$('#btnBack').on('click', function(){
			onListPanel();
		}); 
		

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
		        "url": "<?php route('orderslisttabledatafetch') ?>",
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
 
		             $('a.itemApprove', tableMain.fnGetNodes()).each(function() {

		                $(this).click(function() {

		                    var nTr = this.parentNode.parentNode;
		                    var aData = tableMain.fnGetData(nTr);

		                    $.confirm({
		                    title: 'Are you sure?!',
		                    content: 'Do you really want to accpet this order?',
		                    icon: 'fa fa-question',
		                    theme: 'bootstrap',
		                    closeIcon: true,
		                    animation: 'scale',
		                    type: 'red',
		                    buttons: {
		                        confirm: function () {
		                            onConfirmWhenOrderAccpet(aData['OrdersId']);
		                        },
		                        cancel: function () {
		                            //$.alert('Canceled!');
		                        }
		                    }
		                });

		                });
		            });

		             $('a.itemDelivery', tableMain.fnGetNodes()).each(function() {

		                $(this).click(function() {

		                    var nTr = this.parentNode.parentNode;
		                    var aData = tableMain.fnGetData(nTr);

		                    $.confirm({
		                    title: 'Are you sure?!',
		                    content: 'Do you really want to delivery this order?',
		                    icon: 'fa fa-question',
		                    theme: 'bootstrap',
		                    closeIcon: true,
		                    animation: 'scale',
		                    type: 'red',
		                    buttons: {
		                        confirm: function () {
		                            onConfirmWhenOrderDelivery(aData['OrdersId']);
		                        },
		                        cancel: function () {
		                            //$.alert('Canceled!');
		                        }
		                    }
		                });

		                });
		            });


		             $('a.itemCancel', tableMain.fnGetNodes()).each(function() {

		                $(this).click(function() {

		                    var nTr = this.parentNode.parentNode;
		                    var aData = tableMain.fnGetData(nTr);

		                    $.confirm({
		                    title: 'Are you sure?!',
		                    content: 'Do you really want to cancel this order?',
		                    icon: 'fa fa-question',
		                    theme: 'bootstrap',
		                    closeIcon: true,
		                    animation: 'scale',
		                    type: 'red',
		                    buttons: {
		                        confirm: function () {
		                            onConfirmWhenOrderCancel(aData['OrdersId']);
		                        },
		                        cancel: function () {
		                            //$.alert('Canceled!');
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
		                        content: 'Do you really want to show details?',
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
		                                //$.alert('Canceled!');
		                            }
		                        }
		                    });
		                    
		                });
		            });


		        },
		    "columns":[
		        {"data":"OrdersId","bVisible" : false},
		        {"data":"Serial","sWidth": "4%", "sClass": "align-center", "bSortable": false},
		        {"data":"OrderDate","sWidth": "10%"},
		        {"data":"TotalPrice","sWidth": "8%", "sClass": "align-right"},
		        {"data":"UserName","sWidth": "18%"},
		        {"data":"Phone","sWidth": "10%"},
		        {"data":"Address","sWidth": "34%"},
		        {"data":"IsPayment","sWidth": "8%", "sClass": "align-center"},
		        {"data":"action","sWidth": "8%", "sClass": "align-center", "bSortable": false},
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

/*
    	
		tableSub = $("#tableSub").dataTable({
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
		        "url": "<?php //route('ordersitemtabledatafetch') ?>",
		        "datatype": "json",
		        "type": "post",
		        "data": {
		        	"_token":$('meta[name="csrf-token"]').attr('content'),
		        	"OrdersId":pOrderId
		        }
		    },
		    "fnDrawCallback" : function(oSettings) {
	
		            if (oSettings.aiDisplay.length == 0) {
		                return;
		            }

		        },
		    "columns":[
		        {"data":"OrdersItemId","bVisible" : false},
		        {"data":"Serial","sWidth": "4%", "sClass": "align-center", "bSortable": false},
		        {"data":"ProductName","sWidth": "50%"},
		        {"data":"CategoryName","sWidth": "15%"},
		        {"data":"Qty","sWidth": "10%", "sClass": "align-right"},
		        {"data":"UnitPrice","sWidth": "10%", "sClass": "align-right"},
		        {"data":"TotalPrice","sWidth": "10%", "sClass": "align-right"},
		    ]
		});
		*/
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



</style>


 @endsection