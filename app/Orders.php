<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $table='t_orders';
    protected $fillable=['OrdersId','OrderDate','TotalPrice','BuyerName','Phone','Address','Status','ReadyOrCancellDate'];
}
