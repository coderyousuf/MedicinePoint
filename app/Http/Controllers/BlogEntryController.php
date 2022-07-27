<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect,Response;
use App\BlogEntry;
use DB;
use Auth;

class BlogEntryController extends Controller
{
    function getBlogData(Request $request){ 
		$search = $_POST['search']['value'];

		//datatable column index => database column name. here considaer datatable visible and novisible column
		//$columns = array(2=>'CategoryName',3=>'ProductName',4=>'Price',5=>'Remarks');


		$rowTotalObj = DB::table('t_blog')
            ->select(DB::raw('count(*) as rcount'))
	        ->where(function($query) use ($search)
	          {
	            if(!empty($search)):
	               $query->Where('BlogType','like', '%' . $search . '%');
	               $query->orWhere('BlogDateTime','like', '%' . $search . '%');
	               $query->orWhere('BlogTitle','like', '%' . $search . '%');
	               $query->orWhere('Content','like', '%' . $search . '%');
	            endif;
	          })
            ->get();


		$totalData = $rowTotalObj[0]->rcount;




		$limit = $_POST['length'];
		$start = $_POST['start'];
		//$order = $columns[$_POST['order'][0]['column']];
		//$dir = $_POST['order'][0]['dir'];

		

		$posts = DB::table('t_blog')
            ->select('t_blog.*')
	        ->where(function($query) use ($search)
	          {
	            if(!empty($search)):
	               $query->Where('BlogType','like', '%' . $search . '%');
	               $query->orWhere('BlogDateTime','like', '%' . $search . '%');
	               $query->orWhere('BlogTitle','like', '%' . $search . '%');
	               $query->orWhere('Content','like', '%' . $search . '%');
	            endif;
	          })
	        ->offset($start)
			->limit($limit)
			->orderByRaw("BlogDateTime desc,BlogTitle asc")
            ->get();

		$data = array();

		if($posts){
			
			// $fileNot = "<a class='task-del fileUpload'  href='javascript:void(0);'><span class='label label-lemon'><i class='fa fa-upload'></i></span></a>";
			// $fileExist = "<a class='task-del fileUpload'  href='javascript:void(0);'><span class='label label-lemon'><i class='fa fa-file-pdf-o'></i></span></a>";
			
			$fileNot = "<a class='task-del fileUpload'  href='javascript:void(0);'><span class='label label-lemon'><i class='fa fa-upload'></i></span></a>";
			$fileExist = "<a class='task-del fileUpload'  href='javascript:void(0);'><span class='label label-lemon'><i class='fa fa-file-pdf-o'></i></span></a>";


			$y = "<a class='task-del itmEdit' style='margin-left:4px' href='javascript:void(0);'><span class='label label-lemon'>Edit</span></a>";
			$z = "<a class='task-del itmDrop' style='margin-left:4px' href='javascript:void(0);'><span class='label label-danger'>Delete</span></a>";
			
			$serial = $_POST['start'] + 1;
			foreach($posts as $r){
				$arr['BlogId'] = $r->BlogId;
				$arr['Serial'] = $serial++;
				$arr['BlogType'] = $r->BlogType;
				$arr['BlogDateTime'] = $r->BlogDateTime;
				$arr['BlogTitle'] = $r->BlogTitle;
				$arr['Content'] = $r->Content;
	
				
				
				if($r->BlogType == "Video"){
					$arr['action'] =$y.$z;
				}
				else{
					if($r->Thumbnail == ""){
						$arr['action'] =$fileNot.$y.$z;
					}
					else{
						$arr['action'] =$fileExist.$y.$z;
					}
				}

				$arr['Thumbnail'] = $r->EmbedCode;
				
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

     public function addEditBlog(Request $request){
		$currDateTime = date ( 'Y-m-d H:i:s' );
		$Thumbnail = null;
		
		
		if($request->input("recordId") == ""){

			$Thumbnail = "blog/noimage.jpg";
			/*
			if($request->input("BlogType") == "Text"){
				$Thumbnail = "blog/noimage.jpg";
			}else if($request->input("BlogType") == "Racipies"){
				$Thumbnail = "blog/noimage.jpg";
			}else if($request->input("BlogType") == "News"){
				$Thumbnail = "blog/noimage.jpg";
			}else{
				$Thumbnail = $request->input("Thumbnail");				
			}
*/


			DB::table('t_blog')
			    ->updateOrInsert(
			        ['BlogId' => $request->input("recordId")],

			        ['BlogType' => $request->input("BlogType"), 
			        'BlogDateTime' => $currDateTime, 
			        'BlogTitle' => $request->input("BlogTitle"), 
			        'Thumbnail' => $Thumbnail,
			        'EmbedCode' => $request->input("Thumbnail"), 
			        'Content' => $request->input("Content")]		       
			    );
		}
		else{

			DB::table('t_blog')
					->where('BlogId', $request->input("recordId"))
					->update(['BlogType' => $request->input("BlogType"), 
				        'BlogTitle' => $request->input("BlogTitle"), 
				        'Content' => $request->input("Content"), 
				        'EmbedCode' => $request->input("Thumbnail")
				    ]);
		}
		   
    }

 	public function fileUpload(Request $request){

		$BlogId = $request->input('idFileUp');
		$filePath = $request->file('file')->store('blog');

		DB::table('t_blog')
		->where('BlogId', $BlogId)
		->update(['Thumbnail' => $filePath]);
    }





	 public function deleteBlog(Request $request){
		$id = $request->input("id");

		$data = BlogEntry::where('BlogId',$id)->delete();
		return Response::json($data);
    }




    function getAllBlogViewData(Request $request){ 
		$filtertype = $request->input("filtertype");

		$posts = DB::table('t_blog')
				->select('t_blog.*') 
				->where(function($posts) use ($filtertype)
		          {
		            if($filtertype == 1):
		               $posts->Where('BlogType','like', '%Text%');
		            endif;

		            if($filtertype == 2):
		               $posts->Where('BlogType','like', '%Video%');
		            endif;

		          })
				->orderByRaw("BlogDateTime desc,BlogTitle asc")
				->get();

		return $posts;

	}

	function getSingleBlogViewData(Request $request){ 

		$BlogId = $_POST['BlogId'];

		$posts = DB::table('t_blog')
				->select('t_blog.*')
				->where(function($query) use ($BlogId)
		          {
		            if($BlogId != 0):
		               $query->Where('t_blog.BlogId','=', $BlogId);
		            endif;
		          })
				->get();

		return $posts;

	}


}
