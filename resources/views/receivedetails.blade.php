
@extends('masterlayout')

@section('titlename') Receive Details Report @endsection

@section('maincontent')
	

		<!-- Section -->
		<section class="bg-section ysuccess pt-10 pb-10" data-black-overlay="8" style="background-image: url({{ asset('public/images/background/bg-2.jpg') }})">
			<div class="container">
				<div class="row align-items-center">
					<div class="col-lg-7">
						<i class="fa fa-home white"></i> <span> / Report / Receive Details Report</span>	
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

					<div class="form-group row">
						<label class="col-lg-1 col-form-label">From</label>
						<div class="col-lg-2 daterangecontrol">
							<div class="input-daterange input-group">
								<input type="text" class="form-control-sm form-control" name="StartDate" id="StartDate" data-date-format="dd/mm/yyyy" />
							</div>										
						</div>
					
						<label class="col-lg-1 col-form-label">To</label>
						<div class="col-lg-2 daterangecontrol">
							<div class="input-daterange input-group">
								<input type="text" class="form-control-sm form-control" name="EndDate" id="EndDate" data-date-format="dd/mm/yyyy" />
							</div>
						</div>


						<label class="col-lg-1 col-form-label">Farmer</label>
						<div class="col-lg-2">
							<div class="input-group">
								<select data-placeholder="Choose Farmer Name..." class="chosen-select" id="FarmerId" name="FarmerId" required>
									<option value=0>All</option>
								</select>
							</div>
						</div>
					</div>

				
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
										<th>Serial</th>
										<th>Receive Date</th>
										<th>Farmer</th>
										<th>Product Name</th>
										<th>Receive Qty</th>
									</tr>
								</thead>
								<tbody>
								</tbody>				
							</table>
						</div>
					</div>
				</div>
				 
			</div>
		</section>

 @endsection


@section('customjs')
<script>
	var tableMain;
 	var SITEURL = '{{URL::to('')}}';

 	$('.daterangecontrol .input-daterange').datepicker({
				keyboardNavigation: false,
				forceParse: false,
				autoclose: true,
				format: 'yyyy/mm/dd'
				//format: 'dd/mm/yyyy'
			});

function getFarmerList() {

	    $.ajax({
	        type: "post",
	        url: SITEURL+"/getFarmerListRoute",
	        data: {
	        	"id":1,
        		"_token":$('meta[name="csrf-token"]').attr('content')
        	},
	        success:function(response){				
				$.each(response, function(i, obj) {
					$("#FarmerId").append($('<option></option>').val(obj.id).html(obj.name));
					
				});
				$("#FarmerId").trigger("chosen:updated");
				 
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
 


	var pstartdate;
	var penddate;
	var FarmerId = 0;

	$(document).ready(function() {
		getFarmerList();

		var date = new Date();
		pstartdate = new Date(date.getFullYear(), date.getMonth(), 1);
		penddate = new Date(date.getFullYear(), date.getMonth(), date.getDate());

		$('#StartDate').datepicker('setDate', pstartdate);
		$('#EndDate').datepicker('setDate', penddate);
		pstartdate = $("#StartDate").val();
		penddate = $("#EndDate").val();

		$("#StartDate").change(function () {
			pstartdate = $("#StartDate").val();
	        getTableMainData();
	    });

	    $("#EndDate").change(function () {
			penddate = $("#EndDate").val();
	        getTableMainData();
	    });

	    $("#FarmerId").change(function () {
			FarmerId = $("#FarmerId").val();
	        getTableMainData();
	    });

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
		        "url": "<?php route('receivedetailsstabledatafetch') ?>",
		        "datatype": "json",
		        "type": "post",
		        "data": {
		        	"_token":$('meta[name="csrf-token"]').attr('content'),		        	
		        	"StartDate":pstartdate,		        	
		        	"EndDate":penddate,
		        	"FarmerId":FarmerId
		        }
		    },
		    "fnDrawCallback" : function(oSettings) {
	
		            if (oSettings.aiDisplay.length == 0) {
		                return;
		            }
		        },
		    "columns":[
		        {"data":"Serial","sWidth": "5%", "sClass": "align-center", "bSortable": false},
		        {"data":"TransDate","sWidth": "20%"},
		        {"data":"FarmerName","sWidth": "35%"},
		        {"data":"ProductName","sWidth": "25%"},
		        {"data":"Qty","sWidth": "15%", "sClass": "align-right"}
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



</style>


 @endsection