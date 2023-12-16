<?php

namespace App\Models;

use App\Models\Product;
use App\Models\SalesDetails;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sale extends Model
{
    use HasFactory;

    public function customer(){
        return $this->belongsto(Customer::class,'customer_id','id');
    }
    public function product(){
        return $this->belongsTo(Product::class,'product_id','id');
    }
    public function details(){
        return $this->hasMany(SalesDetails::class);
    }
   

}
