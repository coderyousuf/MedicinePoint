<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table='t_products';
    protected $fillable=['ProductId','ProdCatId','ProductName','Price','ImageURL','Remarks'];
}
