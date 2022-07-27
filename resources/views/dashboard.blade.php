
@extends('masterlayout')

@section('titlename') Dashboard @endsection

@section('maincontent')
	

		<!-- Section -->
		<section class="bg-section ysuccess pt-10 pb-10" data-black-overlay="8" style="background-image: url({{ asset('public/images/background/bg-2.jpg') }})">
			<div class="container">
				<div class="row align-items-center">
					<div class="col-lg-7">
						<i class="fa fa-home white"></i> <span> / Dashboard</span>	
					</div>
					<div class="col-lg-5 align-right">
						<!--<a class="notification-ico" href="{{ url('postview') }}"><i class="fa fa-bell"></i> <sup><span id="notificationcount"></span></sup></a>-->
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

				<div class="row">
					<div class="col-lg-2">
						<div class="ibox ">
							<div class="ibox-content">
								<h1 class="no-margins" id="totalTeachers">5</h1>
								<span class="no-margins">Pending Orders</span>
							</div>
						</div>
					</div>
					<div class="col-lg-3">
						<div class="ibox">
							<div class="ibox-content">
								<h1 class="no-margins" id="totalStudents">7</h1>
								<span class="no-margins">Wait for Delivery</span>
							</div>
						</div>
					</div>
					<div class="col-lg-3">
						<div class="ibox">
							<div class="ibox-content">
								<h1 class="no-margins" id="totalMembers">2</h1>
								<span class="no-margins">Wait for Payment</span>
							</div>
						</div>
					</div>

					
					<div class="col-lg-2">
						<div class="ibox">
							<div class="ibox-content">
								<h1 class="no-margins" id="totalBooksinField">3</h1>
								<span>Canceled</span>
							</div>
						</div>
					</div>

					<div class="col-lg-2">
						<div class="ibox">
							<div class="ibox-content">
								<h1 class="no-margins" id="totalBookPending">8</h1>
								<span>Total Medicine</span>
							</div>
						</div>
					</div>
				</div>


				<div class="row">
					<div class="col-lg-6">
						<div class="ibox-content">
							<div id="receivetrendbymonth"></div>
						</div>
					</div>

					<div class="col-lg-6">
						<div class="ibox-content">
							<div id="deliverytrendbymonth"></div>
						</div>
					</div>
				</div>	

				
			</div>
		</section>

		

 @endsection

@section('extralibincludefooter')
   <!-- Highchart -->
	<script src="{{ asset('public/js/highcharts.js') }}" crossorigin="anonymous"></script>
	<script src="{{ asset('public/js/highcharts-more.js') }}" crossorigin="anonymous"></script>
	
	<script src="{{ asset('public/js/exporting.js') }}" crossorigin="anonymous"></script>
@endsection


@section('customjs')
<script>
	var tableMain;
 	var SITEURL = '{{URL::to('')}}';




	function getReceiveTrendData(){


		$.ajax({
	        type: "post",
	        url: SITEURL+"/getReceiveTrendDataRoute",
	        data: {
	        	"id":1,
	    		"_token":$('meta[name="csrf-token"]').attr('content')
	    	},
	        success:function(response){


				$("#receivetrendbymonth").highcharts({
				chart: {
						type: "spline",
						height:350
					},
				title: {
					text: "Sales Amount Trend by Year-Month"
				},
				// subtitle: {
					// text: $("#StartDate").val()+" to "+$("#EndDate").val()+" and Accounts Head: "+$('#CarId').find(":selected").text()
				// },
				yAxis: {
					//gridLineWidth: 0,
					title: {
						text: 'Amount (TK)'
					}
				},
				xAxis: {
					categories: ["Oct 21", "Nov 21", "Dec 21", "Jan 2022"]
					//categories: response.category
					,labels: {
								 //enabled:false,//default is true
								 y : 20, rotation: -45, align: 'right' 
							}
				},
				legend: {
					layout: 'horizontal'
				},
				credits: {
						enabled: false
					},
				exporting: {
						filename: "Sales_Amount_Trend_by_Year_Month"
					},
				tooltip: {
					shared: true,
					crosshairs: true
				},
				plotOptions: {
					series: {
						label: {
							connectorAllowed: false
						},
						marker: {
							//fillColor: '#FFFFFF',
							lineWidth: 1//,
							//lineColor: null // inherit from series
						}
					}
				},
				// series: response.series
				series: [{"name":"Sales","data":[15000,17500,14000,20000],"color":"green"}]
			});


	        },
	        error:function(error){
	            setTimeout(function() {
					toastr.options = {
						closeButton: true,
						progressBar: true,
						showMethod: 'slideDown',
						timeOut: 4000
					};
				toastr.error("Can not fillup");

				}, 1300);

	        }

	    });


	}

	function getDeliveryTrendData(){

		Highcharts.chart('deliverytrendbymonth', {
    chart: {
        type: 'packedbubble',
        height: '100%'
    },
    title: {
        text: 'Carbon emissions around the world (2014)'
    },
    tooltip: {
        useHTML: true,
        pointFormat: '<b>{point.name}:</b> {point.value}m CO<sub>2</sub>'
    },
    plotOptions: {
        packedbubble: {
            minSize: '30%',
            maxSize: '120%',
            zMin: 0,
            zMax: 1000,
            layoutAlgorithm: {
                splitSeries: false,
                gravitationalConstant: 0.02
            },
            dataLabels: {
                enabled: true,
                format: '{point.name}',
                filter: {
                    property: 'y',
                    operator: '>',
                    value: 250
                },
                style: {
                    color: 'black',
                    textOutline: 'none',
                    fontWeight: 'normal'
                }
            }
        }
    },
    series: [{
        name: 'Europe',
        data: [{
            name: 'Germany',
            value: 767.1
        }, {
            name: 'Croatia',
            value: 20.7
        },
        {
            name: "Belgium",
            value: 97.2
        },
        {
            name: "Czech Republic",
            value: 111.7
        },
        {
            name: "Netherlands",
            value: 158.1
        },
        {
            name: "Spain",
            value: 241.6
        },
        {
            name: "Ukraine",
            value: 249.1
        },
        {
            name: "Poland",
            value: 298.1
        },
        {
            name: "France",
            value: 323.7
        },
        {
            name: "Romania",
            value: 78.3
        },
        {
            name: "United Kingdom",
            value: 415.4
        }, {
            name: "Turkey",
            value: 353.2
        }, {
            name: "Italy",
            value: 337.6
        },
        {
            name: "Greece",
            value: 71.1
        },
        {
            name: "Austria",
            value: 69.8
        },
        {
            name: "Belarus",
            value: 67.7
        },
        {
            name: "Serbia",
            value: 59.3
        },
        {
            name: "Finland",
            value: 54.8
        },
        {
            name: "Bulgaria",
            value: 51.2
        },
        {
            name: "Portugal",
            value: 48.3
        },
        {
            name: "Norway",
            value: 44.4
        },
        {
            name: "Sweden",
            value: 44.3
        },
        {
            name: "Hungary",
            value: 43.7
        },
        {
            name: "Switzerland",
            value: 40.2
        },
        {
            name: "Denmark",
            value: 40
        },
        {
            name: "Slovakia",
            value: 34.7
        },
        {
            name: "Ireland",
            value: 34.6
        },
        {
            name: "Croatia",
            value: 20.7
        },
        {
            name: "Estonia",
            value: 19.4
        },
        {
            name: "Slovenia",
            value: 16.7
        },
        {
            name: "Lithuania",
            value: 12.3
        },
        {
            name: "Luxembourg",
            value: 10.4
        },
        {
            name: "Macedonia",
            value: 9.5
        },
        {
            name: "Moldova",
            value: 7.8
        },
        {
            name: "Latvia",
            value: 7.5
        },
        {
            name: "Cyprus",
            value: 7.2
        }]
    }, {
        name: 'Africa',
        data: [{
            name: "Senegal",
            value: 8.2
        },
        {
            name: "Cameroon",
            value: 9.2
        },
        {
            name: "Zimbabwe",
            value: 13.1
        },
        {
            name: "Ghana",
            value: 14.1
        },
        {
            name: "Kenya",
            value: 14.1
        },
        {
            name: "Sudan",
            value: 17.3
        },
        {
            name: "Tunisia",
            value: 24.3
        },
        {
            name: "Angola",
            value: 25
        },
        {
            name: "Libya",
            value: 50.6
        },
        {
            name: "Ivory Coast",
            value: 7.3
        },
        {
            name: "Morocco",
            value: 60.7
        },
        {
            name: "Ethiopia",
            value: 8.9
        },
        {
            name: "United Republic of Tanzania",
            value: 9.1
        },
        {
            name: "Nigeria",
            value: 93.9
        },
        {
            name: "South Africa",
            value: 392.7
        }, {
            name: "Egypt",
            value: 225.1
        }, {
            name: "Algeria",
            value: 141.5
        }]
    }, {
        name: 'Oceania',
        data: [{
            name: "Australia",
            value: 409.4
        },
        {
            name: "New Zealand",
            value: 34.1
        },
        {
            name: "Papua New Guinea",
            value: 7.1
        }]
    }, {
        name: 'North America',
        data: [{
            name: "Costa Rica",
            value: 7.6
        },
        {
            name: "Honduras",
            value: 8.4
        },
        {
            name: "Jamaica",
            value: 8.3
        },
        {
            name: "Panama",
            value: 10.2
        },
        {
            name: "Guatemala",
            value: 12
        },
        {
            name: "Dominican Republic",
            value: 23.4
        },
        {
            name: "Cuba",
            value: 30.2
        },
        {
            name: "USA",
            value: 5334.5
        }, {
            name: "Canada",
            value: 566
        }, {
            name: "Mexico",
            value: 456.3
        }]
    }, {
        name: 'South America',
        data: [{
            name: "El Salvador",
            value: 7.2
        },
        {
            name: "Uruguay",
            value: 8.1
        },
        {
            name: "Bolivia",
            value: 17.8
        },
        {
            name: "Trinidad and Tobago",
            value: 34
        },
        {
            name: "Ecuador",
            value: 43
        },
        {
            name: "Chile",
            value: 78.6
        },
        {
            name: "Peru",
            value: 52
        },
        {
            name: "Colombia",
            value: 74.1
        },
        {
            name: "Brazil",
            value: 501.1
        }, {
            name: "Argentina",
            value: 199
        },
        {
            name: "Venezuela",
            value: 195.2
        }]
    }, {
        name: 'Asia',
        data: [{
            name: "Nepal",
            value: 6.5
        },
        {
            name: "Georgia",
            value: 6.5
        },
        {
            name: "Brunei Darussalam",
            value: 7.4
        },
        {
            name: "Kyrgyzstan",
            value: 7.4
        },
        {
            name: "Afghanistan",
            value: 7.9
        },
        {
            name: "Myanmar",
            value: 9.1
        },
        {
            name: "Mongolia",
            value: 14.7
        },
        {
            name: "Sri Lanka",
            value: 16.6
        },
        {
            name: "Bahrain",
            value: 20.5
        },
        {
            name: "Yemen",
            value: 22.6
        },
        {
            name: "Jordan",
            value: 22.3
        },
        {
            name: "Lebanon",
            value: 21.1
        },
        {
            name: "Azerbaijan",
            value: 31.7
        },
        {
            name: "Singapore",
            value: 47.8
        },
        {
            name: "Hong Kong",
            value: 49.9
        },
        {
            name: "Syria",
            value: 52.7
        },
        {
            name: "DPR Korea",
            value: 59.9
        },
        {
            name: "Israel",
            value: 64.8
        },
        {
            name: "Turkmenistan",
            value: 70.6
        },
        {
            name: "Oman",
            value: 74.3
        },
        {
            name: "Qatar",
            value: 88.8
        },
        {
            name: "Philippines",
            value: 96.9
        },
        {
            name: "Kuwait",
            value: 98.6
        },
        {
            name: "Uzbekistan",
            value: 122.6
        },
        {
            name: "Iraq",
            value: 139.9
        },
        {
            name: "Pakistan",
            value: 158.1
        },
        {
            name: "Vietnam",
            value: 190.2
        },
        {
            name: "United Arab Emirates",
            value: 201.1
        },
        {
            name: "Malaysia",
            value: 227.5
        },
        {
            name: "Kazakhstan",
            value: 236.2
        },
        {
            name: "Thailand",
            value: 272
        },
        {
            name: "Taiwan",
            value: 276.7
        },
        {
            name: "Indonesia",
            value: 453
        },
        {
            name: "Saudi Arabia",
            value: 494.8
        },
        {
            name: "Japan",
            value: 1278.9
        },
        {
            name: "China",
            value: 10540.8
        },
        {
            name: "India",
            value: 2341.9
        },
        {
            name: "Russia",
            value: 1766.4
        },
        {
            name: "Iran",
            value: 618.2
        },
        {
            name: "Korea",
            value: 610.1
        }]
    }]
});


/*
		$.ajax({
	        type: "post",
	        url: SITEURL+"/getDeliveryTrendDataRoute",
	        data: {
	        	"id":1,
	    		"_token":$('meta[name="csrf-token"]').attr('content')
	    	},
	        success:function(response){


				$("#deliverytrendbymonth").highcharts({
				chart: {
						type: "spline",
						height:350
					},
				title: {
					text: "Delivery by Year-Month"
				},
				// subtitle: {
					// text: $("#StartDate").val()+" to "+$("#EndDate").val()+" and Accounts Head: "+$('#CarId').find(":selected").text()
				// },
				yAxis: {
					//gridLineWidth: 0,
					title: {
						text: 'Qty (KG)'
					}
				},
				xAxis: {
					// categories: ["1 Aug 18", "2 Aug 18", "3 Aug 18", "4 Aug 18", "5 Aug 18", "6 Aug 18", "7 Aug 18", "8 Aug 18"]
					categories: response.category
					,labels: {
								 //enabled:false,//default is true
								 y : 20, rotation: -45, align: 'right' 
							}
				},
				legend: {
					layout: 'horizontal'
				},
				credits: {
						enabled: false
					},
				exporting: {
						filename: "Delivery_by_Year_Month"
					},
				tooltip: {
					shared: true,
					crosshairs: true
				},
				plotOptions: {
					series: {
						label: {
							connectorAllowed: false
						},
						marker: {
							//fillColor: '#FFFFFF',
							lineWidth: 1//,
							//lineColor: null // inherit from series
						}
					}
				},
				series: response.series
			});


	        },
	        error:function(error){
	            setTimeout(function() {
					toastr.options = {
						closeButton: true,
						progressBar: true,
						showMethod: 'slideDown',
						timeOut: 4000
					};
				toastr.error("Can not fillup");

				}, 1300);

	        }

	    });

*/
	}


function getDashboardBasicInfo() {

	    $.ajax({
	        type: "post",
	        url: SITEURL+"/getDashboardBasicInfoRoute",
	        data: {
	        	"id":1,
        		"_token":$('meta[name="csrf-token"]').attr('content')
        	},
	        success:function(response){
				$("#totalTeachers").html(response.gTeachersCount);
				$("#totalStudents").html(response.gStudentCount);
				$("#totalMembers").html(response.gMemberCount);
				$("#totalBooksinField").html(response.gBooksinFieldCount);
				$("#totalBookPending").html(response.gBookPendingCount);
	        },
	        error:function(error){
	            setTimeout(function() {
					toastr.options = {
						closeButton: true,
						progressBar: true,
						showMethod: 'slideDown',
						timeOut: 4000
					};
				toastr.error("Can not fillup");

				}, 1300);

	        }

	    });
	}

	$(document).ready(function() {
		
		//getDashboardBasicInfo();
		getReceiveTrendData();
		getDeliveryTrendData();

	} );

</script>

<style>
.ibox {
	clear: both;
	margin-bottom: 25px;
	margin-top: 0;
	padding: 0;
}

.ibox-content {
	clear: both;
}
.ibox-content {
	background-color: darkcyan;
	color: white;
	padding: 15px 20px 20px 20px;
	border-color: #e7eaec;
	border-image: none;
	border-style: solid solid none;
	border-width: 1px 0;
	text-align: center;
}

.ibox-content h1{
	color: white;
}
		
.font-white {
    color: white !important;
}

</style>


 @endsection