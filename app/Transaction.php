<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table='t_transaction';
    protected $fillable=['TransId','TransDate','ProductId','Qty','TransType'];
}
