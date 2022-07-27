<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FarmerRegistrationForm extends Model
{
    protected $table='t_farmerproductsreg';
    protected $fillable=['FarmerProductId','FarmerName','Phone','Address','NID','ProductId','Availability','Status','AppCancellDate'];
}
