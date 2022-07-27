<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect,Response;
use App\Orders;
use DB;
use Auth;
use Illuminate\Support\Facades\Http;
//use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class OrdersController extends Controller
{


	/* Menu: Admin / Order List */
	function getOrdersListData(Request $request){
		$search = $_POST['search']['value'];

		$rowTotalObj = DB::table('t_orders')
            ->join('users', 't_orders.UserId', '=', 'users.id')
            ->select(DB::raw('count(*) as rcount'))
	        ->where(function($query) use ($search)
	          {
	            if(!empty($search)):
	                $query->Where('users.name','like', '%' . $search . '%');
	               $query->orWhere('users.phone','like', '%' . $search . '%');
	               $query->orWhere('users.address','like', '%' . $search . '%');
	               $query->orWhere('t_orders.Status','like', '%' . $search . '%');
	            endif;
	          })
            ->get();

		$totalData = $rowTotalObj[0]->rcount;

		$limit = $_POST['length'];
		$start = $_POST['start'];

		$posts = DB::table('t_orders')
            ->join('t_ordersitems', 't_orders.OrdersId', '=', 't_ordersitems.OrdersId')
            ->join('users', 't_orders.UserId', '=', 'users.id')
            ->select(DB::raw('t_orders.OrdersId, t_orders.OrderDate, users.name, users.phone, users.address, t_orders.Status, t_orders.IsPayment, sum(t_ordersitems.TotalPrice) TotalPrice'))
	        ->where(function($query) use ($search)
	          {
	            if(!empty($search)):
	               $query->Where('users.name','like', '%' . $search . '%');
	               $query->orWhere('users.phone','like', '%' . $search . '%');
	               $query->orWhere('users.address','like', '%' . $search . '%');
	               $query->orWhere('t_orders.Status','like', '%' . $search . '%');
	            endif;
	          })
	        ->offset($start)
			->limit($limit)
			->groupByRaw('t_orders.OrdersId, t_orders.OrderDate, users.name, users.phone, users.address, t_orders.Status, t_orders.IsPayment')
			->orderByRaw("t_orders.OrderDate desc")
            ->get();

		$data = array();

		if($posts){

			$accept = "<a class='task-del itemApprove' style='margin-left:4px' href='javascript:void(0);'><span class='label label-primary'>Accept</span></a>";
			$delivered = "<a class='task-del itemDelivery' style='margin-left:4px' href='javascript:void(0);'><span class='label label-primary'>Delivery</span></a>";
			$cancel = "<a class='task-del itemCancel' style='margin-left:4px' href='javascript:void(0);'><span class='label label-danger'>Cancel</span></a>";
	
			$y = "<a class='task-del itmEdit' style='margin-left:4px' href='javascript:void(0);'><span class='label label-lemon'>View</span></a>";
			$z = "<a class='task-del itmEdit' style='margin-left:4px' href='javascript:void(0);'><span class='label label-lemon'>View</span></a>";
			
			$serial = $_POST['start'] + 1;
			foreach($posts as $r){

				$paymentStatus="No";
				if($r->IsPayment == 1){
					$paymentStatus="Yes";
				}

				$arr['OrdersId'] = $r->OrdersId;
				$arr['Serial'] = $serial++;
				$arr['OrderDate'] = $r->OrderDate;
				$arr['TotalPrice'] = $r->TotalPrice;
				$arr['UserName'] = $r->name;
				$arr['Phone'] = $r->phone;
				$arr['Address'] = $r->address;
				$arr['IsPayment'] = $paymentStatus;
				
			
				$arr['Status'] = $r->Status;

				if($r->Status == "Order"){
					$arr['action'] = $accept . $cancel . $y;
				}else if($r->Status == "Accept"){
					$arr['action'] = $delivered . $y;
				}else if($r->Status == "Delivered"){
					$arr['action'] =  "<span class='font-green'>Delivered</span>" . $z;
				}else if($r->Status == "Cancel"){
					$arr['action'] =  "<span class='font-red'>Cancel</span>" . $y;
				}
				
				$data[] = $arr;
			}
			/*1.Order, 2.Accept, 3.Delivered, 4.Cancel*/ 
			$json_data = array(
				"iTotalRecords"=> intval($totalData),
				"iTotalDisplayRecords"=> intval($totalData),
				"draw"=>intval($request->input('draw')),
				"recordsTotal"=> intval($totalData),
				"data"=>$data
			);

			echo json_encode($json_data);
		}
	}


    function getAllProductsData(Request $request){ 

    	$curDateTime = date ( 'Y-m-d' );

		$posts = DB::table('t_products')
				->select('t_products.*')
				->orderByRaw("ProductName asc")
				->get();

		$data = array();
		if($posts){
			foreach($posts as $r){


				$arr['ProductId'] = $r->ProductId;
				$arr['ProdCatId'] = $r->ProdCatId;
				$arr['ProductName'] = $r->ProductName;
				$arr['Price'] = $r->Price;
				$arr['ImageURL'] = $r->ImageURL;
				$arr['Remarks'] = $r->Remarks;
				$arr['Availability'] = $r->Availability;

				$StockStatus = "sold out";
				if($r->Availability>0)
					$StockStatus = "Stock In";

				$arr['StockStatus'] = $StockStatus;

				$data[] = $arr;
			}
		}

		return $data;
 
	}


	function getSingleProductForPlaceOrder(Request $request){ 
		$ProductId = $_POST['ProductId'];

		$posts = DB::table('t_products')
				->select('t_products.*')
				->where(function($query) use ($ProductId)
		          {
		            if($ProductId != 0):
		               $query->Where('t_products.ProductId','=', $ProductId);
		            endif;
		          })
				->get();

		return $posts;

	}

    public function submitOrder(Request $request){

		$currDateTime = date ( 'Y-m-d H:i:s' );

		$ProductId = $_POST['ProductId'];

		$UnitPrice = $_POST['UnitPrice'];
		$Quantity = $_POST['Quantity'];
		$TotalPrice = $_POST['TotalPrice'];

		$BuyerName = $_POST['BuyerName'];
		$Phone = $_POST['Phone'];
		$Address = $_POST['Address'];

		/*when PK already exist then  update otherwise insert*/
		//Status = Order, Accept, Delivered, Cancel 
		DB::table('t_orders_tmp')
		    ->Insert(

		        ['OrderDate' => $currDateTime, 
		        'TotalPrice' => $TotalPrice, 
		        'BuyerName' =>$BuyerName, 
		        'Phone' => $Phone, 
		        'Address' => $Address, 
		        'Status' => 'Order']		       
		    );


	    //get mysqli_insert_id
		$rowTotalObj = DB::table('t_orders_tmp')
                     ->select(DB::raw('max(OrdersId) as OrdersId'))
                     ->get();

		$OrdersId = $rowTotalObj[0]->OrdersId;

		DB::table('t_ordersitems_tmp')->insert(
					    ['OrdersId' => $OrdersId, 'ProductId' => $ProductId, 'Qty' => $Quantity, 'UnitPrice' => $UnitPrice, 'TotalPrice' => $TotalPrice]
					);

		echo $OrdersId;
    }

	
	/* Menu: Admin / Order List - show order details*/
	function getOrdersDetailsData(Request $request){
		$OrdersId = $_POST['OrdersId'];
		$posts = DB::table('t_ordersitems')
            ->join('t_products', 't_ordersitems.ProductId', '=', 't_products.ProductId')
            ->join('t_product_category', 't_products.ProdCatId', '=', 't_product_category.ProdCatId')
            ->select(DB::raw('t_ordersitems.OrdersItemId, t_ordersitems.OrdersId, 
            	t_ordersitems.ProductId, t_ordersitems.Qty, t_ordersitems.UnitPrice, 
            	t_ordersitems.TotalPrice, t_products.ProductName, t_product_category.CategoryName'))
			->where('OrdersId', '=', $OrdersId)
			->orderByRaw("t_products.ProductName desc")
            ->get();
 
		$data = array();

		if($posts){

			// $y = "<a class='task-del itmEdit' style='margin-left:4px' href='javascript:void(0);'><span class='label label-lemon'>Edit</span></a>";
			// $z = "<a class='task-del itmEdit' style='margin-left:4px' href='javascript:void(0);'><span class='label label-lemon'>View</span></a>";
			
			$serial = 1;
			foreach($posts as $r){
				$arr = array();
				// $arr['OrdersItemId'] = $r->OrdersItemId;
				// $arr['OrdersId'] = $r->OrdersId;
				// $arr['Serial'] = $serial++;
				// $arr['ProductName'] = $r->ProductName;
				// $arr['CategoryName'] = $r->CategoryName;
				// $arr['Qty'] = $r->Qty;
				// $arr['UnitPrice'] = $r->UnitPrice;
				// $arr['TotalPrice'] = $r->TotalPrice;

				$arr[] = $serial++;
				$arr[] = $r->ProductName;
				$arr[] = $r->CategoryName;
				$arr[] = $r->Qty;
				$arr[] = $r->UnitPrice;
				$arr[] = $r->TotalPrice;
				
				$data[] = $arr;
			}

			echo json_encode($data);
		}
	}



	/* / Admin / Order List	*/
	public function orderRequestAccept(Request $request){
	 	$id = $request->input("id");
	 	$currDateTime = date ( 'Y-m-d H:i:s' );

		$obj = DB::table('t_orders')
              ->where('OrdersId', $id)
              ->update(['Status' => 'Accept', 'ReadyOrCancellDate' => $currDateTime]);

		return Response::json($obj);
    }
/* / Admin / Order List	*/
    public function orderRequestDelivery(Request $request){
	 	$id = $request->input("id");
	 	$currDateTime = date ( 'Y-m-d H:i:s' );

		$obj = DB::table('t_orders')
              ->where('OrdersId', $id)
              ->update(['Status' => 'Delivered', 'ReadyOrCancellDate' => $currDateTime]);

		return Response::json($obj);
    }
/* / Admin / Order List	*/
	public function orderRequestCancel(Request $request){
	 	$id = $request->input("id");

		$obj = DB::table('t_orders')
              ->where('OrdersId', $id)
              ->update(['Status' => 'Cancel', 'ReadyOrCancellDate' => NULL]);

		return Response::json($obj);
    }

/* for payment getway	*/
	function payment(Request $request, $OrdersId)
	{

		//Get order info
		// $BuyerName = "Na";
		// $Phone = "Na";
		// $TotalPrice = 0;

		$posts = DB::table('t_orders_tmp')
	            ->join('t_ordersitems_tmp', 't_orders_tmp.OrdersId', '=', 't_ordersitems_tmp.OrdersId')
	            ->select('t_orders_tmp.BuyerName', 't_orders_tmp.Phone', 't_ordersitems_tmp.TotalPrice')
	            ->select(DB::raw("t_orders_tmp.BuyerName,t_orders_tmp.Phone,sum(t_ordersitems_tmp.TotalPrice) as TotalPrice"))
		        ->Where('t_orders_tmp.OrdersId','=', $OrdersId)
		        ->groupByRaw("t_orders_tmp.BuyerName,t_orders_tmp.Phone")
	            ->get();

		if($posts){
			foreach($posts as $r){
				$BuyerName = $r->BuyerName;
				$Phone = $r->Phone;
				$TotalPrice = $r->TotalPrice;
			}
		}
		

		$name   = $BuyerName;//"Rubel";// $request->input('name');
		$phone  = $Phone;//"01538198763";//$request->input('contact');
		$amount = $TotalPrice;//10;// $request->input('amount');

		$trnxId = 'trnx_' . Str::uuid();     // must be unique

		$url = "https://api.sheba.xyz";
		$PL_CLIENT_ID = "568027661";
		$PL_CLIENT_SECRET = "hg98Z1ZwB7uoLfItEWo7Uso2ttDzR0As5OkMV7GiXxXqRrpW2PpSUIQZcVcHhCqZ0FHOFVCrAqyuObhiIdSebpuKK4pYngPoXRfBLZB5tlH4uLS8Z7h8ikaT";

		try {
			$responsejSON = Http::withHeaders([
				'client-id'     => $PL_CLIENT_ID,
				'client-secret' => $PL_CLIENT_SECRET
			])->post($url . '/v1/ecom-payment/initiate', [
				'customer_name'   => $name,
				'customer_mobile' => $phone,
				'amount'          => $amount,
				'transaction_id'  => $trnxId,
				'success_url'     => 'https://hostaxil.com/esm/paymentsuccess/'.$OrdersId,  // success url
				'fail_url'        => 'https://hostaxil.com/esm/paymentfail'    // failed url
			])->json();

			// return $responsejSON;

			$code    = $responsejSON['code'];
			$message = $responsejSON['message'];

			
			
			if ($code !== 200) {
				return Redirect::back()
	                ->withErrors([$message]);
			}else{
				return redirect()->to($responsejSON['data']['link'])->send();
			}

		} catch (\Exception $ex) {
			return Redirect::back()
	                ->withErrors([$ex->getMessage()]);
		}
	}



/*Set success flag after payment complete*/
    public function confirmOrder(Request $request){
/*
		$OrdersId = $request->input("OrdersId");

		$obj = DB::table('t_orders')
              ->where('OrdersId', $OrdersId)
              ->update(['IsPayment' =>1]);

		return Response::json($obj);*/


		$TmpOrdersId = $request->input("OrdersId");

//load order temp master
		$posts = DB::table('t_orders_tmp')
            ->select('t_orders_tmp.*')
	        ->Where('OrdersId','=', $TmpOrdersId)
            ->get();

			$currDateTime = "";
		    $TotalPrice = 0;
		    $BuyerName = "";
		    $Phone = "";
		    $Address = "";

			if($posts){
				foreach($posts as $r){
					$currDateTime = $r->OrderDate;
					$TotalPrice = $r->TotalPrice;
					$BuyerName = $r->BuyerName;
					$Phone = $r->Phone;
					$Address = $r->Address;
				}
			}


		//$currDateTime = date ( 'Y-m-d H:i:s' );
		//$ProductId = $_POST['ProductId'];
		//$UnitPrice = $_POST['UnitPrice'];
		//$Quantity = $_POST['Quantity'];
		//$TotalPrice = $_POST['TotalPrice'];
		//$BuyerName = $_POST['BuyerName'];
		//$Phone = $_POST['Phone'];
		//$Address = $_POST['Address'];

		/*when PK already exist then  update otherwise insert*/
		//Status = Order, Accept, Delivered, Cancel 
		DB::table('t_orders')
		    ->Insert(
		        ['OrderDate' => $currDateTime, 
		        'TotalPrice' => $TotalPrice, 
		        'BuyerName' =>$BuyerName, 
		        'Phone' => $Phone, 
		        'Address' => $Address, 
		        'Status' => 'Order',
		        'IsPayment' => 1]		       
		    );


	    //get mysqli_insert_id
		$rowTotalObj = DB::table('t_orders')
                     ->select(DB::raw('max(OrdersId) as OrdersId'))
                     ->get();

		$OrdersId = $rowTotalObj[0]->OrdersId;



		//load order temp many
		$posts = DB::table('t_ordersitems_tmp')
            ->select('t_ordersitems_tmp.*')
	        ->Where('OrdersId','=', $TmpOrdersId)
            ->get();

		if($posts){
			foreach($posts as $r){
				$ProductId = $r->ProductId;
				$Quantity = $r->Qty;
				$UnitPrice = $r->UnitPrice;
				$TotalPrice = $r->TotalPrice;

				DB::table('t_ordersitems')->insert(
					    ['OrdersId' => $OrdersId, 'ProductId' => $ProductId, 'Qty' => $Quantity,
					     'UnitPrice' => $UnitPrice, 'TotalPrice' => $TotalPrice]
					);


			}
		}

		DB::table('t_ordersitems_tmp')->where('OrdersId', '=', $TmpOrdersId)->delete();
		DB::table('t_orders_tmp')->where('OrdersId', '=', $TmpOrdersId)->delete();


		echo $OrdersId;
    }



/*Report*/
function getOrdersReportData(Request $request){ 

		$search = $_POST['search']['value'];

		$StartDate = $_POST['StartDate'];
		$EndDate = $_POST['EndDate'];

		$rowTotalObj = DB::table('t_orders')
            ->join('t_ordersitems', 't_orders.OrdersId', '=', 't_ordersitems.OrdersId')
            ->join('t_products', 't_ordersitems.ProductId', '=', 't_products.ProductId')
            ->select(DB::raw('count(*) as rcount'))
            ->Where('OrderDate','>=', $StartDate)
            ->Where('OrderDate','<=', $EndDate)

	        ->where(function($query) use ($search)
	          {
	            if(!empty($search)):
	               $query->Where('ProductName','like', '%' . $search . '%');
	               $query->orWhere('Qty','like', '%' . $search . '%');
	               $query->orWhere('t_ordersitems.TotalPrice','like', '%' . $search . '%');
	               $query->orWhere('BuyerName','like', '%' . $search . '%');
	               $query->orWhere('Phone','like', '%' . $search . '%');
	               $query->orWhere('Address','like', '%' . $search . '%');
	               $query->orWhere('Status','like', '%' . $search . '%');
	            endif;
	          })
            ->get();

		$totalData = $rowTotalObj[0]->rcount;

		$limit = $_POST['length'];
		$start = $_POST['start'];

		$posts = DB::table('t_orders')
            ->join('t_ordersitems', 't_orders.OrdersId', '=', 't_ordersitems.OrdersId')
            ->join('t_products', 't_ordersitems.ProductId', '=', 't_products.ProductId')
            ->select('t_orders.OrdersId', 't_orders.OrderDate', 't_orders.BuyerName', 't_orders.Phone', 't_orders.Address', 't_orders.Status', 't_products.ProductName', 't_ordersitems.Qty', 't_ordersitems.UnitPrice', 't_ordersitems.TotalPrice')

            ->Where('OrderDate','>=', $StartDate)
            ->Where('OrderDate','<=', $EndDate)
	        ->where(function($query) use ($search)
	          {
	            if(!empty($search)):
	               $query->Where('ProductName','like', '%' . $search . '%');
	               $query->orWhere('Qty','like', '%' . $search . '%');
	               $query->orWhere('t_ordersitems.TotalPrice','like', '%' . $search . '%');
	               $query->orWhere('BuyerName','like', '%' . $search . '%');
	               $query->orWhere('Phone','like', '%' . $search . '%');
	               $query->orWhere('Address','like', '%' . $search . '%');
	               $query->orWhere('Status','like', '%' . $search . '%');
	            endif;
	          })
	        ->offset($start)
			->limit($limit)
			->orderByRaw("OrderDate desc,ProductName asc")
            ->get();

		$data = array();

		if($posts){

			$serial = $_POST['start'] + 1;
			foreach($posts as $r){
				$arr['Serial'] = $serial++;
				$arr['OrderDate'] = $r->OrderDate;
				$arr['ProductName'] = $r->ProductName;
				$arr['Qty'] = $r->Qty;
				$arr['TotalPrice'] = $r->TotalPrice;
				$arr['BuyerName'] = $r->BuyerName;
				$arr['Phone'] = $r->Phone;
				$arr['Address'] = $r->Address;
			
				$arr['Status'] = $r->Status;

				
				$data[] = $arr;
			}
			/*1.Order, 2.Accept, 3.Delivered, 4.Cancel*/ 
			$json_data = array(
				"iTotalRecords"=> intval($totalData),
				"iTotalDisplayRecords"=> intval($totalData),
				"draw"=>intval($request->input('draw')),
				"recordsTotal"=> intval($totalData),
				"data"=>$data
			);

			echo json_encode($json_data);
		}
	}



	/*///////////////////////Order Entry/////////////////////////////////////*/
	/*Menu: Customer / Order*/
	function getOrderPlaceListData(Request $request){

		$loginuserid = Auth::user()->id;
		$totalData = 0;
		$posts = DB::table('t_orders')
			->join('users', 't_orders.UserId', '=', 'users.id')
            ->select(DB::raw('t_orders.OrdersId, t_orders.OrderDate, users.name, users.phone, users.address,t_orders.Status, t_orders.IsPayment, t_orders.TotalPrice'))
			->Where('UserId','=', $loginuserid)
			->orderByRaw("OrderDate desc")
            ->get();
///////////////////////////////////////////////////////////////////////////////////

// $posts = DB::table('t_orders')
//             ->join('t_ordersitems', 't_orders.OrdersId', '=', 't_ordersitems.OrdersId')
//             ->join('users', 't_orders.UserId', '=', 'users.id')
//             ->select(DB::raw('t_orders.OrdersId, t_orders.OrderDate, users.name, users.phone, users.address, t_orders.Status, t_orders.IsPayment, sum(t_ordersitems.TotalPrice) TotalPrice'))
// 	        ->where(function($query) use ($search)
// 	          {
// 	            if(!empty($search)):
// 	               $query->Where('users.name','like', '%' . $search . '%');
// 	               $query->orWhere('users.phone','like', '%' . $search . '%');
// 	               $query->orWhere('users.address','like', '%' . $search . '%');
// 	               $query->orWhere('t_orders.Status','like', '%' . $search . '%');
// 	            endif;
// 	          })
// 	        ->offset($start)
// 			->limit($limit)
// 			->groupByRaw('t_orders.OrdersId, t_orders.OrderDate, users.name, users.phone, users.address, t_orders.Status, t_orders.IsPayment')
// 			->orderByRaw("t_orders.OrderDate desc")
//             ->get();





///////////////////////////////////////////////////////////////////////////////////////
		$data = array();

		if($posts){

			// $accept = "<a class='task-del itemApprove' style='margin-left:4px' href='javascript:void(0);'><span class='label label-primary'>Accept</span></a>";
			// $delivered = "<a class='task-del itemDelivery' style='margin-left:4px' href='javascript:void(0);'><span class='label label-primary'>Delivery</span></a>";
			// $cancel = "<a class='task-del itemCancel' style='margin-left:4px' href='javascript:void(0);'><span class='label label-danger'>Cancel</span></a>";
	
			$payment = "<a class='task-del itmPayment' style='margin-left:4px' href='javascript:void(0);'><span class='label label-primary'>Payment</span></a>";
			$paid = "<span class='font-green'>Paid</span>";
			
			$y = "<a class='task-del itmEdit' style='margin-left:4px' href='javascript:void(0);'><span class='label label-lemon'>View</span></a>";
			$z = "<a class='task-del itmDrop' style='margin-left:4px' href='javascript:void(0);'><span class='label label-danger'>Delete</span></a>";
			

			$serial = $_POST['start'] + 1;
			foreach($posts as $r){

				$paymentStatus="No";
				if($r->IsPayment == 1){
					$paymentStatus="Yes";
				}

				$arr['OrdersId'] = $r->OrdersId;
				$arr['Serial'] = $serial++;
				$arr['OrderDate'] = $r->OrderDate;
				$arr['TotalPrice'] = $r->TotalPrice;
				$arr['IsPayment'] = $paymentStatus;
				$arr['Status'] = $r->Status;

				// if($r->Status == "Order"){
				// 	$arr['action'] = $accept . $cancel . $y;
				// }else if($r->Status == "Accept"){
				// 	$arr['action'] = $delivered . $y;
				// }else if($r->Status == "Delivered"){
				// 	$arr['action'] =  "<span class='font-green'>Delivered</span>" . $z;
				// }else if($r->Status == "Cancel"){
				// 	$arr['action'] =  "<span class='font-red'>Cancel</span>" . $y;
				// }

				if($r->IsPayment == 1){
					$arr['action'] =  $paid.$y;
				}else{

					if($r->Status == "Order"){
						$arr['action'] =  $payment.$y.$z;	
					}else{
						$arr['action'] =  $payment.$y;	
					}
					

				}

				$arr['UserName'] = $r->name;
				$arr['Phone'] = $r->phone;
				$arr['Address'] = $r->address;

				$data[] = $arr;
			}
			/*1.Order, 2.Accept, 3.Delivered, 4.Cancel*/ 
			$json_data = array(
				"iTotalRecords"=> intval($totalData),
				"iTotalDisplayRecords"=> intval($totalData),
				"draw"=>intval($request->input('draw')),
				"recordsTotal"=> intval($totalData),
				"data"=>$data
			);

			echo json_encode($json_data);
		}
	}


    public function orderPaymentConfirm(Request $request){
	 	$id = $request->input("id");
	 	$currDateTime = date ( 'Y-m-d H:i:s' );

		$obj = DB::table('t_orders')
              ->where('OrdersId', $id)
              ->update(['IsPayment' => 1]);

              // $obj = DB::table('t_orders')
              // ->where('OrdersId', $id)
              // ->update(['IsPayment' => 1, 'ReadyOrCancellDate' => $currDateTime]);

		return Response::json($obj);
    }


public function orderGenerate(Request $request){
		$currDateTime = date ( 'Y-m-d H:i:s' );
		// $id = $request->input("id");
		$loginuserid = Auth::user()->id;

		$MedicineTextList = $request->input("MedicineTextList");


		/*get product list start*/
		$ProductList = array();
		$posts = DB::table('t_products')
            ->select(DB::raw('t_products.ProductId, t_products.ProductName, t_products.Price'))
            ->get();
 
		$data = array();

		if($posts){
			foreach($posts as $r){
				$ProductList[$r->ProductName] = array("ProductId"=>$r->ProductId, "Price"=>$r->Price);
			}
		}
		/*get product list end*/

// Array
// (
//     [0] => Geston 5mg
//     [1] => 1+0+1 3 months
//     [2] => Zifolet 20mg
//     [3] => 0+1+0 1 month
//     [4] => Sergel 20mg
//     [5] => 1+0+1 1 month
// )
		// echo "<pre>";
		// print_r($MedicineTextList) ;

		$orderData = array();
		
		$tmpProductId = "";
		foreach($MedicineTextList as $key=>$item){
			if (array_key_exists($item,$ProductList)){

				$tmpProductId = $ProductList[$item]["ProductId"];
				$orderData[$tmpProductId] = array(
									"ProductId"=>$tmpProductId,
									"Qty"=>0,
									"UnitPrice"=>$ProductList[$item]["Price"],
									"TotalPrice"=>0
									);
			}
			else{
				$tmpProductDetails = explode(" ",$item);

				$dailyDoges = explode("+",$tmpProductDetails[0]);
				$PerDayMedicine = 0;
				foreach($dailyDoges as $r){
					$PerDayMedicine += $r;
				}
				// // $StringEQ = "$tmpProductDetails[0]";
				// $StringEQ = "1+2+0";
				// $MathString ="print (".$StringEQ.");";
				// $PerDayMedicine = eval($MathString);

				// echo " ===PerDayMedicine:". $PerDayMedicine ."===";

				$MonthorDayCount = $tmpProductDetails[1];
				$MonthorDay = $tmpProductDetails[2];

				$TotalDays = 0;
				if(strtolower($MonthorDay) == "month" || strtolower($MonthorDay) == "months"){
					$TotalDays = $MonthorDayCount*30;
				}else if(strtolower($MonthorDay) == "day" || strtolower($MonthorDay) == "days"){
					$TotalDays = $MonthorDayCount*1;
				}

				// echo " ===TotalDays:".$TotalDays."===";
				// echo " ===Qty:". ($PerDayMedicine*$TotalDays)."===";

				$orderData[$tmpProductId]["Qty"] = $PerDayMedicine*$TotalDays;
				$orderData[$tmpProductId]["TotalPrice"] = $orderData[$tmpProductId]["UnitPrice"]*($PerDayMedicine*$TotalDays);

			}
		}

		// print_r($orderData);

		/*get max orderid start*/
		$NextOrderId = 0;
		$posts = DB::table('t_orders')
            ->select(DB::raw('ifnull(max(t_orders.OrdersId),0) OrdersId'))
            ->get();
 
		$data = array();

		if($posts){
			foreach($posts as $r){
				$NextOrderId = $r->OrdersId+1;
			}
		}
		/*get max orderid end*/


		DB::table('t_orders')
		    ->Insert(
		        ['OrdersId' => $NextOrderId, 
		        'UserId' => $loginuserid, 
		        'OrderDate' => $currDateTime, 
		        'TotalPrice' => 0, 
		        'Status' => 'Order', 
		        'IsPayment' => 0]		       
		    );

		$GrandTotalPrice = 0;
		foreach($orderData as $key=>$product){

			$GrandTotalPrice += $product["TotalPrice"];
			
			DB::table('t_ordersitems')
		    ->Insert(
		        ['OrdersId' => $NextOrderId, 
		        'ProductId' => $product["ProductId"], 
		        'Qty' => $product["Qty"], 
		        'UnitPrice' => $product["UnitPrice"], 
		        'TotalPrice' => $product["TotalPrice"]
		    	]		       
		    );
		}


		$obj = DB::table('t_orders')
              ->where('OrdersId', $NextOrderId)
              ->update(['TotalPrice' => $GrandTotalPrice]);

		   
    }



	 public function deleteOrder(Request $request){
		$id = $request->input("id");

		DB::table('t_ordersitems')->where('OrdersId', '=', $id)->delete();
		DB::table('t_orders')->where('OrdersId', '=', $id)->delete();

    }

}
