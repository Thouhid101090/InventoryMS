<?php

namespace App\Models;

use App\Models\Sale;
use App\Models\SalesDetails;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReturnFromCustomer extends Model
{
    use HasFactory;
    public function saleDetails(){
        $this->belongsTo(SalesDetails::class,'sales_id','id');
    }
    public function product(){
        $this->belongsTo(Product::class,'product_id','id');
    }
    public function customer(){
        $this->belongsTo(Customer::class,'customer_id','id');
    }
   

   
}
