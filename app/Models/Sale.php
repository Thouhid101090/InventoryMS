<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sale extends Model
{
    use HasFactory;

    public function customer(){
        return $this->belongsto(Customer::class,'customer_id','id');
    }

    public function details(){
        return $this->hasMany(SalesDetails::class,'sales_id','id');
    }
    public function stock(){
        return $this->hasMany(Stock::class);
    }
    public function returnCustomer(){
        return $this->hasMany(ReturnFromCustomer::class);
    }


}
