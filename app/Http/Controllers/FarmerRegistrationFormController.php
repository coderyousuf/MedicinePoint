<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect,Response;
use App\FarmerRegistrationForm;
use DB;
use Auth;

class FarmerRegistrationFormController extends Controller
{
     public function addEditFarmerRegistration(Request $request){

		$currDateTime = date ( 'Y-m-d H:i:s' );
		$loginuserid = Auth::user()->id;

		/*when PK already exist then  update otherwise insert*/
		DB::table('t_farmerproductsreg')
		    ->updateOrInsert(
		        ['FProductId' => $request->input("recordId")],

		        ['RegDate' => $currDateTime, 
		        'UserId' => $loginuserid, 
		        'ProductId' => $request->input("ProductId"), 
		        'Availability' => $request->input("productability"), 
		        'Status' => 'Pending']		       
		    );
    }


     function getFarmerProductsData(Request $request){ 
		$search = $_POST['search']['value'];

		//datatable column index => database column name. here considaer datatable visible and novisible column
		$columns = array(2=>'name',3=>'ProductName',4=>'Availability',5=>'phone',6=>'nid',6=>'address',6=>'Status');

		$loginuserid = Auth::user()->id;

		$rowTotalObj = DB::table('t_farmerproductsreg')
            ->join('t_products', 't_farmerproductsreg.ProductId', '=', 't_products.ProductId')
            ->join('users', 't_farmerproductsreg.UserId', '=', 'users.id')
            ->select(DB::raw('count(*) as rcount'))
            ->where(function($query) use ($loginuserid)
	          {
	            $query->Where('t_farmerproductsreg.UserId','=', $loginuserid);
	          })
	        ->where(function($query) use ($search)
	          {
	            if(!empty($search)):
	               $query->Where('name','like', '%' . $search . '%');
	               $query->orWhere('ProductName','like', '%' . $search . '%');
	               $query->orWhere('Availability','like', '%' . $search . '%');
	               $query->orWhere('phone','like', '%' . $search . '%');
	               $query->orWhere('nid','like', '%' . $search . '%');
	               $query->orWhere('address','like', '%' . $search . '%');
	               $query->orWhere('Status','like', '%' . $search . '%');
	            endif;
	          })
            ->get();

		$totalData = $rowTotalObj[0]->rcount;

		$limit = $_POST['length'];
		$start = $_POST['start'];

		$posts = DB::table('t_farmerproductsreg')
            ->join('t_products', 't_farmerproductsreg.ProductId', '=', 't_products.ProductId')
            ->join('users', 't_farmerproductsreg.UserId', '=', 'users.id')
            ->select('t_farmerproductsreg.*', 't_products.ProductName', 'users.name', 'users.phone', 'users.nid', 'users.address')
	        ->where(function($query) use ($loginuserid)
	          {
	            $query->Where('t_farmerproductsreg.UserId','=', $loginuserid);
	          })
	        ->where(function($query) use ($search)
	          {
	            if(!empty($search)):
	               $query->Where('name','like', '%' . $search . '%');
	               $query->orWhere('ProductName','like', '%' . $search . '%');
	               $query->orWhere('Availability','like', '%' . $search . '%');
	               $query->orWhere('phone','like', '%' . $search . '%');
	               $query->orWhere('nid','like', '%' . $search . '%');
	               $query->orWhere('address','like', '%' . $search . '%');
	               $query->orWhere('Status','like', '%' . $search . '%');
	            endif;
	          })
	        ->offset($start)
			->limit($limit)
			->orderByRaw("name asc,ProductName asc")
            ->get();

		$data = array();

		if($posts){
	
			$serial = $_POST['start'] + 1;
			foreach($posts as $r){
				$arr['FProductId'] = $r->FProductId;
				$arr['Serial'] = $serial++;
				$arr['RegDate'] = $r->RegDate;
				$arr['FarmerName'] = $r->name;
				$arr['ProductName'] = $r->ProductName;
				$arr['Availability'] = $r->Availability;
				$arr['Phone'] = $r->phone;
				$arr['NID'] = $r->nid;
				$arr['Address'] = $r->address;
				
				
				if($r->Status == "Pending"){
					$arr['Status'] = "<span class='font-blue'>".$r->Status."</span>";
				}else if($r->Status == "Approved"){
					$arr['Status'] = "<span class='font-green'>".$r->Status."</span>";
				}else if($r->Status == "Cancel"){
					$arr['Status'] = "<span class='font-red'>".$r->Status."</span>";
				}else {
					$arr['Status'] = $r->Status;
				}
				

				
				$data[] = $arr;
			}

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



	function getProductWaitforApprovalData(Request $request){ 
		$search = $_POST['search']['value'];

		//datatable column index => database column name. here considaer datatable visible and novisible column
		$columns = array(2=>'FarmerName',3=>'ProductName',4=>'Availability',5=>'Phone',6=>'NID',6=>'Address',6=>'Status');


		$rowTotalObj = DB::table('t_farmerproductsreg')
            ->join('t_products', 't_farmerproductsreg.ProductId', '=', 't_products.ProductId')
            ->join('users', 't_farmerproductsreg.UserId', '=', 'users.id')
            ->select(DB::raw('count(*) as rcount'))
	        ->where(function($query) use ($search)
	          {
	            if(!empty($search)):
	               $query->Where('name','like', '%' . $search . '%');
	               $query->orWhere('ProductName','like', '%' . $search . '%');
	               $query->orWhere('Availability','like', '%' . $search . '%');
	               $query->orWhere('phone','like', '%' . $search . '%');
	               $query->orWhere('nid','like', '%' . $search . '%');
	               $query->orWhere('address','like', '%' . $search . '%');
	               $query->orWhere('Status','like', '%' . $search . '%');
	            endif;
	          })
            ->get();

		$totalData = $rowTotalObj[0]->rcount;

		$limit = $_POST['length'];
		$start = $_POST['start'];

		$posts = DB::table('t_farmerproductsreg')
            ->join('t_products', 't_farmerproductsreg.ProductId', '=', 't_products.ProductId')
            ->join('users', 't_farmerproductsreg.UserId', '=', 'users.id')
            ->select('t_farmerproductsreg.*', 't_products.ProductName', 'users.name', 'users.phone', 'users.nid', 'users.address')
	        ->where(function($query) use ($search)
	          {
	            if(!empty($search)):
	               $query->Where('name','like', '%' . $search . '%');
	               $query->orWhere('ProductName','like', '%' . $search . '%');
	               $query->orWhere('Availability','like', '%' . $search . '%');
	               $query->orWhere('phone','like', '%' . $search . '%');
	               $query->orWhere('nid','like', '%' . $search . '%');
	               $query->orWhere('address','like', '%' . $search . '%');
	               $query->orWhere('Status','like', '%' . $search . '%');
	            endif;
	          })
	        ->offset($start)
			->limit($limit)
			->orderByRaw("Status desc, name asc,ProductName asc")
            ->get();

		$data = array();

		if($posts){

			$approve = "<a class='task-del itemApprove' style='margin-left:4px' href='javascript:void(0);'><span class='label label-primary'>Approve</span></a>";
			$cancel = "<a class='task-del itemCancel' style='margin-left:4px' href='javascript:void(0);'><span class='label label-danger'>Cancel</span></a>";
	
			$serial = $_POST['start'] + 1;
			foreach($posts as $r){
				$arr['FProductId'] = $r->FProductId;
				$arr['Serial'] = $serial++;
				$arr['RegDate'] = $r->RegDate;
				$arr['FarmerName'] = $r->name;
				$arr['ProductName'] = $r->ProductName;
				$arr['Availability'] = $r->Availability;
				$arr['Phone'] = $r->phone;
				$arr['NID'] = $r->nid;
				$arr['Address'] = $r->address;
				
				/*
				if($r->Status == "Pending"){
					$arr['Status'] = "<span class='font-blue'>".$r->Status."</span>";
				}else if($r->Status == "Approved"){
					$arr['Status'] = "<span class='font-green'>".$r->Status."</span>";
				}else if($r->Status == "Cancel"){
					$arr['Status'] = "<span class='font-red'>".$r->Status."</span>";
				}else {
					$arr['Status'] = $r->Status;
				}*/
				$arr['Status'] = $r->Status;

				if($r->Status == "Pending"){
					$arr['action'] = $approve . $cancel;
				}else if($r->Status == "Approved"){
					$arr['action'] = "<span class='font-blue'>".$r->Status."</span>";
				}else if($r->Status == "Cancel"){
					$arr['action'] =  "<span class='font-red'>".$r->Status."</span>";
				}

				

				
				$data[] = $arr;
			}

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




	public function productRequestApprove(Request $request){
	 	$id = $request->input("id");
	 	$currDateTime = date ( 'Y-m-d H:i:s' );

		$obj = DB::table('t_farmerproductsreg')
              ->where('FProductId', $id)
              ->update(['Status' => 'Approved', 'AppCancellDate' => $currDateTime]);

		return Response::json($obj);
    }

	public function productRequestCancel(Request $request){
	 	$id = $request->input("id");

		$obj = DB::table('t_farmerproductsreg')
              ->where('FProductId', $id)
              ->update(['Status' => 'Cancel', 'AppCancellDate' => NULL]);

		return Response::json($obj);
    }







}
