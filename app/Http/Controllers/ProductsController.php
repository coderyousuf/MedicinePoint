<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect,Response;
use App\Products;
use DB;
use Auth;

class ProductsController extends Controller
{
    function getProductsData(Request $request){ 
		$search = $_POST['search']['value'];

		//datatable column index => database column name. here considaer datatable visible and novisible column
		$columns = array(2=>'CategoryName',3=>'ProductName',4=>'Price',5=>'Remarks');


		$rowTotalObj = DB::table('t_products')
            ->join('t_product_category', 't_products.ProdCatId', '=', 't_product_category.ProdCatId')     
            ->select(DB::raw('count(*) as rcount'))
	        ->where(function($query) use ($search)
	          {
	            if(!empty($search)):
	               $query->Where('ProductName','like', '%' . $search . '%');
	               $query->orWhere('Remarks','like', '%' . $search . '%');
	               $query->orWhere('Price','like', '%' . $search . '%');
	               $query->orWhere('CategoryName','like', '%' . $search . '%');
	            endif;
	          })
            ->get();


		$totalData = $rowTotalObj[0]->rcount;




		$limit = $_POST['length'];
		$start = $_POST['start'];
		//$order = $columns[$_POST['order'][0]['column']];
		//$dir = $_POST['order'][0]['dir'];

		

		$posts = DB::table('t_products')
            ->join('t_product_category', 't_products.ProdCatId', '=', 't_product_category.ProdCatId')
            ->select('t_products.*', 't_product_category.CategoryName')
	        ->where(function($query) use ($search)
	          {
	            if(!empty($search)):
	               $query->Where('ProductName','like', '%' . $search . '%');
	               $query->orWhere('Remarks','like', '%' . $search . '%');
	               $query->orWhere('Price','like', '%' . $search . '%');
	               $query->orWhere('CategoryName','like', '%' . $search . '%');
	            endif;
	          })
	        ->offset($start)
			->limit($limit)
			->orderByRaw("CategoryName asc,ProductName asc")
            ->get();

		$data = array();

		if($posts){
			
			$fileNot = "<a class='task-del fileUpload'  href='javascript:void(0);'><span class='label label-lemon'><i class='fa fa-upload'></i></span></a>";
			$fileExist = "<a class='task-del fileUpload'  href='javascript:void(0);'><span class='label label-lemon'><i class='fa fa-file-pdf-o'></i></span></a>";

			$y = "<a class='task-del itmEdit' style='margin-left:4px' href='javascript:void(0);'><span class='label label-lemon'>Edit</span></a>";
			$z = "<a class='task-del itmDrop' style='margin-left:4px' href='javascript:void(0);'><span class='label label-danger'>Delete</span></a>";
			
			$serial = $_POST['start'] + 1;
			foreach($posts as $r){
				$arr['ProductId'] = $r->ProductId;
				$arr['Serial'] = $serial++;
				$arr['CategoryName'] = $r->CategoryName;
				$arr['ProductName'] = $r->ProductName;
				$arr['Price'] = $r->Price;
				$arr['Availability'] = $r->Availability;
				$arr['Remarks'] = $r->Remarks;
	
				
				
				if($r->ImageURL == ""){
					$arr['action'] =$fileNot.$y.$z;
				}
				else{
					$arr['action'] =$fileExist.$y.$z;
				}

				$arr['ProdCatId'] = $r->ProdCatId;
				$arr['ImageURL'] = $r->ImageURL;
				
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

     public function addEditProducts(Request $request){

		/*when PK already exist then  update otherwise insert*/
		DB::table('t_products')
		    ->updateOrInsert(
		        ['ProductId' => $request->input("recordId")],

		        ['ProdCatId' => $request->input("ProdCatId"), 
		        'ProductName' => $request->input("ProductName"), 
		        'Price' => $request->input("Price"), 
		        'Availability' => $request->input("Availability"), 
		        'Remarks' => $request->input("Remarks")]		       
		    );
    }

 	public function fileUpload(Request $request){

		$ProductId = $request->input('idFileUp');
		$filePath = $request->file('file')->store('products');

		DB::table('t_products')
		->where('ProductId', $ProductId)
		->update(['ImageURL' => $filePath]);
    }

	 public function deleteProducts(Request $request){
		$id = $request->input("id");

		$data = Products::where('ProductId',$id)->delete();
		return Response::json($data);
    }


}
