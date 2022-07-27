<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect,Response;
use App\Transaction;
use DB;
use Auth;

class TransactionController extends Controller
{
    function getReceiveData(Request $request){
        $search = $_POST['search']['value'];
        $rowTotalObj = DB::table('t_transaction')
            ->join('users', 't_transaction.FarmerId', '=', 'users.id') 
            ->join('t_products', 't_transaction.ProductId', '=', 't_products.ProductId')  
            ->select(DB::raw('count(*) as rcount'))
            ->Where('TransType','=', 'Receive')
            ->where(function($query) use ($search)
              {
                if(!empty($search)):
                   $query->Where('ProductName','like', '%' . $search . '%');
                   $query->orWhere('name','like', '%' . $search . '%');
                endif;
              })
            ->get();


        $totalData = $rowTotalObj[0]->rcount;




        $limit = $_POST['length'];
        $start = $_POST['start'];
        //$order = $columns[$_POST['order'][0]['column']];
        //$dir = $_POST['order'][0]['dir'];

        
        $posts = DB::table('t_transaction')
            ->join('users', 't_transaction.FarmerId', '=', 'users.id') 
            ->join('t_products', 't_transaction.ProductId', '=', 't_products.ProductId') 
            ->Where('TransType','=', 'Receive')
            ->where(function($query) use ($search)
              {
                if(!empty($search)):
                   $query->Where('ProductName','like', '%' . $search . '%');
                   $query->orWhere('name','like', '%' . $search . '%');
                endif;
              })
            ->offset($start)
            ->limit($limit)
            ->orderByRaw("TransDate desc,name asc,ProductName asc")
            ->get();

        $data = array();

        if($posts){
            $y = "<a class='task-del itmEdit' style='margin-left:4px' href='javascript:void(0);'><span class='label label-lemon'>Edit</span></a>";
            $z = "<a class='task-del itmDrop' style='margin-left:4px' href='javascript:void(0);'><span class='label label-danger'>Delete</span></a>";
            
            $serial = $_POST['start'] + 1;
            foreach($posts as $r){
                $arr['TransId'] = $r->TransId;
                $arr['Serial'] = $serial++;
                $arr['TransDate'] = $r->TransDate;
                $arr['FarmerName'] = $r->name;
                $arr['ProductName'] = $r->ProductName;
                $arr['Qty'] = $r->Qty;
                $arr['action'] = $y.$z;
                $arr['FarmerId'] = $r->FarmerId;
                $arr['ProductId'] = $r->ProductId;
                
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

    public function addEditReceive(Request $request){
        $curDateTime = date ( 'Y-m-d H:i:s' );
        /*when PK already exist then  update otherwise insert*/
        DB::table('t_transaction')
            ->updateOrInsert(
                ['TransId' => $request->input("recordId")],

                ['TransDate' => $curDateTime, 
                'FarmerId' => $request->input("FarmerId"), 
                'ProductId' => $request->input("ProductId"), 
                'Qty' => $request->input("Qty"), 
                'TransType' => 'Receive']               
            );
    }

    public function deleteReceiveData(Request $request){
        $id = $request->input("id");

        $data = Transaction::where('TransId',$id)->delete();
        return Response::json($data);
    }










/*Rec details report*/

function getReceiveReportData(Request $request){

        $StartDate = $_POST['StartDate'];
        $EndDate = $_POST['EndDate'];
        $FarmerId = $_POST['FarmerId'];

        $search = $_POST['search']['value'];
        $rowTotalObj = DB::table('t_transaction')
            ->join('users', 't_transaction.FarmerId', '=', 'users.id') 
            ->join('t_products', 't_transaction.ProductId', '=', 't_products.ProductId')  
            ->select(DB::raw('count(*) as rcount'))
            ->Where('TransType','=', 'Receive')
            ->Where('TransDate','>=', $StartDate)
            ->Where('TransDate','<=', $EndDate)
            ->where(function($query) use ($FarmerId)
              {
                if($FarmerId>0):
                   $query->Where('t_transaction.FarmerId','=', $FarmerId);
                endif;
              })
            ->where(function($query) use ($search)
              {
                if(!empty($search)):
                   $query->Where('ProductName','like', '%' . $search . '%');
                   $query->orWhere('name','like', '%' . $search . '%');
                endif;
              })
             
            ->get();


        $totalData = $rowTotalObj[0]->rcount;

        $limit = $_POST['length'];
        $start = $_POST['start'];
        
        $posts = DB::table('t_transaction')
            ->join('users', 't_transaction.FarmerId', '=', 'users.id') 
            ->join('t_products', 't_transaction.ProductId', '=', 't_products.ProductId') 
            ->Where('TransType','=', 'Receive')
            ->Where('TransDate','>=', $StartDate)
            ->Where('TransDate','<=', $EndDate)
            ->where(function($query) use ($FarmerId)
              {
                if($FarmerId>0):
                   $query->Where('t_transaction.FarmerId','=', $FarmerId);
                endif;
              })
            ->where(function($query) use ($search)
              {
                if(!empty($search)):
                   $query->Where('ProductName','like', '%' . $search . '%');
                   $query->orWhere('name','like', '%' . $search . '%');
                endif;
              })
            ->offset($start)
            ->limit($limit)
            ->orderByRaw("TransDate desc,name asc,ProductName asc")
            ->get();

        $data = array();

        if($posts){

            $serial = $_POST['start'] + 1;
            foreach($posts as $r){
                $arr['Serial'] = $serial++;
                $arr['TransDate'] = $r->TransDate;
                $arr['FarmerName'] = $r->name;
                $arr['ProductName'] = $r->ProductName;
                $arr['Qty'] = $r->Qty;
                
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

}
