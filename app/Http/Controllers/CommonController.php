<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class CommonController extends Controller
{
  

public function getProductCategoryList()
  {
 
    $posts = DB::table('t_product_category')
            ->select('ProdCatId', 'CategoryName')
      ->orderByRaw("CategoryName asc")
            ->get();

         return $posts;
  }


public function getProductNameList()
  {
 
    $posts = DB::table('t_products')
            ->select('ProductId', 'ProductName')
      ->orderByRaw("ProductName asc")
            ->get();

         return $posts;
  }


  public function getFarmerList()
  {
 
    $posts = DB::table('users')
            ->select(DB::raw("id, name"))
            ->Where('userrole','=', 'Farmer')
            ->orderByRaw("name asc")
            ->get();

         return $posts;
  }


  public function getUserList()
  {
 
    $posts = DB::table('users')
            ->select(DB::raw("id, CONCAT(usercode,' - ',name) AS name"))
      ->orderByRaw("usercode asc, name asc")
            ->get();

         return $posts;
  }



  /*For dashbard*/
  
  public function getReceiveTrendData()
  {
    $search='';

    $posts = DB::table('t_transaction')
      ->select(DB::raw("DATE_FORMAT(TransDate, '%Y-%m') AS YearMonth,SUM(`Qty`) AS Qty"))
      ->where(function($query) use ($search)
        {
           $query->orWhere('TransType','=', 'Receive');
        })
      ->groupByRaw("DATE_FORMAT(TransDate, '%Y-%m')")
      //->tosql();
      ->get();


    $category = array();
    $series = array("name"=>"Received","data"=>array(),"color"=>"green");

    foreach($posts as $r){
      $category[] = $r->YearMonth;

      settype($r->RequestCount,"int");
      $series["data"][] = $r->Qty;
    }
    
    $output = array();
    $output["category"] = $category;
    $output["series"][] = $series;
    
    return $output;//json_encode($output);

  }

  public function getDeliveryTrendData()
  {
    $search='';

    $posts = DB::table('t_orders')
      ->join('t_ordersitems', 't_orders.OrdersId', '=', 't_ordersitems.OrdersId')     
      ->select(DB::raw("DATE_FORMAT(OrderDate, '%Y-%m') AS YearMonth,SUM(`Qty`) AS Qty"))
      ->where(function($query) use ($search)
        {
           $query->orWhere('Status','=', 'Delivered');
        })
      ->groupByRaw("DATE_FORMAT(OrderDate, '%Y-%m')")
      //->tosql();
      ->get();


    $category = array();
    $series = array("name"=>"Delivery","data"=>array(),"color"=>"#00587E");

    foreach($posts as $r){
      $category[] = $r->YearMonth;

      settype($r->RequestCount,"int");
      $series["data"][] = $r->Qty;
    }
    
    $output = array();
    $output["category"] = $category;
    $output["series"][] = $series;
    
    return $output;//json_encode($output);

  }

}