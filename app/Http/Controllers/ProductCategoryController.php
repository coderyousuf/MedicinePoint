<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect,Response;
use App\ProductCategory;
use DB;

class ProductCategoryController extends Controller
{
    function getProductCategoryData(Request $request){

		//datatable column index => database column name. here considaer datatable visible and novisible column
		$columns = array(2=>'CategoryName');


		$search = $_POST['search']['value'];
		$rowTotalObj = DB::table('t_product_category')
                     ->select(DB::raw('count(*) as rcount'))
                     ->where(function($query) use ($search)
		              {
		                if(!empty($search)):
		                   $query->Where('CategoryName','like', '%' . $search . '%');
		                endif;
		              })
                     ->get();

		$totalData = $rowTotalObj[0]->rcount;


		$limit = $_POST['length'];
		$start = $_POST['start'];
		$order = $columns[$_POST['order'][0]['column']];
		$dir = $_POST['order'][0]['dir'];

		

		$posts= ProductCategory::offset($start)
		->where(function($query) use ($search)
          {
            if(!empty($search)):
               $query->Where('CategoryName','like', '%' . $search . '%');
            endif;
          })
		->offset($start)
		->limit($limit)
		->orderByRaw("$order $dir")
		->get();

		$data = array();

		if($posts){

			$y = "<a class='task-del itmEdit' href='javascript:void(0);'><span class='label label-lemon'>Edit</span></a>";
			$z = "<a class='task-del itmDrop' style='margin-left:4px' href='javascript:void(0);'><span class='label label-danger'>Delete</span></a>";
			
			$serial = $_POST['start'] + 1;
			foreach($posts as $r){
				$arr['ProdCatId'] = $r->ProdCatId;
				$arr['Serial'] = $serial++;				
				$arr['CategoryName'] = $r->CategoryName;
				$arr['action'] =$y.$z;
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

     public function addEditProductCategory(Request $request){

		/*when ProdCatId already exist then  update otherwise insert*/
		DB::table('t_product_category')
		    ->updateOrInsert(
		        ['ProdCatId' => $request->input("recordId")],
		        ['CategoryName' => $request->input("CategoryName")]
		    );
    }

    public function deleteProductCategory(Request $request){
		$id = $request->input("id");

		$result = ProductCategory::where('ProdCatId',$id)->delete();
		return Response::json($result);
    }
}
