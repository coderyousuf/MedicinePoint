
@extends('masterlayout')

@section('titlename') My Products @endsection

@section('maincontent')
	

		<!-- Section -->
		<section class="bg-section ysuccess pt-10 pb-10" data-black-overlay="8" style="background-image: url({{ asset('public/images/background/bg-2.jpg') }})">
			<div class="container">
				<div class="row align-items-center">
					<div class="col-lg-7">
						<i class="fa fa-home white"></i> <span> / Farmer / My Products</span>	
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
								<button class="btn btn-success" id="btnExport" onclick="exportExcel();"><i class="fa fa-file-excel-o"></i> Excel</button>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-12">	
							<table id="tableMain" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th style="display:none;">FProductId</th>
										<th>Sl</th>
										<th>Reg Date</th>
										<th>Farmer Name</th>
										<th>Product Name</th>
										<th>Ability (Per day)</th>
										<th>Phone</th>
										<th>NID</th>
										<th>Address</th>
										<th>Status</th>
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

	$(document).ready(function() {
		
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
		        "url": "<?php route('farmerproductstabledatafetch') ?>",
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
		        },
		    "columns":[
		        {"data":"FProductId","bVisible" : false},
		        {"data":"Serial","sWidth": "4%", "sClass": "align-center", "bSortable": false},
		        {"data":"RegDate","sWidth": "10%"},
		        {"data":"FarmerName","sWidth": "14%"},
		        {"data":"ProductName","sWidth": "15%"},
		        {"data":"Availability","sWidth": "9%", "sClass": "align-right"},
		        {"data":"Phone","sWidth": "10%"},
		        {"data":"NID","sWidth": "10%"},
		        {"data":"Address","sWidth": "20%"},
		        {"data":"Status","sWidth": "8%"} 
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