<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $table='t_product_category';
    protected $fillable=['ProdCatId','CategoryName'];
}
